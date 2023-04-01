@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-4 mx-4">
                    <div class="card-header">{{ __('Register') }}</div>
                    <div class="card-body p-4">
                        <p class="text-medium-emphasis">{{__('Create your account')}}</p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="input-group mb-3"><span class="input-group-text">
                                <svg class="icon">
                                <use xlink:href="{{asset('admin/coreui/vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                                </svg></span>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3"><span class="input-group-text">
                                <svg class="icon">
                                <use xlink:href="{{asset('admin/coreui/vendors/@coreui/icons/svg/free.svg#cil-envelope-open')}}"></use>
                                </svg></span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3"><span class="input-group-text">
                                <svg class="icon">
                                <use xlink:href="{{asset('admin/coreui/vendors/@coreui/icons/svg/free.svg#cil-lock-locked')}}"></use>
                                </svg></span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-4">
                                <span class="input-group-text">
                                    <svg class="icon">
                                    <use xlink:href="{{asset('admin/coreui/vendors/@coreui/icons/svg/free.svg#cil-lock-locked')}}"></use>
                                    </svg>
                                </span>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <button class="btn btn-block btn-success" type="submit">{{ __('Register') }}</button>
                            <a class="btn btn-block btn-primary" href="{{route('login')}}">{{ __('Login') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
