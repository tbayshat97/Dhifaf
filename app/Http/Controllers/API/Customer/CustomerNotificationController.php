<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerNotificationCollection;
use App\Models\CustomerNotification;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class CustomerNotificationController extends Controller
{
    use ApiResponser;

    public function list()
    {
        $customer = auth()->user();
        $notifications = $customer->customerNotifications;
        return $this->successResponse(200, trans('api.public.done'), 200, new CustomerNotificationCollection($notifications));
    }

    public function deleteAll()
    {
        $customer = auth()->user();
        $customer->customerNotifications()->update(['is_deleted' => true]);
        return $this->successResponse(200, trans('api.public.done'), 200);
    }

    public function destroy(CustomerNotification $customerNotification)
    {
        if ($customerNotification->customer_id == auth()->user()->id) {
            $customerNotification->is_deleted = true;
            $customerNotification->save();
        }

        return $this->successResponse(200, trans('api.public.done'), 200);
    }

    public function receiveNotification(Request $request)
    {
        $customer = auth()->user();
        $customer->fcm_token = $request->fcm_token ? $request->fcm_token : null;
        $customer->save();
        return $this->successResponse(200, trans('api.public.done'), 200, null);
    }
}
