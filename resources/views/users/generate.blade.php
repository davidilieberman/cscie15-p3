@extends('layouts.master')

@section('title')
: User Generator
@endsection

@section('content')

@if (count($errors) > 0)
  <div>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="/users/generate" >
  {{ csrf_field() }}
  <label for="count">Number of Users: </label>
  <input type="text" name="count" size="2"
    @if ( isset($count) )
      value="{{ $count }}"
    @endif
  > <br/>
  <label for="genderFlag">Gender of Users:</label>
  <select name="genderFlag">
    @if ( isset($genderOptions) )
      @foreach ( $genderOptions as $opt)
        <option value="{{ $opt["value"] }}"
          @if ( $opt["selected"]) selected @endif>{{ $opt["label"] }}</option>
      @endforeach
    @else
      <option value="2">Both</option>
      <option value="0">Male only</option>
      <option value="1">Female only</option>
    @endif
  </select><br/>
  <input type="submit" value="Create Users"/>
</form>

  @if ( isset($names) )
  <div>
    @foreach ($names as $name)
    {{ $name }}<br/>
    @endforeach
  </div>
  @endif

@endsection
