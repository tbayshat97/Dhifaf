<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\AddCustomerAddressRequest;
use App\Http\Requests\Customer\UpdateCustomerAddressRequest;
use App\Http\Resources\CustomerAddress as ResourcesCustomerAddress;
use App\Http\Resources\CustomerAddressCollection;
use App\Models\CustomerAddress;
use App\Traits\ApiResponser;

class CustomerAddressController extends Controller
{
    use ApiResponser;

    public function list()
    {
        $customer = auth()->user();

        $addresses = $customer->customerAddresses()->get();

        return $this->successResponse(200, trans('api.public.done'), 200, new CustomerAddressCollection($addresses));
    }

    public function show(CustomerAddress $customerAddress)
    {
        return $this->successResponse(200, trans('api.public.done'), 200, new ResourcesCustomerAddress($customerAddress));
    }

    public function store(AddCustomerAddressRequest $request)
    {
        auth()->user()->customerAddresses()->update(['is_active' => false]);

        $customerAddress = new CustomerAddress();

        $customerAddress->name = trim($request->name);
        $customerAddress->customer_id = auth()->user()->id;
        $customerAddress->city_id = $request->city;
        $customerAddress->area_id = $request->area;
        $customerAddress->governorate_id = $request->governorate;
        $customerAddress->mahala = ($request->has('mahala')) ? trim($request->mahala) : null;
        $customerAddress->zoqaq = ($request->has('zoqaq')) ? trim($request->zoqaq) : null;
        $customerAddress->dar = ($request->has('dar')) ? trim($request->dar) : null;
        $customerAddress->phone_number = ($request->has('phone_number')) ? trim($request->phone_number) : null;
        $customerAddress->is_active = true;
        $customerAddress->save();

        return $this->successResponse(200, trans('api.public.done'), 200, new ResourcesCustomerAddress($customerAddress));
    }

    public function update(UpdateCustomerAddressRequest $request, CustomerAddress $customerAddress)
    {
        $customerAddress->name = trim($request->name);
        $customerAddress->customer_id = auth()->user()->id;
        $customerAddress->city_id = trim($request->city);
        $customerAddress->governorate_id = trim($request->governorate);
        $customerAddress->mahala = ($request->has('mahala')) ? trim($request->mahala) : null;
        $customerAddress->zoqaq = ($request->has('zoqaq')) ? trim($request->zoqaq) : null;
        $customerAddress->dar = ($request->has('dar')) ? trim($request->dar) : null;
        $customerAddress->phone_number = ($request->has('phone_number')) ? trim($request->phone_number) : null;
        $customerAddress->is_active = true;
        $customerAddress->save();

        return $this->successResponse(200, trans('api.public.done'), 200, new ResourcesCustomerAddress($customerAddress));
    }

    public function setIsActive(CustomerAddress $customerAddress)
    {
        CustomerAddress::query()->where('customer_id', auth()->user()->id)->update(['is_active' => false]);

        $customerAddress->is_active = true;
        $customerAddress->save();

        return $this->successResponse(200, trans('api.public.done'), 200, new ResourcesCustomerAddress($customerAddress));
    }

    public function destroy(CustomerAddress $customerAddress)
    {
        if ($customerAddress) {
            $customerAddress->delete();
        }

        return $this->successResponse(200, trans('api.public.done'), 200, []);
    }
}
