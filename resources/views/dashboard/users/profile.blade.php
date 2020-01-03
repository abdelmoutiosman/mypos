@extends('layouts.dashboard.app')
@section('content')
@section('page_title')
{{__('messages.Edit Profile')}}
@endsection
<section class="content">
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{__('messages.Form To Edit Profile')}}</h3>
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
            {!! Form::model($model,[
                    'action'=>['Dashboard\UserController@update_profile',$model->id],
                    'method'=>'post',
                    'files'=>'true'
                ]) !!}
            <div class="form-group">
                <label for="first_name">{{__('messages.firstname')}}</label>
                {!! Form::text('first_name',null,[
                    'class'=>'form-control',
                ]) !!}
            </div>
            <div class="form-group">
                <label for="last_name">{{__('messages.lastname')}}</label>
                {!! Form::text('last_name',null,[
                    'class'=>'form-control',
                ]) !!}
            </div>
            <div class="form-group">
                <label for="email">{{__('messages.Email')}}</label>
                {!! Form::email('email',null,[
                    'class'=>'form-control',
                ]) !!}
            </div>
            <div class="form-group">
                <label for="image">{{__('messages.image')}}</label>
                <input type="file" name="image" class="form-control image">
            </div>
            <div class="form-group">
                <img src="{{$model->image_path}}" class="img-thumbnail image-preview" style="height: 120px">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit"><i class="fa fa-edit btn-xs"></i> {{__('messages.Edit')}}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>
@endsection

