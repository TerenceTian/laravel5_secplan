@extends('layouts.default')

@section('title')
    {{ $shop->name }} - @parent
@stop

@section('content')
    <h1>{{ $shop->name }}</h1>
    <h3>{{ $shop->user->name }}</h3>
    <hr>
    <p>{{ $shop->intro }}</p>

    <a href="{!! route('shops.edit', $shop->id) !!}">edit</a>
    {!! Form::open(['route' => ['shops.destroy', $shop->id ], 'method' => 'delete']) !!}
    {!! Form::submit('删除', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@stop