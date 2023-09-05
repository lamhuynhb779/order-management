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
            <h1><a href="{{url('/home')}}">Order Management</a></h1>
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
                        <h2 class="left">Order list</h2>
                    </div>
                    <!-- End Box Head -->
                    <!-- Table -->
                    <div class="table">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <th width="13"><input type="checkbox" class="checkbox" /></th>
                                <th>Order number</th>
                                <th>Customer name</th>
                                <th>Shipping date</th>
                                <th>Expected delivery date</th>
                                <th class="ac">Actions</th>
                            </tr>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            @foreach ($orders as $key => $order)
                                <tr class="{{ $key % 2 === 0 ? '' : 'odd' }}">
                                    <td><input type="checkbox" class="checkbox" /></td>
                                    <td><h3><a href="{{url('orders/view/' . $order->id)}}">{{$order->code}}</a></h3></td>
                                    <td>{{$order->customer->name}}</td>
                                    <td>{{$order->shipping_date}}</td>
                                    <td>{{$order->expected_delivery_date}}</td>
                                    <td>
                                        <a href="#" class="ico del" data-id="{{$order->id}}">Delete</a>
                                        <a href="{{url('orders/edit/' . $order->id)}}" class="ico edit">Edit</a>
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
                <!-- Box -->
                <x-add-order/>
                <!-- End Box -->
            </div>
            <!-- End Content -->
            <!-- Sidebar -->
            <div id="sidebar">
                <!-- Box -->
                <x-action-management/>
                <!-- End Box -->
            </div>
            <!-- End Sidebar -->
            <div class="cl">&nbsp;</div>
        </div>
        <!-- Main -->
    </div>
</div>
<!-- End Container -->
<!-- Footer -->
<div id="footer">
    <div class="shell"> <span class="left">&copy; 2010 - CompanyName</span> <span class="right"> Design by <a href="http://chocotemplates.com">Chocotemplates.com</a> </span> </div>
</div>
<!-- End Footer -->
</body>
<script src="{{ asset('js/order.js')}}"></script>
</html>
