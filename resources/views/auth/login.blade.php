@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="{{route('login')}}">
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
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Username</label>                                
                                <input id = "username" class="au-input au-input--full form-control @error('username') is-invalid @enderror" placeholder="Username" name="username" type="text" required autocomplete="on" autofocus value="{{old('username')}}">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                            </div>
                            <div class="login-checkbox">
                                <label>
                                    <input type="checkbox" name="remember" id="remember">{{ old('remember') ? 'checked' : '' }}{{ __('Remember Me') }}
                                </label>
                                <!-- <label>
                                    <a href="#">Forgotten Password?</a>
                                </label> -->
                            </div>
                            <button class="au-btn au-btn--block au-btn--submit m-b-20" type="submit">sign in</button>
                         
                        </form>
                        <div class="register-link">
                            <p>
                                Don't you have account?
                                <a href="{{ route('register') }}">
                                    {{ __('Sign up') }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection