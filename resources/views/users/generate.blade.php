@extends('layouts.master')

@section('title')
User Generator
@endsection

@section('content')

<form method="POST" action="/users/generate" >
  {{ csrf_field() }}
  <label for="userCount">Number of Users: </label>
  <input type="text" name="userCount" size="2"
    @if ( isset($count) )
      value="{{ $count }}"
    @endif
  >
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
  </select>
  <input type="submit" value="Create Users"/>
</form>

  @if ( isset($users))

    <h4>Your Users:</h4>
    <div class="results">

     @foreach ($users as $user)
      <p>{{$user["prefix"]}} {{trim($user["firstName"])}}
          {{ trim($user["lastName"]).$user["suffix"] }}

     @endforeach
    </div>
  @endif

@endsection
