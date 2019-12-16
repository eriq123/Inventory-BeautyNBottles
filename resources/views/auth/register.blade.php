@extends('layouts.app')

@section('content')
 <!-- <div class="page-wrapper" style="overflow-y: scroll!important;"> -->
<div class="page-content--bge5" style="height: 100%!important;">
    <div class="container">
        <div class="login-wrap">
            <div class="login-content">
            <div class="login-logo">
                <a href="#">
                    <!-- <img src="images/icon/logo.png" alt="CoolAdmin"> -->
                    <img src="{{asset('images/beauty-logo.jpg')}}" alt="BeautyNBottles Logo" style="width: 25%; height: 25%;" /> <h2>BEAUTY <i style="color: blue;">N</i> BOTTLES</h2>
                </a>
            </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <div class="login-form">
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="form-group">
                        <label>First Name</label>
                        <input id = "first_name" class="au-input au-input--full form-control @error('first_name') is-invalid @enderror" placeholder="First Name" name="first_name" type="text" required autocomplete="on" autofocus value="{{old('first_name')}}">
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>

                        <div class="form-group">
                            <label>Last Name</label>
                            <input id = "last_name" class="au-input au-input--full form-control @error('last_name') is-invalid @enderror" placeholder="Last Name" name="last_name" type="text" required autocomplete="on" autofocus value="{{old('last_name')}}">
                             @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- role dropdown for assistant and employee -->
                        <!-- may not be necessary if assistant is only one -->
                        <!-- <div class="form-group">
                            <label>Role</label>
                            <select class="form-control">
                                <option selected="selected">Assistant Admin</option>
                                <option>Employee</option>
                            </select>
                             @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> -->
                        <!-- end dropdown -->

                        <div class="form-group">
                            <label>Username</label>
                            <input id = "username" class="au-input au-input--full form-control @error('username') is-invalid @enderror" placeholder="Username" name="username" required autocomplete="on" autofocus value="{{old('username')}}">
                             @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input  id="password" type="password" class="au-input au-input--full form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">
                             @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input id="password-confirm" type="password" class="au-input au-input--full" name="password_confirmation" required autocomplete="new-password" for="password-confirm" class="au-input au-input--full" placeholder="Confirm Password">
                        </div>
                        
                     <!--    <div class="form-group">
                            <label>Password</label>
                            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                        </div> -->
                      
                        <button class="au-btn au-btn--block au-btn--submit m-b-20" type="submit">register</button>
                    </form>
                    <div class="register-link">
                        <p class="text-center">Already have an account? <a href="{{ route('login') }}">Sign In!</a>
                    </div>
                </div>
            </div>
        </div><br><br>
    </div>
</div>
    <!-- </div> -->

@endsection
