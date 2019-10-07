<div id="print-area">
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>@lang('messages.name')</th>
            <th>@lang('messages.quantity')</th>
            <th>@lang('messages.price')</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>{{ number_format($product->pivot->quantity * $product->sale_price, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h3>@lang('messages.total') <span>{{ number_format($order->total_price, 2) }}</span></h3>
</div>

<button class="btn btn-block btn-primary print-btn"><i class="fa fa-print"></i> @lang('messages.print')</button>
