<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Edit Order</h2>
    </div>
    <!-- End Box Head -->
    <form action="{{url('orders/'.$order->id)}}" method="post">
        {{ method_field('PUT') }}
        @csrf
        <!-- Form -->
        <div class="form">
            <input type="hidden" id="id" name="id" value="{{$order->id}}">
            <p> <span class="req">max 50 symbols</span>
                <label>Customer name <span>(Required Field)</span></label>
                <input type="text" class="field size1" id="name" name="name" value="{{$customer->name}}"/>
            </p>
            <p> <span class="req">max 10 symbols</span>
                <label>Customer phone <span>(Required Field)</span></label>
                <input type="text" class="field size1" id="phone" name="phone" value="{{$customer->phone}}"/>
            </p>
            <p>
                <label>Customer email <span></span></label>
                <input type="email" class="field size1" id="email" name="email" value="{{$customer->email}}"/>
            </p>
            <p class="inline-field">
                <label>Recipient address <span>(Required Field)</span></label>
                <input type="text" class="field size1" id="recipient_address" name="recipient_address" value="{{$recipientAddress->address}}">
            </p>
            <p class="inline-field">
                <label>Shipping address <span>(Required Field)</span></label>
                <input type="text" class="field size1" id="shipping_address" name="shipping_address" value="{{$shippingAddress->address}}">
            </p>
            <p class="inline-field">
                <label>Shipping date <span>(Required Field)</span></label>
                <input type="date" class="field size1" id="shipping_date" name="shipping_date" value="{{$order->shipping_date}}">
            </p>
            <p class="inline-field">
                <label>Expected delivery date <span>(Required Field)</span></label>
                <input type="date" class="field size1" id="expected_delivery_date" name="expected_delivery_date" value="{{$order->expected_delivery_date}}">
            </p>
        </div>
        <!-- End Form -->
        <!-- Form Buttons -->
        <div class="buttons">
            {{--            <input type="button" class="button" value="preview" />--}}
            <input type="submit" class="button" value="update" />
        </div>
        <!-- End Form Buttons -->
    </form>
</div>
