@extends('layouts.dashboard.app')
@inject('model', 'App\Order')
@section('content')
@section('page_title')
    {{__('messages.orders')}}
@endsection
<section class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 10px">@lang('messages.orders') <small>{{$orders->total()}}</small></h3>
                    <form action="{{ route('dashboard.orders.index') }}" method="get">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" name="search" class="form-control" placeholder="@lang('messages.search')" value="{{ request()->search }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('messages.search')</button>
                            </div>
                        </div><!-- end of row -->
                    </form><!-- end of form -->
                </div><!-- end of box header -->
                @include('flash::message')
                @if ($orders->count() > 0)
                    <div class="box-body table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th>@lang('messages.client_name')</th>
                                <th>@lang('messages.price')</th>
                                {{--                                        <th>@lang('messages.status')</th>--}}
                                <th>@lang('messages.created_at')</th>
                                <th>{{__('messages.show')}}</th>
                                <th>{{__('messages.Edit')}}</th>
                                <th>{{__('messages.delete')}}</th>
                            </tr>
                            @foreach ($orders as $order)
                                <tr id="removable{{$order->id}}">
                                    <td>{{ $order->client->name }}</td>
                                    <td>{{ number_format($order->total_price, 2) }}</td>
                                    {{--<td>--}}
                                    {{--<button--}}
                                    {{--data-status="@lang('messages.' . $order->status)"--}}
                                    {{--data-url="{{ route('dashboard.orders.update_status', $order->id) }}"--}}
                                    {{--data-method="put"--}}
                                    {{--data-available-status='["@lang('messages.processing')", "@lang('messages.finished') "]'--}}
                                    {{--class="order-status-btn btn {{ $order->status == 'processing' ? 'btn-warning' : 'btn-success disabled' }} btn-sm"--}}
                                    {{-->--}}
                                    {{--@lang('messages.' . $order->status)--}}
                                    {{--</button>--}}
                                    {{--</td>--}}
                                    <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm order-products" data-url="{{ route('dashboard.orders.products', $order->id) }}" data-method="get"><i class="fa fa-list"></i>
                                            @lang('messages.show')
                                        </button>
                                    </td>
                                    @if(auth()->user()->hasPermission('update_orders'))
                                        <td>
                                            <a href="{{url(route('dashboard.clients.orders.edit', ['client' => $order->client->id, 'order' => $order->id]))}}" class="btn btn-success"><i class="fa fa-edit btn-xs"></i>
                                                {{__('messages.Edit')}}</a>
                                        </td>
                                    @else
                                        <td>
                                            <button class="btn btn-success disabled"><i class="fa fa-edit btn-xs"></i> {{__('messages.Edit')}}</button>
                                        </td>
                                    @endif
                                    @if(auth()->user()->hasPermission('delete_orders'))
                                        <td>
                                            {!! Form::model($model,[
                                                    'action'=>['Dashboard\OrderController@destroy',$order->id],
                                                    'method'=>'delete'
                                                ]) !!}
                                            <button id="{{$order->id}}" data-token="{{ csrf_token() }}"
                                                    data-route="{{URL::route('dashboard.orders.destroy',$order->id)}}"
                                                    type="button" class="destroy btn btn-danger"><i
                                                        class="fa fa-trash-o"></i> @lang('messages.delete')</button>
                                            {!! Form::close() !!}
                                        </td>
                                    @else
                                        <td>
                                            <button class="btn btn-danger disabled"><i class="fa fa-trash-o"></i> @lang('messages.delete')</button>
                                        </td>
                                    @endif
{{--                                        @if (auth()->user()->hasPermission('update_orders'))--}}
{{--                                            <a href="{{ route('dashboard.clients.orders.edit', ['client' => $order->client->id, 'order' => $order->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> @lang('messages.edit')</a>--}}
{{--                                        @else--}}
{{--                                            <a href="#" disabled class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> @lang('messages.edit')</a>--}}
{{--                                        @endif--}}
{{--                                        @if (auth()->user()->hasPermission('delete_orders'))--}}
{{--                                            <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="post" style="display: inline-block;">--}}
{{--                                                {{ csrf_field() }}--}}
{{--                                                {{ method_field('delete') }}--}}
{{--                                                <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> @lang('messages.delete')</button>--}}
{{--                                            </form>--}}
{{--                                        @else--}}
{{--                                            <a href="#" class="btn btn-danger btn-sm" disabled><i class="fa fa-trash"></i> @lang('messages.delete')</a>--}}
{{--                                        @endif--}}
                                </tr>
                            @endforeach
                        </table><!-- end of table -->
                        {{ $orders->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        {{__('messages.NoData')}}
                    </div>
                @endif
            </div><!-- end of box -->
        </div><!-- end of col -->
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 10px">@lang('messages.show_products')</h3>
                </div><!-- end of box header -->
                <div class="box-body">
                    <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                        <div class="loader"></div>
                        <p style="margin-top: 10px">@lang('messages.loading')</p>
                    </div>
                    <div id="order-product-list">

                    </div><!-- end of order product list -->
                </div><!-- end of box body -->
            </div><!-- end of box -->
        </div><!-- end of col -->
    </div><!-- end of row -->
</section><!-- end of content section -->
@endsection
