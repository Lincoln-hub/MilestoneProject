@extends('layouts.lrappmaster')
@section('title', 'Login Page')

@section('content')
<div align="center">
<div class ="container">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

<div class =class="card-body">
    <form action="login" method = "post">
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>"/>
      
        <div class="col-md-6">
        <br/>
           <!--  Username: 
            <input type="text" placeholder="Enter Username" name="login_name"></input>--> 
            <input  type="text" placeholder="Enter Username" class="form-control" name="login_name"  autofocus>
        </div>
        <div class="col-md-6">
            <br/>
           <!--   Password:
            <input type="password" placeholder="Enter Password" name="login_password"></input>
            <div class="col-md-6"> -->
           <input id="password" type="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror" name="login_password" required autocomplete="current-password">
        </div>
        <div>
            <button type="submit" class="btn btn-primary"name="login">Login Here!!</button>
        </div>
    </form>
     <?php
        if (isset($msg)) {
            echo $msg;
        }
        ?>
    <p align="center" id="register">If you do not have an account, click <a href="reg"> here</a> to register first</p>
    </div>
</div>
</div>
</div>
</div>
@endsection