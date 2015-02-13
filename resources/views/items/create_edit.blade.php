@extends('layouts.default')

@section('title')
    @if(isset($item))
        编辑商品 - @parent
    @else
        新建商品 - @parent
    @endif

@stop

@section('content')
    @if(isset($item))
        <h1>编辑商品</h1>
    @else
        <h1>新建商品</h1>
    @endif

    <hr/>

    @if(isset($item))
        {!! Form::model($item, ['route' => ['items.update', $item->id], 'method' => 'patch']) !!}
    @else
        {!! Form::open(['route' => 'items.store', 'method' => 'post']) !!}
    @endif

    <div class="form-group">
        {!! Form::label('name', '商品名称：', array('class' => 'col-sm-2 control-label')) !!}

        <div class="col-sm-10">
            {!! Form::text('name', null, array('id' => 'name', 'class' => 'form-control', 'placeholder' => '请输入商品名称')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('intro', '商品简介', array('class' => 'col-sm-2 control-label')) !!}

        <div class="col-sm-10">
            {!! Form::text('intro', null, array('id' => 'intro', 'class' => 'form-control', 'placeholder' => '请输入商品简介')) !!}
        </div>
    </div>


    {!! Form::submit('提交', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}

@stop