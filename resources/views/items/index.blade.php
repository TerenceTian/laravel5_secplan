@extends('layouts.default')

@section('title')
    商品主页 - @parent
@stop

@section('content')
    <h1>商品主页</h1>
    <hr/>

    @forelse($items as $item)
        {{ $item->name }}
        {{ $item->intro }}

        @empty
            N/A

    @endforelse

@stop