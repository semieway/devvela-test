@extends('layout')

@section('content')
<div class="file-upload">
    {{ Form::open(['action' => 'ProductController@parse', 'method' => 'post', 'files' => true]) }}
    {{ Form::label('file', 'Upload a xml file to parse:', ['class' => 'file-xml-label']) }}
    {{ Form::file('file', ['class' => 'file-xml']) }}
    @error('file')
        <div class="form-error">{{ $message }}</div>
    @enderror
    {{ Form::submit('Upload') }}
    {{ Form::close() }}
</div>
<table class="table product-table">
    <thead>
    <tr>
        <th scope="col">@sortablelink('product_id', 'Product ID')</th>
        <th scope="col">@sortablelink('image', 'Image')</th>
        <th scope="col">@sortablelink('title', 'Title')</th>
        <th scope="col">@sortablelink('description', 'Description')</th>
        <th scope="col">@sortablelink('rating', 'Rating')</th>
        <th scope="col">@sortablelink('category', 'Category')</th>
        <th scope="col">@sortablelink('price', 'Price')</th>
        <th scope="col">@sortablelink('inet_price', 'Inet price')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td class="product-id">{{ $product->product_id }}</td>
            <td><a href="{{ route('product.show', $product->id) }}"><img src="{{ $product->image }}" class="product-image"></a></td>
            <td><a href="{{ route('product.show', $product->id) }}">{{ $product->title }}</a></td>
            <td class="product-description">{{ $product->description }}</td>
            <td>{{ $product->rating }}</td>
            <td>{{ $product->category->title }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->inet_price }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
