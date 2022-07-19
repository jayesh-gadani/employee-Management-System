
@extends('auth.layout')
@section('pageTitle','User Login')
@section('content')

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in</p>

      @if(Session::has('sucess'))
                <div class="alert alert-success" role="alert">
                  {{ Session::get('sucess') }}
                </div>
      @endif
       @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">
                  {{ Session::get('error') }}
                </div>
      @endif
      <form method="POST" action="{{ route('login') }}">
         @csrf

        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
           @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

       
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          
          </div>
          <!-- /.col -->
        </div>
      </form>

     
      <!-- /.social-auth-links -->

      <p class="mb-1">
        @if (Route::has('password.request'))
                <a class="text-center" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
                 </a>
            @endif
      </p>
      <p class="mb-2">
        <a href="{{ __('register') }}" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>



@endsection
