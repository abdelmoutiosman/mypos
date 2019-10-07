@extends('layouts.dashboard.app')
@inject('category', 'App\Category')
@section('content')
@section('page_title')
    {{__('messages.Edit Product')}}
@endsection
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('messages.Form TO Edit product')}}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            @include('partials.validation_errors')
            {!! Form::model($record,[
                    'action'=>['Dashboard\ProductController@update',$record->id],
                    'method'=>'put',
                    'files'=>'true'
                ]) !!}
            <div class="form-group">
                <label for="name">{{__('messages.name')}}</label>
                {!! Form::text('name',null,[
                    'class'=>'form-control',
                ]) !!}
            </div>
            <div class="form-group">
                <label for="description">{{__('messages.Description')}}</label>
                {!! Form::textarea('description',null,[
                    'class'=>'form-control ckeditor',
                ]) !!}
            </div>
            <div class="form-group">
                <label for="category_id">{{__('messages.category')}}</label>
                {!! Form::select('category_id',$category->pluck('name','id'),null,[
                    'class'=>'form-control',
                ]) !!}
            </div>
            <div class="form-group">
                <label for="image">{{__('messages.image')}}</label>
                <input type="file" name="image" class="form-control image">
            </div>
            <div class="form-group">
                <img src="{{$record->image_path}}" class="img-thumbnail image-preview" style="height: 120px">
            </div>
            <div class="form-group">
                <label for="purchase_price">{{__('messages.purchase_price')}}</label>
                {!! Form::number('purchase_price',null,[
                    'class'=>'form-control',
                    'step'=>'0.01',
                ]) !!}
            </div>
            <div class="form-group">
                <label for="sale_price">{{__('messages.sale_price')}}</label>
                {!! Form::number('sale_price',null,[
                    'class'=>'form-control',
                    'step'=>'0.01',
                ]) !!}
            </div>
            <div class="form-group">
                <label for="stock">{{__('messages.stock')}}</label>
                {!! Form::number('stock',null,[
                    'class'=>'form-control',
                ]) !!}
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit"><i class="fa fa-edit btn-xs"></i> {{__('messages.Edit')}}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>
@endsection

