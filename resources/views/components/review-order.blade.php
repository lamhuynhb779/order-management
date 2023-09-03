<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Review</h2>
    </div>
    <!-- End Box Head -->
    <form action="{{url('orders/'.$order->id)}}" method="post">
        {{ method_field('PUT') }}
        @csrf
        <!-- Form -->
        <div class="form">
            <input type="hidden" id="id" name="id" value="{{$order->id}}" disabled>
            <p>
                <label>Order number</label>
                <input type="text" class="field size1" id="code" name="code" value="{{$order->code}}" disabled/>
            </p>
            <p>
                <label>State</label>
                <input type="text" class="field size1" id="state" name="state" value="{{\App\Helpers\Order\OrderHelper::getState($order->state_id)}}" disabled/>
            </p>
            <p>
                <label>Customer name</label>
                <input type="text" class="field size1" id="name" name="name" value="{{$customer->name}}" disabled/>
            </p>
            <p>
                <label>Customer phone</label>
                <input type="text" class="field size1" id="phone" name="phone" value="{{$customer->phone}}" disabled/>
            </p>
            <p>
                <label>Customer email</label>
                <input type="email" class="field size1" id="email" name="email" value="{{$customer->email}}" disabled/>
            </p>
            <p class="inline-field">
                <label>Recipient address</label>
                <input type="text" class="field size1" id="recipient_address" name="recipient_address" value="{{$recipientAddress->address}}" disabled>
            </p>
            <p class="inline-field">
                <label>Shipping address</label>
                <input type="text" class="field size1" id="shipping_address" name="shipping_address" value="{{$shippingAddress->address}}" disabled>
            </p>
            <p class="inline-field">
                <label>Shipping date</label>
                <input type="date" class="field size1" id="shipping_date" name="shipping_date" value="{{$order->shipping_date}}" disabled>
            </p>
            <p class="inline-field">
                <label>Expected delivery date</label>
                <input type="date" class="field size1" id="expected_delivery_date" name="expected_delivery_date" value="{{$order->expected_delivery_date}}" disabled>
            </p>
        </div>
        <!-- End Form -->
    </form>
</div>
