@extends('layouts.default')

@section('title')
    {{ $shop->name }} - @parent
@stop

@section('content')
    <h1>{{ $shop->name }}</h1>
    <h3>{{ $shop->user->name }}</h3>
    <hr>
    <p>{{ $shop->intro }}</p>
    @forelse($items as $item)
        <br>{{ $item->name }}
        {{ $item->intro }}
        {{ $item->shop->user->name }}
        @empty
        N/A
    @endforelse

    <a href="{!! route('shops.edit', $shop->id) !!}">edit</a>
    {!! Form::open(['route' => ['shops.destroy', $shop->id ], 'method' => 'delete']) !!}
    {!! Form::submit('删除', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
    <a href="{!! route('items.index') !!}">a</a>
@stop