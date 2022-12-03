<div class="form-group">
    <label>Title</label>
    <input name="title" value="{{ old('title', $post->title ?? null) }}"
           class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" >
    @if($errors->has('title'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    <label>Content</label>
    <input name="content" value="{{ old('content', $post->title ?? null) }}"
           class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" >
    @if($errors->has('content'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('content') }}</strong>
        </span>
    @endif
</div>

{{--@if($errors->any())--}}
{{--    <div>--}}
{{--        <ul>--}}
{{--            @foreach($errors->all() as $error)--}}
{{--                <li class="text-danger">{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
