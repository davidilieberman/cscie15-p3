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
    <option value="2"
        @if ( isset($genderFlag) && $genderFlag==2) checked @endif
      >Both</option>
    <option value="0"
        @if ( isset($genderFlag) && $genderFlag==0) checked @endif
      >Female Only</option>
    <option value="1"
        @if ( isset($genderFlag) && $genderFlag==1) checked @endif
      >Male Only</option>
  </select>
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
