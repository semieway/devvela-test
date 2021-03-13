@extends('layout')

@section('content')
<div class="product">
    <div class="product-id-show">ID: {{ $product->product_id }}</div>
    <div class="product-image-show"><img src="{{ $product->image }}"></div>
    <div class="product-title">{{ $product->title }}</div>
    <div class="product-rating">Rating: {{ $product->rating }}</div>
    <div class="product-category">Category: {{ $product->category->title ?? '' }}</div>
    <div class="product-price">Price: {{ $product->price }}</div>
    <div class="product-inet-price">Inet price: {{ $product->inet_price }}</div>
    <div class="product-description">{{ $product->description }}</div>
    <div class="product-edit-link"><a href="{{ route('product.edit', ['product' => $product]) }}">Edit product</a></div>
</div>
@endsection
