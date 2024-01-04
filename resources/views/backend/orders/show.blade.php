{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','App Invoice View' )

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-invoice.css')}}">
@endsection

{{-- page content --}}
@section('content')
<!-- app invoice View Page -->
<section class="invoice-view-wrapper section">
    <div class="row">
        <!-- invoice view page -->
        <div class="col xl12    ">
            <div class="card">
                <div class="card-content invoice-print-area">
                    <div class="row invoice-date-number">
                        <div class="col xl4 s12">
                            <span class="invoice-number mr-1">Order#</span>
                            <span>{{ $order->order_number }}</span>
                        </div>
                        <div class="col xl8 s12">
                            <div class="invoice-date display-flex align-items-center flex-wrap">
                                <div class="mr-3">
                                    <small>Date Issue:</small>
                                    <span>{{ $order->created_at->format('Y-m-d') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- logo and title -->
                    <div class="row mt-3 invoice-logo-title">
                        <div class="col m6 s12 display-flex invoice-logo mt-1 push-m6">
                            {{-- <img src="{{asset('images/logo/ic_launcher.png')}}" alt="logo" height="46" width="164">
                            --}}
                        </div>
                        <div class="col m6 s12 pull-m6">
                            <h4 class="indigo-text">Order</h4>
                            <span>
                                @if ($order->status)
                                {{ App\Enums\OrderStatus::fromValue($order->status)->description}}
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="divider mb-3 mt-3"></div>
                    <!-- invoice address and contact -->
                    <div class="row invoice-info">
                        <div class="col m12 s12 m6 l6">
                            <h6 class="invoice-from">Customer Information</h6>
                            <div class="invoice-address">
                                <span>Name: {{ $order->customer->profile->fullname }}</span>
                            </div>
                            <div class="invoice-address">
                                <span>PhoneNumber: {{ $order->customer->username }}</span>
                            </div>
                            <div class="invoice-address">
                                <span>Email: {{ $order->customer->email }}</span>
                            </div>
                        </div>
                        {{-- <div class="col m12 s12 m6 l6">
                            <h6 class="invoice-from">Customer Address</h6>
                            @if($order->city->count() > 0)
                            <div class="invoice-address">
                                <span>city: {{ $order->city->translateOrDefault()->name ?? 'null'}}</span>
                            </div>
                            <div class="invoice-address">
                                <span>area: {{ $order->area->translateOrDefault()->name ?? 'null'}}</span>
                            </div>
                            <div class="invoice-address">
                                <span>street_address: {{ $order->street_address }}</span>
                            </div>
                            <div class="invoice-address">
                                <span>building_number: {{ $order->building_number }}</span>
                            </div>
                            <div class="invoice-address">
                                <span>apartment_number: {{ $order->apartment_number }}</span>
                            </div>
                            <div class="invoice-address">
                                <span>zip: {{ $order->zip }}</span>
                            </div>
                            <div class="invoice-address">
                                <span>additional_info: {{ $order->additional_info }}</span>
                            </div>
                            @else
                            <div class="invoice-address">
                                <span>city: {{ $order->address->city->translateOrDefault()->name ?? 'null'}}</span>
                            </div>
                            <div class="invoice-address">
                                <span>area: {{ $order->address->area->translateOrDefault()->name ?? 'null'}}</span>
                            </div>
                            <div class="invoice-address">
                                <span>street_address: {{ $order->address->street_address }}</span>
                            </div>
                            <div class="invoice-address">
                                <span>building_number: {{ $order->address->building_number }}</span>
                            </div>
                            <div class="invoice-address">
                                <span>apartment_number: {{ $order->address->apartment_number }}</span>
                            </div>
                            <div class="invoice-address">
                                <span>zip: {{ $order->address->zip }}</span>
                            </div>
                            <div class="invoice-address">
                                <span>additional_info: {{ $order->aaddress->dditional_info }}</span>
                            </div>
                            @endif
                        </div> --}}
                    </div>
                    <div class="divider mb-3 mt-3"></div>
                    <!-- product details table-->
                    <div class="invoice-product-details">
                        <table class="striped responsive-table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th class="right-align">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                <tr>
                                    <td>1</td>
                                    <td>{{ $item->product->translateOrDefault()->title }}</td>
                                    <td>{{ $item->qty}}</td>
                                    <td class="indigo-text right-align">{{ $item->price }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- invoice subtotal -->
                    <div class="divider mt-3 mb-3"></div>
                    <div class="invoice-subtotal">
                        <div class="row">
                            <div class="col m5 s12">
                            </div>
                            <div class="col xl4 m7 s12 offset-xl3">
                                <ul>
                                    <li class="display-flex justify-content-between">
                                        <span class="invoice-subtotal-title">Subtotal</span>
                                        <h6 class="invoice-subtotal-value">{{ $order->total_cost }}</h6>
                                    </li>
                                    <li class="display-flex justify-content-between">
                                        <span class="invoice-subtotal-title">Tax</span>
                                        <h6 class="invoice-subtotal-value">{{ $order->tax }}</h6>
                                    </li>
                                    <li class="display-flex justify-content-between">
                                        <span class="invoice-subtotal-title">Delivery Total</span>
                                        <h6 class="invoice-subtotal-value">{{ $order->delivery_total }}</h6>
                                    </li>
                                    <li class="display-flex justify-content-between">
                                        <span class="invoice-subtotal-title">Discount</span>
                                        <h6 class="invoice-subtotal-value">{{ $order->discount }}</h6>
                                    </li>
                                    <li class="display-flex justify-content-between">
                                        <span class="invoice-subtotal-title">Total</span>
                                        <h6 class="invoice-subtotal-value">{{ $order->total_cost }}</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                        <!-- header section -->
                        <div class="row">
                            <form class="formValidate0" id="formValidate0" method="POST"
                                action="{{ route('admin.order.update', $order->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="input-field col s6">
                                        {!! Form::select('driver_id', $drivers, $order->driver_id ?? null, ['placeholder' =>
                                        'All Drivers', 'id' => 'driver_id'])
                                        !!}
                                        <label>{{ __('Driver') }}<span class="text-red"></span></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <button class="btn cyan waves-effect waves-light right" type="submit"
                                            name="action">Assign
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/app-invoice.js')}}"></script>
@endsection
