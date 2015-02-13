@extends('layouts.default')

@section('title')
    @if(isset($shop))
        编辑商店 - @parent
    @else
        新建商店 - @parent
    @endif

@stop

@section('content')
    @if(isset($shop))
        <h1>编辑商店</h1>
    @else
        <h1>新建商店</h1>
    @endif

    <hr/>

    @if(isset($shop))
        {!! Form::model($shop, ['route' => ['shops.update', $shop->id], 'method' => 'patch']) !!}
    @else
        {!! Form::open(['route' => 'shops.store', 'method' => 'post']) !!}
    @endif

    <div class="form-group">
        {!! Form::label('name', '店铺名称：', array('class' => 'col-sm-2 control-label')) !!}

        <div class="col-sm-10">
            {!! Form::text('name', null, array('id' => 'name', 'class' => 'form-control', 'placeholder' => '请输入店铺名称')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('intro', '店铺简介', array('class' => 'col-sm-2 control-label')) !!}

        <div class="col-sm-10">
            {!! Form::text('intro', null, array('id' => 'intro', 'class' => 'form-control', 'placeholder' => '请输入店铺简介')) !!}
        </div>
    </div>

    {!! Form::submit('提交', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}

@stop