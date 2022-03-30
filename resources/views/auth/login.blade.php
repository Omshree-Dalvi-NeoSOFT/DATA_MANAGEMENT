@extends('layouts.app')

@section('content')
@include('layouts.loginnav')
<div class="container mt-5">
<div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Sign In</h3>
              <p class="mb-4">l WILL HAVE AN ADMINISTRATIVE SYSTEM WHERE THERE IS NO WAY TO EXTRICATE RED.</p>
            </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group first">
                            <label for="username">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group last mb-4">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror  
                        </div>
                           
                        <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                        <span class="d-block text-left my-4 text-muted">&mdash; or login with &mdash;</span>
                        
                        <div class="social-login">
                            <a href="#" class="facebook">
                            <span class="icon-facebook mr-3"></span> 
                            </a>
                            <a href="#" class="twitter">
                            <span class="icon-twitter mr-3"></span> 
                            </a>
                            <a href="#" class="google">
                            <span class="icon-google mr-3"></span> 
                            </a>
                        </div>                        
                    </form>

            </div>
            
          </div>
          
          </div>
          
        </div>
      </div>
    </div>
</div>
@endsection
