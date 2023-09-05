<!doctype html>
<html lang="vi">
<head>
    <title>Order Management</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    {{--    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />--}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" media="all">
    <script src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
</head>
<body>
<!-- Header -->
<div id="header">
    <div class="shell">
        <!-- Logo + Top Nav -->
        <div id="top">
            <h1><a href="#">Order Management</a></h1>
            <x-user-navbar/>
        </div>
        <!-- End Logo + Top Nav -->
        <!-- Main Nav -->
        <x-menu/>
        <!-- End Main Nav -->
    </div>
</div>
<!-- End Header -->
<!-- Container -->
<div id="container">
    <div class="shell">
        <!-- Message OK -->
        @if (\Session::has('success'))
            <div class="msg msg-ok">
                <p><strong>{!! \Session::get('success') !!}</strong></p>
                <a href="#" class="close">close</a>
            </div>
        @endif
        <!-- End Message OK -->
        <!-- Message Error -->
        @if (\Session::has('error'))
            <div class="msg msg-error">
                <p><strong>{!! \Session::get('error') !!}</strong></p>
                <a href="#" class="close">close</a>
            </div>
        @endif
        <!-- End Message Error -->
        <br />
        <!-- Main -->
        <div id="main">
            <div class="cl">&nbsp;</div>
            <!-- Content -->
            <div id="content">
                <!-- Box -->
                <div class="box">
                    <!-- Box Head -->
                    <div class="box-head">
                        <h2 class="left">State management</h2>
                    </div>
                    <!-- End Box Head -->
                    <!-- Table -->
                    <div class="table">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <th>Order number</th>
                                <th>Customer name</th>
                                <th>Shipping date</th>
                                <th>Expected delivery date</th>
                                <th>State</th>
                                <th>Action</th>
                            </tr>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            @foreach ($orders as $key => $order)
                                <tr class="{{ $key % 2 === 0 ? '' : 'odd' }}">
                                    <td><h3><a href="{{url('orders/view/' . $order->id)}}">{{$order->code}}</a></h3></td>
                                    <td>{{$order->customer->name}}</td>
                                    <td>{{$order->shipping_date}}</td>
                                    <td>{{$order->expected_delivery_date}}</td>
                                    <td>
                                        <select name="state-options" id="state-options" class="field small-field left">
                                            @foreach($states as $state)
                                                @if($state->id === $order->state_id || $state->id === ($order->state_id + 1))
                                                    <option value="{{$state->id}}" {{$order->state_id === $state->id ? 'selected': ''}}>{{$state->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        @if ($order->state_id === 6)
                                            <a class="ico" id="review-add-btn" data-id="{{$order->id}}">Rating</a>
                                        @else
                                            <a class="ico btn-update" data-id="{{$order->id}}" data-state="{{$order->state_id}}">Update</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <!-- Pagging -->
                        <div class="pagging">
                            <div class="left">Showing 1-12 of 44</div>
                            <div class="right"> <a href="#">Previous</a> <a href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> <a href="#">245</a> <span>...</span> <a href="#">Next</a> <a href="#">View all</a> </div>
                        </div>
                        <!-- End Pagging -->
                    </div>
                    <!-- Table -->
                </div>
                <!-- End Box -->
            </div>
            <!-- End Content -->
            <div class="cl">&nbsp;</div>
        </div>
        <!-- Main -->
    </div>
</div>
<!-- End Container -->
<x-rating />
<!-- Footer -->
<div id="footer" style="
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;"
>
    <div class="shell"> <span class="left">&copy; 2010 - CompanyName</span> <span class="right"> Design by <a href="http://chocotemplates.com">Chocotemplates.com</a> </span> </div>
</div>
<!-- End Footer -->
</body>
<script src="{{ asset('js/order.js')}}"></script>
</html>
