<div id="navigation">
    <ul>
        @can('view homepage')
        <li><a href="{{ url('/home') }}" class="active"><span>Home page</span></a></li>
        @endcan

        @can('view order management')
        <li><a href="{{ url('/orders') }}"><span>Order management</span></a></li>
        @endcan

        @can('view state management')
        <li><a href="{{ url('/order-states') }}"><span>State Management</span></a></li>
        @endcan
    </ul>
</div>
