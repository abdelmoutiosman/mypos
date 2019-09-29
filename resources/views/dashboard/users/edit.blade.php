@extends('layouts.dashboard.app')
@section('content')
@section('page_title')
    {{__('messages.Edit User')}}
@endsection
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('messages.Form TO Edit User')}}</h3>
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
                    'action'=>['Dashboard\UserController@update',$record->id],
                    'method'=>'put',
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
                <img src="{{$record->image_path}}" class="img-thumbnail image-preview" style="height: 120px">
            </div>
            <div class="form-group">
                <label for="password">{{__('messages.Password')}}</label>
                {!! Form::password('password',[
                    'class'=>'password1 form-control',
                ]) !!}
                <i class="show-pass1 fa fa-eye fa-1x"></i>
            </div>
            <div class="form-group">
                <label for="password_confirmation">{{__('messages.Password Confirmation')}}</label>
                {!! Form::password('password_confirmation',[
                    'class'=>'password2 form-control',
                ]) !!}
                <i class="show-pass2 fa fa-eye fa-1x"></i>
            </div>
            <div class="form-group">
                <label for="permissions">{{__('messages.Permissions')}}</label>
                <div class="nav-tabs-custom">
                    @php
                        $models = ['users', 'categories', 'products'];
                        $maps = ['create', 'read', 'update', 'delete'];
                    @endphp
                    <ul class="nav nav-tabs">
                        @foreach($models as $index=>$model)
                            <li class="{{ $index == 0 ? 'active' : '' }}"><a href="#{{$model}}" data-toggle="tab">@lang('messages.'. $model)</a></li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($models as $index=>$model)
                            <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{$model}}">
                                @foreach($maps as $map)
                                    <label><input type="checkbox" name="permissions[]" value="{{$map.'_'.$model}}" {{ $record->hasPermission($map.'_'.$model) ? 'checked' : '' }}> @lang('messages.'.$map)</label>&nbsp;
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit"><i class="fa fa-edit btn-xs"></i> {{__('messages.Edit')}}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>
@push('showpassword')
    <script>
        $(document).ready(function(){
            $(".show-pass1").hover(function(){
                $('.password1').attr('type','text');
            },function(){
                $('.password1').attr('type','password');
            });
            $(".show-pass2").hover(function(){
                $('.password2').attr('type','text');
            },function(){
                $('.password2').attr('type','password');
            });
        });
    </script>
@endpush
@endsection

