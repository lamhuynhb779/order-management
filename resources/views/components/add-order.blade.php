<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Add New Order</h2>
    </div>
    <!-- End Box Head -->
    <form action="{{url('orders')}}" method="post">
        <!-- Form -->
        <div class="form">
            @csrf
            <p> <span class="req">max 50 symbols</span>
                <label>Customer name <span>(Required Field)</span></label>
                <input type="text" class="field size1" id="name" name="name"/>
            </p>
            <p> <span class="req">max 10 symbols</span>
                <label>Customer phone <span>(Required Field)</span></label>
                <input type="text" class="field size1" id="phone" name="phone"/>
            </p>
            <p>
                <label>Customer email <span></span></label>
                <input type="email" class="field size1" id="email" name="email"/>
            </p>
            <p class="inline-field">
                <label>Recipient address <span>(Required Field)</span></label>
                <input type="text" class="field size1" id="recipient_address" name="recipient_address">
            </p>
            <p class="inline-field">
                <label>Shipping address <span>(Required Field)</span></label>
                <input type="text" class="field size1" id="shipping_address" name="shipping_address">
            </p>
            <p class="inline-field">
                <label>Shipping date <span>(Required Field)</span></label>
                <input type="date" class="field size1" id="shipping_date" name="shipping_date">
            </p>
            <p class="inline-field">
                <label>Expected delivery date <span>(Required Field)</span></label>
                <input type="date" class="field size1" id="expected_delivery_date" name="expected_delivery_date">
            </p>
        </div>
        <!-- End Form -->
        <!-- Form Buttons -->
        <div class="buttons">
{{--            <input type="button" class="button" value="preview" />--}}
            <input type="submit" class="button" value="submit" />
        </div>
        <!-- End Form Buttons -->
    </form>
</div>
