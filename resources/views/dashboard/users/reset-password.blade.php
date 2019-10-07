@extends('layouts.dashboard.app')
@section('page_title')
    {{__('messages.Change Password')}}
@endsection
@section('content')
    @push('css')
        @if (app()->getLocale() == 'ar')
        <style>
            .form-group{
                position: relative;
            }
            .form-group .show-pass1{
                position: absolute;
                left: 18px;
                top: 10px;
            }
            .form-group .show-pass2{
                position: absolute;
                left: 18px;
                top: 10px;
            }
            .form-group .show-pass3{
                position: absolute;
                left: 18px;
                top: 10px;
            }

        </style>
        @else
            <style>
                .form-group{
                    position: relative;
                }
                .form-group .show-pass1{
                    position: absolute;
                    right: 18px;
                    top: 10px;
                }
                .form-group .show-pass2{
                    position: absolute;
                    right: 18px;
                    top: 10px;
                }
                .form-group .show-pass3{
                    position: absolute;
                    right: 18px;
                    top: 10px;
                }

            </style>
        @endif
    @endpush
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                {!! Form::open([
                    'action'=>'Dashboard\UserController@changePasswordSave',
                    'id'=>'myForm',
                    'role'=>'form',
                    'method'=>'POST'
                ])!!}
                @include('flash::message')
                @include('partials.validation_errors')              
                    <label>{{__('messages.Password')}}</label>
                    <div class="form-group">
                        <input class="password1 form-control" type="password" name="old-password"/>
                        <i class="show-pass1 fa fa-eye fa-1x"></i>
                    </div>
                    <label>{{__('messages.New Password')}}</label>
                    <div class="form-group">
                        <input class="password2 form-control" type="password" name="password"/>
                        <i class="show-pass2 fa fa-eye fa-1x"></i>
                    </div>
                    <label>{{__('messages.Password Confirmation')}}</label>
                    <div class="form-group">
                        <input class="password3 form-control" type="password" name="password_confirmation"/>
                        <i class="show-pass3 fa fa-eye fa-1x"></i>
                    </div>
                <!-- /.box -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">{{__('messages.Save')}}</button>
                </div>
                {!! Form::close()!!}
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
                $(".show-pass3").hover(function(){
                    $('.password3').attr('type','text');
                },function(){
                    $('.password3').attr('type','password');
                });
            });
        </script>
    @endpush
@endsection