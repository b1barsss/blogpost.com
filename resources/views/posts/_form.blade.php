<div class="form-group">
    <label>{{ __('Title') }}:</label>
    <input name="title"
           value="{{ old('title', $post->title ?? null) }}"
           class="form-control" >
</div>
<div class="form-group">
    <label>{{ __('Content') }}:</label>
    <input name="content"
           value="{{ old('content', $post->content ?? null) }}"
           class="form-control" >
</div>
<div class="form-group">
    <label>{{ __('Thumbnail') }}:</label>
    <input type="file" name="thumbnail" class="form-control-file" >
</div>


@errors @enderrors


