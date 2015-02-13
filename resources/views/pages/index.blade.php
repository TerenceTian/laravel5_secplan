@extends('layouts.default')

@section('title')
    主页 - @parent
@stop

@section('content')
    <h1>这是主页</h1>
    <hr/>

    @foreach($popular_shops as $pop_shop)
        <a href="{!! route('shops.show', $pop_shop->id) !!}">
            {{ $pop_shop->name }}
            {{ $pop_shop->intro }}
        </a>
            {{ $pop_shop->user->name }}

    @endforeach
@stop
