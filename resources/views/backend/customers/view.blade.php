@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', $customer->profile->full_name .' View')
{{-- vendor style --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/flag-icon/css/flag-icon.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/dropify/css/dropify.min.css') }}">
@endsection

{{-- page content --}}
@section('content')
<div class="row">
    <div class="col s12">
        <div id="html-validations" class="card card-tabs">
            <div class="card-content">
                <div class="card-title">
                    <div class="row">
                        <div class="col s12 m6 l10">
                            <h4 class="card-title">{{ $customer->profile->full_name .' profile' }}</h4>
                        </div>
                        <div class="col s12 m6 l2">
                        </div>
                    </div>
                </div>
                <div id="html-view-validations">
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="username">Phone number *</label>
                                <input class="validate" disabled value="{{ $customer->username }}" type="text">
                            </div>
                            <div class="input-field col s12">
                                <label for="email">E-Mail *</label>
                                <input id="email" name="email" disabled placeholder="Email" value="{{$customer->email}}"
                                    class="validate" type="email">
                            </div>
                            <div class="input-field col s12">
                                <label for="curl0">First name *</label>
                                <input type="text" disabled value="{{ $customer->profile->first_name }}" class="validate"
                                    name="first_name">
                            </div>
                            <div class="input-field col s12">
                                <label for="curl0">Last name *</label>
                                <input type="text" disabled value="{{ $customer->profile->last_name }}" class="validate"
                                    name="last_name">
                            </div>
                            <div class="col s12">
                                <p>Gender</p>
                                <p>
                                    <label>
                                        <input disabled class="validate" name="gender" type="radio" value="1"
                                            @if($customer->profile->gender && $customer->profile->gender ===
                                        App\Enums\GenderTypes::Male)
                                        checked
                                        @endif />
                                        <span>Male</span>
                                    </label>
                                </p>
                                <label>
                                    <input disabled class="validate" name="gender" type="radio" value="2"
                                        @if($customer->profile->gender && $customer->profile->gender ===
                                    App\Enums\GenderTypes::Female)
                                    checked
                                    @endif />
                                    <span>Female</span>
                                </label>
                                <div class="input-field">
                                </div>
                            </div>
                            <div class="col s12">
                                <label for="Image">Image</label>
                                <div class="s12 input-field">
                                    <input type="file" disabled name="image" id="input-file-events" class="dropify-event"
                                        data-default-file="{{ asset('storage') . '/' .$customer->profile->image }}"
                                        accept="image/*" />
                                </div>
                            </div>
                            <div class="col s12">
                                <label for="status">Status</label>
                                <div class="s12 input-field">
                                    <div class="switch">
                                        <label>
                                            Block
                                            <input disabled type="checkbox" name="is_blocked" id="status"
                                                @if(!$customer->is_blocked) checked @endif>
                                            <span class="lever"></span>
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="section section-data-tables">
    <div class="row">
        <div class="col s12 m12 l12">
            <div id="button-trigger" class="card card card-default scrollspy">
                <div class="card-content">
                    <h4 class="card-title">{{ __('List') }}</h4>
                    <div class="row">
                        <div class="col s12">
                            <table id="scroll-dynamic" class="display">
                                <thead>
                                    <tr>
                                        <th>{{ __('#')}}</th>
                                        <th>{{ __('Order Number') }}</th>
                                        <th>{{ __('Driver Name')}}</th>
                                        {{-- <th>{{ __('Coupon')}}</th> --}}
                                        <th>{{ __('Order Date')}}</th>
                                        <th>{{ __('Finished')}}</th>
                                        <th>{{ __('Status')}}</th>
                                        <th>{{ __('Total Cost') }}</th>
                                        <th class="no-sort">{{ __('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td> {{ $item->order_number }} </td>
                                            <td>
                                                {{ $item->driver->fullname ?? 'this order is not assigned to a driver'}}
                                            </td>
                                            {{-- <td>
                                                @if ($item->coupon()->count())
                                                    <span class="chip lighten-5 blue blue-text">
                                                        {{ $item->coupon->code }}
                                                    </span>
                                                @else
                                                    <span class="chip lighten-5 green green-text">No coupon used</span>
                                                @endif
                                            </td> --}}
                                            <td>
                                                <span>{{$item->created_at->format('d/m/Y')}}</span>
                                            </td>
                                            <td>
                                                @if ($item->is_finished)
                                                    <span class="chip lighten-5 green green-text">Yes</span>
                                                @else
                                                    <span class="chip lighten-5 red red-text">No</span>
                                                @endif

                                            </td>
                                            <td>
                                                @if ($item->status)
                                                {{ App\Enums\OrderStatus::fromValue($item->status)->description}}
                                                @endif
                                            </td>
                                            <td>
                                                <span>{{$item->total_cost}}</span>
                                            </td>
                                            <td class="center-align">
                                                <a href="{{ route('admin.order.show', $item) }}" class="btn-floating cyan pulse"><i class="material-icons">visibility</i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- vendor script --}}
@section('vendor-script')
<script src="{{ asset('vendors/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('vendors/jquery-validation/jquery.validate.min.js') }}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{ asset('js/scripts/form-file-uploads.js') }}"></script>
<script src="{{ asset('js/scripts/form-validation.js') }}"></script>
@endsection
