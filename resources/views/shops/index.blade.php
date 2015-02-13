@extends('layouts.default')

@section('title')
    商店列表 - @parent
@stop

@section('content')
    <h1>商店列表</h1>
    <hr/>
    @forelse($shops as $shop)
        <a href="{!! route('shops.show', $shop->id) !!}">{{ $shop->name }}</a>
        {{ $shop->user->name }}
        {{ $shop->intro }}
        @empty
            N/A
    @endforelse
@stop
