@extends('layouts.dashboard.app')
@section('content')
@section('page_title')
    {{__('messages.Edit Client')}}
@endsection
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('messages.Edit Client')}}</h3>
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
                    'action'=>['Dashboard\ClientController@update',$record->id],
                    'method'=>'put',
                    'files'=>'true'
                ]) !!}
            <div class="form-group">
                <label for="name">{{__('messages.name')}}</label>
                {!! Form::text('name',null,[
                    'class'=>'form-control',
                ]) !!}
            </div>
            @for($i=0;$i<2;$i++)
                <div class="form-group">
                    <label for="phone">{{__('messages.phone')}}</label>
                    <input type="text" name="phone[]" class="form-control" value="{{ $record->phone[$i] ?? '' }}">
                </div>
            @endfor
            <div class="form-group">
                <label for="address">{{__('messages.address')}}</label>
                {!! Form::text('address',null,[
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

