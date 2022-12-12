@extends('layout')
@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="">{{ __('E-mail') }}:</label>
            <input name="email" value="{{ old('email') }}" placeholder="example@gmail.com" required
                   class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" >
            @if($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="">{{ __('Password') }}:</label>
            <input name="password" placeholder="************" type="password" required
                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
            @if($errors->has('password'))
                <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
            @endif
        </div>

        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="remember"
                       value="{{ old('remember') ? 'checked' : "" }}">
                <label class="form-check-label" for="remember">
                    {{ __('Remember me') }}!
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">{{ __('Login!') }}</button>
    </form>
@endsection

