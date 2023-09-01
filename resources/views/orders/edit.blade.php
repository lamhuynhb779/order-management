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
        <x-menu/>
        <!-- End Main Nav -->
    </div>
</div>
<!-- End Header -->
<!-- Container -->
<div id="container">
    <div class="shell">
        <!-- Small Nav -->
        <div class="small-nav"> <a href="{{ url('/orders') }}">Dashboard</a> <span>&gt;</span> Edit Order </div>
        <!-- End Small Nav -->
        <br />
        <!-- Main -->
        <div id="main">
            <div class="cl">&nbsp;</div>
            <!-- Content -->
            <div id="content">
                <!-- Box -->
                <!-- End Box -->
                <!-- Box -->
                <div class="edit-order-component">
                    <x-edit-order
                        :order="$order"
                        :customer="$customer"
                        :shippingAddress="$shippingAddress"
                        :recipientAddress="$recipientAddress"
                    />
                </div>
                <!-- End Box -->
            </div>
            <!-- End Content -->
            <!-- Sidebar -->
            <div id="sidebar">
                <!-- Box -->
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
</html>
