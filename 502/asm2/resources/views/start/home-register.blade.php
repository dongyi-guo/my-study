@extends('start.home-layout')

@section('title', 'Register')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('validate_registration') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                @error('')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="zone" class="col-md-4 col-form-label text-md-end">{{ __('Zone') }}</label>

                            <div class="col-md-6">
                                <select name="zone" id="zone">
                                    <option value="Zone A">Zone A</option>
                                    <option value="Zone B">Zone B</option>
                                    <option value="Zone C">Zone C</option>
                                    <option value="Zone D">Zone D</option>
                                    <option value="Zone E">Zone E</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">{{ __('Are you a') }}</label>
                        <div class="col-md-6">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="" name="buyer-check" id="buyer-check">
                                <label class="form-check-label" for="buyer-check">{{ __('Buyer') }}</label>
                            </div>
                            <div class="forms-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="" name="seller-check" id="seller-check">
                                <label class="form-check-label" for="seller-check">{{ __('Seller') }}</label>
                            </div>
                        </div>
                        </div>
                
                        <div class="row mb-3">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" name="terms-check" id="terms-check" required autocomplete="terms-check">
                                <label class="form-check-label" for="terms-check">
                                {{ __('I acknowledge that I have read and understood the terms and conditions.') }}
                                </label>
                            </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="reset" class="btn btn-danger" style="margin-right: 30px;">
                                    {{ __('Clear') }}
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .card-header{
        background-color: #87CEEB;
        color: #000000;
        font-weight: bold;
        font-size: 18px;
    }
</style>
@endsection
