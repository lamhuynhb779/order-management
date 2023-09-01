<!doctype html>
<html lang="vi">
<head>
    <title>Order Management</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    {{--    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />--}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" media="all">
</head>
<body>
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
        <div id="navigation">
            <ul>
                <li><a href="#" class="active"><span>Dashboard</span></a></li>
                <li><a href="#"><span>New Articles</span></a></li>
                <li><a href="#"><span>User Management</span></a></li>
                <li><a href="#"><span>Photo Gallery</span></a></li>
                <li><a href="#"><span>Products</span></a></li>
                <li><a href="#"><span>Services Control</span></a></li>
            </ul>
        </div>
        <!-- End Main Nav -->
    </div>
</div>
<!-- End Header -->
<!-- Container -->
<div id="container">
    <div class="shell">
        <!-- Small Nav -->
        <div class="small-nav"> <a href="#">Dashboard</a> <span>&gt;</span> Current Articles </div>
        <!-- End Small Nav -->
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
                        <h2 class="left">Current Articles</h2>
                        <div class="right">
                            <label>search articles</label>
                            <input type="text" class="field small-field" />
                            <input type="submit" class="button" value="search" />
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
                                <th class="ac">Expected delivery date</th>
                                <th class="ac">Actions</th>
                            </tr>
                            @foreach ($orders as $key => $order)
                                <tr class="{{ $key % 2 === 0 ? '' : 'odd' }}">
                                    <td><input type="checkbox" class="checkbox" /></td>
                                    <td><h3><a href="#">{{$order->code}}</a></h3></td>
                                    <td>{{$order->customer_name}}</td>
                                    <td>{{$order->shipping_date}}</td>
                                    <td>{{$order->expected_delivery_date}}</td>
                                    <td><a href="#" class="ico del">Delete</a><a href="{{url('orders/' . $order->id)}}" class="ico edit">Edit</a></td>
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
