@extends('layouts.dashboard.app')
@inject('model', 'App\User')
@section('content')
@section('page_title')
    {{__('messages.users')}}
@endsection
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('messages.List Of Users')}} <small>{{$users->total()}}</small></h3>
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
                            'action'=>'Dashboard\UserController@index',
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
                            @if(auth()->user()->hasPermission('create_users'))
                            <a href="{{url(route('dashboard.users.create'))}}" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('messages.New user')}}</a>
                            @else
                            <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> {{__('messages.New user')}}</a>
                            @endif
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            @include('flash::message')
            @if(count($users))
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="table1">
                        <thead>
                        <tr class="bg-info">
                            <th class="text-center">#</th>
                            <th class="text-center">@lang('messages.firstname')</th>
                            <th class="text-center">{{trans('messages.lastname')}}</th>
                            <th class="text-center">{{__('messages.Email')}}</th>
                            <th class="text-center">{{__('messages.image')}}</th>
                            <th class="text-center">{{__('messages.Edit')}}</th>
                            <th class="text-center">{{__('messages.delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr id="removable{{$user->id}}">
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">{{$user->first_name}}</td>
                                <td class="text-center">{{$user->last_name}}</td>
                                <td class="text-center">{{$user->email}}</td>
                                <td class="text-center"><img src="{{ $user->image_path }}" style="height:100px" class="img-thumbnail"></td>
                                @if(auth()->user()->hasPermission('update_users'))
                                <td class="text-center">
                                    <a href="{{url(route('dashboard.users.edit',$user->id))}}" class="btn btn-success"><i class="fa fa-edit btn-xs"></i>
                                        {{__('messages.Edit')}}</a>
                                </td>
                                @else
                                    <td class="text-center">
                                        <button class="btn btn-success disabled"><i class="fa fa-edit btn-xs"></i> {{__('messages.Edit')}}</button>
                                    </td>
                                @endif
                                @if(auth()->user()->hasPermission('delete_users'))
                                <td class="text-center">
                                    {!! Form::model($model,[
                                            'action'=>['Dashboard\UserController@destroy',$user->id],
                                            'method'=>'delete'
                                        ]) !!}
                                    <button id="{{$user->id}}" data-token="{{ csrf_token() }}"
                                            data-route="{{URL::route('dashboard.users.destroy',$user->id)}}"
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
                    {{$users->appends(request()->query())->links()}}
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
