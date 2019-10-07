@extends('layouts.dashboard.app')
@section('content')
@section('page_title')
    {{__('messages.Create Order')}}
@endsection
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="margin-bottom: 10px">@lang('messages.categories')</h3>
                    </div><!-- end of box header -->
                    <div class="box-body">
                        @foreach ($categories as $category)
                            <div class="panel-group">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" href="#{{ str_replace(' ', '-', $category->name) }}">{{ $category->name }}</a>
                                        </h4>
                                    </div>
                                    <div id="{{ str_replace(' ', '-', $category->name) }}" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            @if ($category->products->count() > 0)
                                                <table class="table table-hover">
                                                    <tr>
                                                        <th>@lang('messages.name')</th>
                                                        <th>@lang('messages.stock')</th>
                                                        <th>@lang('messages.sale_price')</th>
                                                        <th>@lang('messages.add')</th>
                                                    </tr>
                                                    @foreach ($category->products as $product)
                                                        <tr>
                                                            <td>{{ $product->name }}</td>
                                                            <td>{{ $product->stock }}</td>
                                                            <td>{{ number_format($product->sale_price, 2) }}</td>
                                                            <td>
                                                                <a href=""
                                                                   id="product-{{ $product->id }}"
                                                                   data-name="{{ $product->name }}"
                                                                   data-id="{{ $product->id }}"
                                                                   data-price="{{ $product->sale_price }}"
                                                                   class="btn btn-success btn-sm add-product-btn">
                                                                    <i class="fa fa-plus"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table><!-- end of table -->
                                            @else
                                                <div class="alert alert-danger" role="alert">
                                                    {{__('messages.NoData')}}
                                                </div>
                                            @endif
                                        </div><!-- end of panel body -->
                                    </div><!-- end of panel collapse -->
                                </div><!-- end of panel primary -->
                            </div><!-- end of panel group -->
                        @endforeach
                    </div><!-- end of box body -->
                </div><!-- end of box -->
            </div><!-- end of col -->
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">@lang('messages.orders')</h3>
                    </div><!-- end of box header -->
                    <div class="box-body">
                        <form action="{{ route('dashboard.clients.orders.store', $client->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('post') }}
                            @include('partials.validation_errors')
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>@lang('messages.product')</th>
                                    <th>@lang('messages.quantity')</th>
                                    <th>@lang('messages.price')</th>
                                </tr>
                                </thead>
                                <tbody class="order-list">
                                </tbody>
                            </table><!-- end of table -->
                            <h4>@lang('messages.total') : <span class="total-price"></span></h4>
                            <button class="btn btn-primary btn-block disabled" id="add-order-form-btn"><i class="fa fa-plus"></i> @lang('messages.add_order')</button>
                        </form>
                    </div><!-- end of box body -->
                </div><!-- end of box -->
                    @if ($client->orders->count() > 0)
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title" style="margin-bottom: 10px">@lang('messages.previous_orders')
                                    <small>{{ $orders->total() }}</small>
                                </h3>
                            </div><!-- end of box header -->
                            <div class="box-body">
                                @foreach ($orders as $order)
                                    <div class="panel-group">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#{{ $order->created_at->format('d-m-Y-s') }}">{{ $order->created_at->toFormattedDateString() }}</a>
                                                </h4>
                                            </div>
                                            <div id="{{ $order->created_at->format('d-m-Y-s') }}" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <ul class="list-group">
                                                        @foreach ($order->products as $product)
                                                            <li class="list-group-item">{{ $product->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div><!-- end of panel body -->
                                            </div><!-- end of panel collapse -->
                                        </div><!-- end of panel primary -->
                                    </div><!-- end of panel group -->
                                @endforeach
                                {{ $orders->links() }}
                            @endif
                            </div><!-- end of box body -->
                        </div><!-- end of box -->
            </div><!-- end of col -->
        </div><!-- end of row -->
    </section><!-- end of content -->
@endsection
