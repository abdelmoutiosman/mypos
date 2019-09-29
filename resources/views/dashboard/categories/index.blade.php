@extends('layouts.dashboard.app')
@inject('model', 'App\Category')
@section('content')
@section('page_title')
    {{__('messages.categories')}}
@endsection
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('messages.List Of Categories')}} <small>{{$categories->total()}}</small></h3>
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
                            'action'=>'Dashboard\CategoryController@index',
                            'id'=>'myForm',
                            'role'=>'form',
                            'method'=>'GET',
                            ])!!}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::text('search',request()->input('search'),[
                                'class'=>'form-control',
                                'placeholder' =>__('messages.search'),
                                'value'=>request()->input('search')
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-flat bg-navy"><i class="fa fa-search"></i></button>
                            @if(auth()->user()->hasPermission('create_categories'))
                            <a href="{{url(route('dashboard.categories.create'))}}" class="btn btn-flat bg-navy"><i class="fa fa-plus"></i> {{__('messages.New Category')}}</a>
                            @else
                            <a href="#" class="btn btn-flat bg-navy disabled"><i class="fa fa-plus"></i> {{__('messages.New Category')}}</a>
                            @endif
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            @include('flash::message')
            @if(count($categories))
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="bg-info">
                            <th class="text-center">#</th>
                            <th class="text-center">@lang('messages.name')</th>
                            <th class="text-center">@lang('messages.products_count')</th>
                            <th class="text-center">@lang('messages.related_products')</th>
                            <th class="text-center">{{__('messages.Edit')}}</th>
                            <th class="text-center">{{__('messages.delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr id="removable{{$category->id}}">
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">{{$category->name}}</td>
                                <td class="text-center">{{$category->products->count()}}</td>
                                <td class="text-center">
                                    <a href="{{url(route('dashboard.products.index',['category_id'=>$category->id]))}}" class="btn btn-info btn-sm">{{__('messages.related_products')}}</a>
                                </td>
                                @if(auth()->user()->hasPermission('update_categories'))
                                <td class="text-center">
                                    <a href="{{url(route('dashboard.categories.edit',$category->id))}}" class="btn btn-success"><i class="fa fa-edit btn-xs"></i>
                                        {{__('messages.Edit')}}</a>
                                </td>
                                @else
                                    <td class="text-center">
                                        <button class="btn btn-success disabled"><i class="fa fa-edit btn-xs"></i> {{__('messages.Edit')}}</button>
                                    </td>
                                @endif
                                @if(auth()->user()->hasPermission('delete_categories'))
                                <td class="text-center">
                                    {!! Form::model($model,[
                                            'action'=>['Dashboard\CategoryController@destroy',$category->id],
                                            'method'=>'delete'
                                        ]) !!}
                                    <button id="{{$category->id}}" data-token="{{ csrf_token() }}"
                                            data-route="{{URL::route('dashboard.categories.destroy',$category->id)}}"
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
                    {{$categories->appends(request()->query())->links()}}
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
