@extends('layouts.dashboard.app')
@section('content')
    @section('page_title')
        {{__('messages.Edit Settings')}}
    @endsection
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @include('flash::message')
                {!! Form::model($model,[
                    'action'=>['Dashboard\SettingController@update',$model->id],
                    'method'=>'put'
                ]) !!}
                <div class="form-group">
                    <label for="about_app">{{__('messages.about_app')}}</label>
                    {!! Form::text('about_app',null,[
                        'class'=>'form-control',
                    ]) !!}
                </div>
                <div class="form-group">
                    <label for="facebook_url">{{__('messages.Facebook_url')}}</label>
                    {!! Form::text('facebook_url',null,[
                        'class'=>'form-control',
                    ]) !!}
                </div>
                <div class="form-group">
                    <label for="twitter_url">{{__('messages.Twitter_url')}}</label>
                    {!! Form::text('twitter_url',null,[
                        'class'=>'form-control',
                    ]) !!}
                </div>
                <div class="form-group">
                    <label for="instagram_url">{{__('messages.instagram_url')}}</label>
                    {!! Form::text('instagram_url',null,[
                        'class'=>'form-control',
                    ]) !!}
                </div>
                <div class="form-group">
                    @if(auth()->user()->hasPermission('update_settings'))
                        <button class="btn btn-success" type="submit"><i class="fa fa-edit btn-xs"></i> {{__('messages.Edit Settings')}}</button>
                    @else
                        <button class="btn btn-success disabled" type="submit"><i class="fa fa-edit btn-xs"></i> {{__('messages.Edit Settings')}}</button>
                    @endif
                </div>
            {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection
