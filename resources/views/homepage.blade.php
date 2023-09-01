<!doctype html>
<html lang="vi">
<head>
    <title>Order Management</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    {{--    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />--}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" media="all">
    <script src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
    <!-- 1. Addchat css -->
    <link href="{{asset('assets/addchat/css/addchat.min.css')}}" rel="stylesheet">
</head>
<body>
<!-- 2. AddChat widget -->
<div id="addchat_app"
     data-baseurl="{{url('')}}"
     data-csrfname="{{'X-CSRF-Token'}}"
     data-csrftoken="{{csrf_token()}}"
></div>
<!-- Header -->
<div id="header">
    <div class="shell">
        <!-- Logo + Top Nav -->
        <div id="top">
            <h1><a href="#">SpringTime</a></h1>
            <div id="top-navigation"> Welcome <a href="#"><strong>Administrator</strong></a> <span>|</span> <a href="#">Help</a> <span>|</span> <a href="#">Profile Settings</a> <span>|</span> <a href="#">Log out</a> </div>
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
                        <h2 class="left">Shipping Orders</h2>
                        <div class="right">
                            <select name="search-options" id="search-options" class="field small-field left">
                                <option value="order_number">Order number</option>
                                <option value="customer_name">Customer name</option>
                                <option value="shipping_date">Shipping date</option>
                            </select>
                            <input type="text" class="field small-field" id="search-value"/>
                            <input type="date" class="field small-field" id="search-date"/>
                            <input type="submit" class="button-search" value="search" />
                        </div>
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
                                <th>State</th>
                            </tr>
                            <tbody id="order-list">
                            @foreach ($orders as $key => $order)
                                <tr class="{{ $key % 2 === 0 ? '' : 'odd' }}">
                                    <td><input type="checkbox" class="checkbox" /></td>
                                    <td><h3><a href="{{url('orders/' . $order->id)}}">{{$order->code}}</a></h3></td>
                                    <td>{{$order->customer->name}}</td>
                                    <td>{{$order->shipping_date}}</td>
                                    <td>{{$order->expected_delivery_date}}</td>
                                    <td>{{\App\Helpers\Order\OrderHelper::getState($order->state_id)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
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
            <!-- Sidebar -->
            <!-- End Sidebar -->
            <div class="cl">&nbsp;</div>
        </div>
        <!-- Main -->
    </div>
</div>
<!-- End Container -->
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
<!-- 3. AddChat JS -->
<!-- Modern browsers -->
<script type="module" src="{{asset('assets/addchat/js/addchat.min.js')}}"></script>
<!-- Fallback support for Older browsers -->
<script nomodule src="{{asset('assets/addchat/js/addchat-legacy.min.js')}}"></script>
</body>
<script src="{{ asset('js/common.js')}}"></script>
<script src="{{ asset('js/homepage.js')}}"></script>
</html>
