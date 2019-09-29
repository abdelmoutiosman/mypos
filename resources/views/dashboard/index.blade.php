@extends('layouts.dashboard.app')

{{--@inject('client', 'App\Models\Client')--}}
{{--@inject('order', 'App\Models\Order')--}}
{{--@inject('bloodtype', 'App\Models\BloodType')--}}
{{--@inject('category', 'App\Models\Category')--}}
{{--@inject('city', 'App\Models\City')--}}
{{--@inject('governorate', 'App\Models\Governorate')--}}
{{--@inject('post', 'App\Models\Post')--}}
{{--@inject('contact', 'App\Models\Contact')--}}
{{--@inject('setting', 'App\Models\Setting')--}}
@section('content')
@section('page_title')
    {{__('messages.Dashboard')}}
@endsection
@section('small_title')
    {{__('messages.Control Panel')}}
@endsection
<section class="content">
{{--    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--        <div class="info-box">--}}
{{--            <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>--}}
{{--            <div class="info-box-content">--}}
{{--                <span class="info-box-text">{{__('messages.Clients')}}</span>--}}
{{--                <span class="info-box-number">{{$client->count()}}</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--        <div class="info-box">--}}
{{--            <span class="info-box-icon bg-green"><i class="fa fa-line-chart"></i></span>--}}
{{--            <div class="info-box-content">--}}
{{--                <span class="info-box-text">{{__('messages.Orders')}}</span>--}}
{{--                <span class="info-box-number">{{$order->count()}}</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--        <div class="info-box">--}}
{{--            <span class="info-box-icon bg-red"><i class="fa fa-heartbeat"></i></span>--}}
{{--            <div class="info-box-content">--}}
{{--                <span class="info-box-text">{{__('messages.bloodtypes')}}</span>--}}
{{--                <span class="info-box-number">{{$bloodtype->count()}}</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--        <div class="info-box">--}}
{{--            <span class="info-box-icon bg-blue"><i class="fa fa-list-alt"></i></span>--}}
{{--            <div class="info-box-content">--}}
{{--                <span class="info-box-text">{{__('messages.Categories')}}</span>--}}
{{--                <span class="info-box-number">{{$category->count()}}</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--        <div class="info-box">--}}
{{--            <span class="info-box-icon bg-orange"><i class="ion ion-flag"></i></span>--}}
{{--            <div class="info-box-content">--}}
{{--                <span class="info-box-text">{{__('messages.Cities')}}</span>--}}
{{--                <span class="info-box-number">{{$city->count()}}</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--        <div class="info-box">--}}
{{--            <span class="info-box-icon bg-yellow"><i class="ion-ios-home"></i></span>--}}
{{--            <div class="info-box-content">--}}
{{--                <span class="info-box-text">{{__('messages.Governorates')}}</span>--}}
{{--                <span class="info-box-number">{{$governorate->count()}}</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--        <div class="info-box">--}}
{{--            <span class="info-box-icon bg-secondary"><i class="fa fa-newspaper-o"></i></span>--}}
{{--            <div class="info-box-content">--}}
{{--                <span class="info-box-text">{{__('messages.Posts')}}</span>--}}
{{--                <span class="info-box-number">{{$post->count()}}</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--        <div class="info-box">--}}
{{--            <span class="info-box-icon bg-navy"><i class="fa fa-envelope"></i></span>--}}
{{--            <div class="info-box-content">--}}
{{--                <span class="info-box-text">{{__('messages.Contacts')}}</span>--}}
{{--                <span class="info-box-number">{{$contact->count()}}</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-md-3 col-sm-6 col-xs-12">--}}
{{--        <div class="info-box">--}}
{{--            <span class="info-box-icon bg-gray-light"><i class="fa fa-gears"></i></span>--}}
{{--            <div class="info-box-content">--}}
{{--                <span class="info-box-text">{{__('messages.Settings')}}</span>--}}
{{--                <span class="info-box-number">{{$setting->count()}}</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--</div>--}}
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Title</h3>
            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            You are logged in!
        </div>
        <div class="box-footer">
            Footer
        </div>
    </div>
</section>
@endsection
