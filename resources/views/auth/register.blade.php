@extends('layout')
@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class='form-group'>
            <label for="">{{ __('Name:') }}</label>
            <input name="name" value="{{ old('name') }}" placeholder="Username" required
                   class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}">
            @if($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="">E-mail:</label>
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
            <label for="">{{ __("Retype password") }}:</label>
            <input name="password_confirmation" type="password" class="form-control " placeholder="************" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}!</button>
    </form>
@endsection

