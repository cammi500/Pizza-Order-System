@extends('layouts.master')
@section('title','login Page')  
@section('content')
<div class="login-form">
    <form action="" method="post">
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
        </div>
        
        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
        
    </form>
    <div class="register-link">
        <p>
            Don't you have account?
            <a href="{{url('register')}}">Sign Up Here</a>
        </p>
    </div>
</div>
@endsection
                       
                   