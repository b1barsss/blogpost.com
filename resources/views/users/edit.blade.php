@extends('layout')


@section('content')
    <form method='POST' enctype="multipart/form-data"
          action="{{ route('users.update', ['user' => $user->id]) }}"
          class="form-horizontal">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-4">
                <div class="card mt-4">
                    <div class="card-body">
                        <img src="{{ $user->image ? $user->image->url() : '' }}"
                        class="avatar img-thumbnail" alt="No photo yet">

                        <h6 class="mt-3">Upload a new photo</h6>

                        <input class="form-control-file mb-3 mt-3" type="file" name="avatar">
                        @errors @enderrors

                    </div>
                </div>

            </div>
            <div class="col-8">

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input class="form-control" value="{{ old('name', $user->name ?? '') }}" type="text" name="name">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Save Changes">
                </div>
            </div>

        </div>
    </form>
@endsection
