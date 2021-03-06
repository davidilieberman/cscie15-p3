@extends('layouts.master')

@section('title')
Lorem Ipsum Generator
@endsection

@section('content')
<form method="POST" action="/lorem">
  {{ csrf_field() }}
  <label for="loremCount">Number of paragraphs</label>
  <input type="text" size="2" name="loremCount"
    @if ( isset ( $count) ) value="{{ $count }}" @endif
    />
  <input type="submit" value="Generate Lorem Ipsum Text"/>
</form>

@if ( isset($loremGraphs))
  <h4>Your Lorem Ipsum Text</h4>
  <div class="results">
    @foreach ( $loremGraphs as $graph )
      <p>
        {{ $graph }}
      </p>
    @endforeach
  </div>
@endif

@endsection
