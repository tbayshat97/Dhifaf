<?php

namespace App\Http\Controllers\API\Customer;

use App\Enums\OrderStatus;
use App\Enums\TransactionStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\CustomerPaymentCard;
use App\Models\CustomerTransaction;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class HyperpayGatewayController extends Controller
{
    use ApiResponser;

    public function getCheckoutId(Request $request)
    {


        return $request->all();

        $customer = auth()->user();

        list($usec, $sec) = explode(' ', microtime());
        $usec = str_replace('0.', '', $usec);
        $usec = substr($usec, 0, 4);
        $merchantTransactionId = date('ymdHis', $sec) . $usec;

        $customer_full_name = $customer->profile->fullName;
        $currency = 'JOD';
        $url = config('services.hyperpay.endpoint');

        $data = [
            'entityId' => config('services.hyperpay.entity_id'),
            'amount' => $amount,
            'currency' => $currency,
            'paymentType' => 'DB',
            'merchantTransactionId' => $merchantTransactionId,
            'merchantInvoiceId' => $order->id,
            'customer.email' => $customer->profile && $customer->profile->email ? $customer->profile->email : 'order@dhifaf-baghdad.com',
            'customer.givenName' => $customer_full_name,
            'customer.surname' => 'Mr' . $customer_full_name,
            'billing.street1' => 'st',
            'billing.city' => 'amman',
            'billing.state' => 'amman',
            'billing.country' => 'JO',
            'billing.postcode' => '11554',
        ];

        foreach ($customer->paymentCards as $key => $value) {
            $data['registrations[' . $key . '].id'] = $value->token;
        }

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [config('services.hyperpay.token'),]);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, config('services.hyperpay.ssl_verify_peer')); // this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
        } catch (\Exception $ex) {
            return $this->errorResponse(66, 'Hyperpay error', 200, $ex->getMessage());
        }
        $response = json_decode($response, true);

        $response['OPPProviderMode'] = 1;
        $response['merchant_transaction_id'] = $merchantTransactionId;
        $response['payment_url'] = config('services.guzzle.base_url') . 'api/customer/payment?id=' . $response['id'];

        $transaction = new CustomerTransaction();
        $transaction->customer_id = $customer->id;
        $transaction->merchant_transaction_id = $merchantTransactionId;
        $transaction->status = TransactionStatus::Pending;
        $transaction->total_cost = $amount;
        $transaction->save();

        return $this->successResponse(200, 'PaymentData', 200, $response);
    }

    public function getPaymentStatus(Request $request, Order $order)
    {
        $url = config('services.hyperpay.endpoint') . '/' . $request->checkout_id . '/payment?entityId=' . config('services.hyperpay.entity_id');
        $customer = auth()->user();
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [config('services.hyperpay.token'),]);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, config('services.hyperpay.ssl_verify_peer')); // this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
        } catch (\Exception $ex) {
            return $this->errorResponse(66, 'Hyperpay error', 200, $ex->getMessage());
        }
        $response = json_decode($response, true);
        $response['url'] = $url;

        $code = $response['result']['code'];

        try {
            if (CustomerPaymentCard::where('customer_id', $customer->id)->where('token', $response['registrationId'])->count() == 0) {
                $paymentCard = new CustomerPaymentCard();
                $paymentCard->customer_id = $customer->id;
                $paymentCard->token = $response['registrationId'];
                $paymentCard->bin = $response['card']['bin'];
                $paymentCard->binCountry = $response['card']['binCountry'];
                $paymentCard->last4Digits = $response['card']['last4Digits'];
                $paymentCard->holder = $response['card']['holder'];
                $paymentCard->expiryMonth = $response['card']['expiryMonth'];
                $paymentCard->expiryYear = $response['card']['expiryYear'];
                $paymentCard->save();
            }
        } catch (\Exception $e) {
            //
        }

        if (preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $code) || preg_match('/^(000\.400\.0[^3]|000\.400\.100)/', $code)) {
            $data = [
                'status' => 'success',
                'message' => 'تمت عملية الدفع بنجاح',
                'data' => $response,
            ];

            $order->status = OrderStatus::Paid;
            $order->save();

            return $this->successResponse(200, 'PaymentStatus', 200, $data);
        } else {
            $data = [
                'status' => 'fail',
                'message' => $response['result']['description'],
                'data' => $response,
            ];
            return $this->successResponse(77, 'PaymentStatus', 200, $data);
        }
    }

    public function getPaymentStatusRes(Request $request)
    {
        $url = config('services.hyperpay.endpoint') . '/' . $request->id . '/payment?entityId=' . config('services.hyperpay.entity_id');

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [config('services.hyperpay.token'),]);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, config('services.hyperpay.ssl_verify_peer')); // this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
        } catch (\Exception $ex) {
            return $this->errorResponse(66, 'Hyperpay error', 200, $ex->getMessage());
        }

        $response = json_decode($response, true);

        $code = $response['result']['code'];
        $data = [];

        if (preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $code) || preg_match('/^(000\.400\.0[^3]|000\.400\.100)/', $code)) {

            $order = Order::find($response['merchantInvoiceId']);

            $transaction = CustomerTransaction::where('customer_id', $order->customer->id)
                ->where('merchant_transaction_id', $response['merchantInvoiceId'])->first();

            if ($transaction) {
                $transaction->status =  TransactionStatus::Success;
                $transaction->save();
            }

            $data = [
                'status' => 'success',
                'message' => 'تمت عملية الدفع بنجاح',
                'data' => $response,
            ];

            $order->status = OrderStatus::Paid;
            $order->save();


            $data = json_encode($data);
            return view('payment.payment_status', compact(['data']));
        } else {
            $data = [
                'status' => 'fail',
                'message' => $response['result']['description'],
                'data' => $response,
            ];

            $data = json_encode($data);
            return view('payment.payment_status', compact(['data']));
        }
    }

    public function payment()
    {
        return view('payment.payment_form');
    }

    public function paymentStatus(Request $request)
    {
        return redirect()->route('getPaymentStatusRes', ['id' => $request->id, 'request' => $request]);
    }
}
