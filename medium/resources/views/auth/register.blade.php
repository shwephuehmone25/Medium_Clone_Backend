<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
</head>

<body>
    @include('layouts.common')
    @include('common.alert')
    <div class="horizontal"></div> 
    <div class="w-100 d-flex justify-content-center align-items-center">
        <div class="container-wrapper">
            <div class="w-80 d-flex align-items-center justify-content-center py-4">
                <form method="POST" action="{{ route('register') }}"
                    class="d-flex col-md-8 flex-column border border-3 forms border-secondary">
                    @csrf
                    <h4> {{__('Sign Up')}}</h4>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <label class="form-label" for="form3Example1m" style="font-size: 1em">{{__('Name')}}</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name') }}" autocomplete="name" autofocus placeholder="{{__('Your Name')}}" />
                                @error('name')
                                    <span class="text-danger" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <label class="form-label" for="form3Example1n" style="font-size: 1em">{{ __('Email') }}</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    autocomplete="email" class="form-control"
                                    placeholder="Your Email(example@gmail.com)" />
                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <label class="form-label" for="form3Example1m" style="font-size: 1em">{{__('Password')}}</label>
                                <input type="password" id="password" name="password" autocomplete="new-password"
                                    class="form-control" placeholder="{{__('Password')}}" />
                                @error('password')
                                    <span class="text-danger" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <label class="form-label" for="form3Example1n" style="font-size: 1em">
                                    {{__('Confirm Password')}}
                                </label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    autocomplete="new-password" placeholder="{{__('Confirm Password')}}" />
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-3">
                        <label for="bio" style="font-size: 1em" class="mb-2">{{__('Bio')}}</label>
                        <input type="text" id="bio" name="bio" autocomplete="bio"
                            class="rounded border border-1 px-3 py-2" placeholder="{{__('Your Bio')}}" />
                        @error('bio')
                            <span class="text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror
                    </div>
                    <button type="submit"
                        class="btn btn-secondary border-0 fit-content px-3 py-2 bg-secondary text-light rounded">
                        {{__('Sign Up')}}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
