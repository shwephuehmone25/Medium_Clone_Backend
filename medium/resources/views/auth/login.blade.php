<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
  </head>
  <body>
    <!-- Navigation -->
    @include('layouts.common')
    @include('common.alert')
     <div class="horizontal"></div> 
    <div class="w-100 d-flex justify-content-center align-items-center">
      <div class="container-wrapper">
        <div class="w-80 d-flex align-items-center justify-content-center py-4">
          <form method="POST" action="{{ route('login') }}"
            class="d-flex col-md-8 flex-column border border-3 forms border-secondary"
          >
          @csrf
            <h4>{{ __('Login') }}</h4>
            <div class="d-flex flex-column mb-3">
              <label for="email" class="mb-2">{{ __('Email') }}</label>
              <input
                type="text"
                id="email"
                name="email" 
                value="{{ old('email') }}"
                autocomplete="email" 
                autofocus
                class="rounded border border-1 px-3 py-2 @error('email') is-invalid @enderror"
                placeholder="{{__('Your Email')}}(example@gmail.com)"
              />
              @error('email')
                <span class="text-danger" role="alert">
                <small>{{ __($message) }}</small>
                </span>
              @enderror
            </div>
            <div class="d-flex flex-column mb-3">
              <label for="password" class="mb-2 label-txt">{{__('Password')}}</label>
              <input
                type="password"
                id="password"
                name="password" 
                autocomplete="current-password"
                class="rounded border border-1 px-3 py-2 @error('password') is-invalid @enderror"
                placeholder="{{__('Password')}}"
              />
              @error('password')
                  <span class="text-danger" role="alert">
                  <small>*{{ $message }}</small>
                  </span>
              @enderror
            </div>
            <div class="row">
                <div class="col-3">
                    <button type="submit"
                    class="w-auto border-0 fit-content px-3 py-2 bg-secondary text-light rounded"
                  >
                    {{__('Login')}}
                  </button>
                </div>
                <div class="col-3 flex items-center align-middle">
                        <a href="{{ route('auth.google') }}">
                            <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 1em;">
                        </a>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script
      src="https://code.jquery.com/jquery-3.6.3.min.js"
      integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
