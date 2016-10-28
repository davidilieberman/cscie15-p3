@extends('layouts.master')

@section('title')
: User Generator
@endsection

@section('content')
<form method="POST" action="/users/generate" >
  {{ csrf_field() }}
  <label for="count">Number of Users: </label> <input type="text" name="count" size="2"/> <br/>
  <label for="genderFlag">Gender of Users:</label>
  <select name="genderFlag">
    <option value="2">Both</option>
    <option value="0">Female Only</option>
    <option value="1">Male Only</option>
  </select>
  <input type="submit" value="Create Users"/>
</form>

<div>
  @foreach ($names as $name)
  {{ $name }}<br/>
  @endforeach
</div>
@endsection
