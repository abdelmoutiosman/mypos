@extends('layouts.dashboard.app')
@inject('category','App\Category')
@inject('model', 'App\Product')
@section('content')
@section('page_title')
    {{__('messages.products')}}
@endsection
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('messages.List Of Products')}} <small>{{$products->total()}}</small></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="filter">
                {!! Form::open([
                            'action'=>'Dashboard\ProductController@index',
                            'id'=>'myForm',
                            'role'=>'form',
                            'method'=>'GET',
                            ])!!}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::text('search',request()->input('search'),[
                                'class'=>'form-control',
                                'placeholder' =>__('messages.search'),
                                'value'=>request()->input('search')
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::select('category_id',$category->pluck('name','id'),null,[
                                'class'=>'form-control',
                                'placeholder' =>__('messages.categories'),
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-flat bg-navy"><i class="fa fa-search"></i></button>
                            @if(auth()->user()->hasPermission('create_products'))
                            <a href="{{url(route('dashboard.products.create'))}}" class="btn btn-flat bg-navy"><i class="fa fa-plus"></i> {{__('messages.New Product')}}</a>
                            @else
                            <a href="#" class="btn btn-flat bg-navy disabled"><i class="fa fa-plus"></i> {{__('messages.New Product')}}</a>
                            @endif
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            @include('flash::message')
            @if(count($products))
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="bg-info">
                            <th class="text-center">#</th>
                            <th class="text-center">@lang('messages.name')</th>
                            <th class="text-center">{{trans('messages.Description')}}</th>
                            <th class="text-center">{{__('messages.category')}}</th>
                            <th class="text-center">{{__('messages.image')}}</th>
                            <th class="text-center">{{__('messages.purchase_price')}}</th>
                            <th class="text-center">{{__('messages.sale_price')}}</th>
                            <th class="text-center">{{__('messages.profit_percent')}} %</th>
                            <th class="text-center">{{__('messages.stock')}}</th>
                            <th class="text-center">{{__('messages.Edit')}}</th>
                            <th class="text-center">{{__('messages.delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr id="removable{{$product->id}}">
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">{{$product->name}}</td>
                                <td class="text-center">{!! $product->description !!}</td>
                                <td class="text-center">{{$product->category->name}}</td>
                                <td class="text-center"><img src="{{ $product->image_path }}" style="height:100px;width: 30%" class="img-thumbnail"></td>
                                <td class="text-center">{{$product->purchase_price}}</td>
                                <td class="text-center">{{$product->sale_price}}</td>
                                <td class="text-center">{{$product->profit_percent}} %</td>
                                <td class="text-center">{{$product->stock}}</td>
                                @if(auth()->user()->hasPermission('update_products'))
                                <td class="text-center">
                                    <a href="{{url(route('dashboard.products.edit',$product->id))}}" class="btn btn-success"><i class="fa fa-edit btn-xs"></i>
                                        {{__('messages.Edit')}}</a>
                                </td>
                                @else
                                    <td class="text-center">
                                        <button class="btn btn-success disabled"><i class="fa fa-edit btn-xs"></i> {{__('messages.Edit')}}</button>
                                    </td>
                                @endif
                                @if(auth()->user()->hasPermission('delete_products'))
                                <td class="text-center">
                                    {!! Form::model($model,[
                                            'action'=>['Dashboard\ProductController@destroy',$product->id],
                                            'method'=>'delete'
                                        ]) !!}
                                    <button id="{{$product->id}}" data-token="{{ csrf_token() }}"
                                            data-route="{{URL::route('dashboard.products.destroy',$product->id)}}"
                                            type="button" class="destroy btn btn-danger"><i
                                                class="fa fa-trash-o"></i> @lang('messages.delete')</button>
                                    {!! Form::close() !!}
                                </td>
                                @else
                                    <td class="text-center">
                                    <button class="btn btn-danger disabled"><i class="fa fa-trash-o"></i> @lang('messages.delete')</button>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$products->appends(request()->query())->links()}}
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    {{__('messages.NoData')}}
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
