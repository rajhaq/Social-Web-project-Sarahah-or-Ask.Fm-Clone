@extends('layouts.app')

@section('content')
<div class="container">

    <!-- response and error -->
    @if (session('status'))

    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <!-- alert -->
    @if(count($errors)>0)
    @foreach($errors->all() as $error)
    <br/>
    <div class="alert alert-danger text-center">
    {{errors}}
    </div>
    @endforeach
    @endif
    @if(session('response'))
    <br/>
    <div class="alert alert-success text-center">
    {{session('response')}}
    </div>
    @endif
    <!-- response and error -->

    <div class="row justify-content-center">
        <div class="col-md-8">
            <img src="/images/avatars/{{$user->avatar}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px">
            <h2>{{$user->name}}'s profile</h2>
            <form enctype="multipart/form-data" action="/profile" method="POST">
            @csrf
            <label>Update Profile Image</label>
            <input type="file" name="avatar">
            <input type="submit" class="pull-right btn btn-sm btn-primary">
            </form>
        </div>
    </div>
</div>
@endsection
