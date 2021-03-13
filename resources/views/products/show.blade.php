@extends('layout')

@section('content')
<div class="product">
    <div class="product-id-show">ID: {{ $product->product_id }}</div>
    <div class="product-views">{{ $product->views }} views</div>
    <div class="product-image-show"><img src="{{ $product->image }}"></div>
    <div class="product-title">{{ $product->title }}</div>
    <div class="product-rating">Rating: {{ $product->rating }}</div>
    <div class="product-category">Category: {{ $product->category->title ?? '' }}</div>
    <div class="product-price">Price: {{ $product->price }}</div>
    <div class="product-inet-price">Inet price: {{ $product->inet_price }}</div>
    <div class="product-description">{{ $product->description }}</div>
    <div class="btn product-edit-link"><a href="{{ route('product.edit', ['product' => $product]) }}">Edit</a></div>
    {{ Form::open(['action' => ['ProductController@delete', 'product' => $product], 'method' => 'POST', 'class' => 'product-delete-form']) }}
    @method('delete')
    {{ Form::submit('Delete', ['class' => 'btn btn-danger product-delete-link', 'onclick' => "return confirm('Are you sure?')"]) }}
    {{ Form::close() }}
</div>
@endsection
