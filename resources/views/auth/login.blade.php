@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card-group d-block d-md-flex row">
                    <div class="card col-md-7 p-4 mb-0">
                        <div class="card-body">
                            <img src="{{asset('admin/coreui/assets/img/baf_logo.png')}}"  height="60" width="50" style="margin-left:40%; margin-top:-25px;">
                            <p style="color:black; font-weight:bold; font-size:14px;">BAFWWA Pharmacy Management Software</p>
                            <p style="color:black; font-weight:bold; font-size:15px; margin-left:32%; margin-top:-15px;">(BAFWWA PMS)</p>

                            <!-- <h6>{{ __('Login') }}</h6> -->
                            <p class="text-medium-emphasis" style="color:black;font-weight:bold;">Sign In to your account</p>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg class="icon">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                                    </svg>
                                </span>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="User ID" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg class="icon">
                                    <use xlink:href="{{asset('admin/coreui/vendors/@coreui/icons/svg/free.svg#cil-lock-locked')}}"></use>
                                    </svg>
                                </span>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- <div class="row mb-3">
                                    <div class="col-6">
                                        <label class="form-check mb-0">
                                            <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="form-check-label" for="remember">{{__('Remember Me')}}</span>
                                        </label>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary px-4">Login</button>
                                    </div>
                                    <!-- @if (Route::has('password.request'))
                                        <div class="col-6 text-end">
                                            <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                                {{ __('Forgot password?') }}
                                            </a>
                                        </div>
                                    @endif -->

                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- <div class="card col-md-5 text-white bg-primary py-5">
                        <div class="card-body text-center">
                            <div>
                                <h2>Sign up</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                @if (Route::has('register'))
                                    <a class="btn btn-lg btn-outline-light mt-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif

                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
@endsection
