<div>
    @auth
        <form method="post" action="{{ $route }}">
            @csrf

            <div class="form-group">
                <textarea name="content" class="form-control mb-3" placeholder="{{ __('Comment') }}..."></textarea>
                <button type="submit" class="btn btn-primary btn-block mt-3">{{ __('Add comment') }}</button>
            </div>
        </form>
        @errors @enderrors

    @else
        <a href="{{ route('login') }}">{{ __('Sign-in') }}</a> {{ __('to post comments!') }}
    @endauth
    <hr class="dashed border-primary border-bottom-0">
</div>
