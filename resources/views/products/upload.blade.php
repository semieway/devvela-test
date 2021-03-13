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
@endsection
