@extends('layout')
@section('content')

    <div class="product-create-form">
        {{ Form::open(['action' => ['ProductController@update', 'product' => $product], 'method' => 'post', 'files' => true]) }}
        @method('put')
        {{ Form::label('product_id', 'Product ID') }}
        {{ Form::text('product_id', $product->product_id) }}
        @error('product_id')
        <div class="form-error">{{ $message }}</div>
        @enderror
        {{ Form::label('image', 'Image:') }}
        {{ Form::file('image') }}
        @error('image')
        <div class="form-error">{{ $message }}</div>
        @enderror
        {{ Form::label('title', 'Title:') }}
        {{ Form::text('title', $product->title) }}
        @error('title')
        <div class="form-error">{{ $message }}</div>
        @enderror
        {{ Form::label('rating', 'Rating:') }}
        {{ Form::number('rating', $product->rating ?? '', ['min' => 0, 'max' => 5, 'step' => 0.1]) }}
        @error('rating')
        <div class="form-error">{{ $message }}</div>
        @enderror
        {{ Form::label('price', 'Price:') }}
        {{ Form::number('price', $product->price, ['min' => 0]) }}
        @error('price')
        <div class="form-error">{{ $message }}</div>
        @enderror
        {{ Form::label('inet_price', 'Inet price:') }}
        {{ Form::number('inet_price', $product->inet_price ?? '', ['min' => 0]) }}
        @error('inet_price')
        <div class="form-error">{{ $message }}</div>
        @enderror
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description', $product->description ?? '') }}
        @error('description')
        <div class="form-error">{{ $message }}</div>
        @enderror
        {{ Form::submit('Save', ['class' => 'product-edit-submit']) }}
        {{ Form::close() }}
    </div>

@endsection
