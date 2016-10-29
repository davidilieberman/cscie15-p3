@extends('layouts.master')

@section('title')
Lorem Ipsum Generator
@endsection

@section('content')
<form method="POST" action="/lorem/generate">
  {{ csrf_field() }}
  <label for="count">Number of paragraphs</label>
  <input type="text" size="2" name="count"
    @if ( isset ( $count) ) value="{{ $count }}" @endif
    />
  <input type="submit" value="Generate Lorem Ipsum Text"/>
</form>

@if ( isset($loremGraphs))
  @foreach ( $loremGraphs as $graph )
<p>
  {{ $graph }}
</p>
  @endforeach
@endif

@endsection
