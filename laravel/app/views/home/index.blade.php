@extends('master')

@section('container')
  <h1>My Awesome URL Shortner</h1>
  {{ Form::open(array('url' => '/')) }}
	{{ Form::text('url') }}
  {{ Form::close() }}
{{$errors->first('url', '<p class="errors">:message</p>')}}
@endsection

