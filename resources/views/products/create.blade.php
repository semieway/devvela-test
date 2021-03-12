@extends('layout')
@section('content')

<div class="product-create-form">
    {{ Form::open(['action' => 'ProductController@store', 'method' => 'post']) }}
    {{ Form::label('product_id', 'Product ID') }}
    {{ Form::text('product_id') }}
    {{ Form::label('image', 'Image:') }}
    {{ Form::file('image') }}
    {{ Form::label('title', 'Title:') }}
    {{ Form::text('title') }}
    {{ Form::label('rating', 'Rating:') }}
    {{ Form::number('rating', '3.0', ['min' => 0, 'max' => 5, 'step' => 0.1]) }}
    {{ Form::label('price', 'Price:') }}
    {{ Form::number('price', null, ['min' => 0]) }}
    {{ Form::label('inet_price', 'Inet price:') }}
    {{ Form::number('inet_price', null, ['min' => 0]) }}
    {{ Form::label('description', 'Description') }}
    {{ Form::textarea('description') }}
    @error('file')
    <div class="form-error">{{ $message }}</div>
    @enderror
    {{ Form::submit('Save', ['class' => 'product-create-submit']) }}
    {{ Form::close() }}
</div>

@endsection
