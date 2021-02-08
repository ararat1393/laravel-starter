<form
    action="{{ $photo->isNew ? route('photo.store') : route('photo.update',['photo' => $photo->id]) }}"
    method="POST"
    enctype="multipart/form-data"
    class="w-100"
>
    @csrf
    <div class="row">
        <div class="col-12">
            <label for="">
                <img class="upload-photo" id="blah" src="{{ $photo->isNew ? 'http://placehold.it/120x120' : $photo->link }}"  alt="photo">
                <input id="pic" class='pis' onchange="readURL(this);" type="file" name="file">
            </label>
            @if ($errors->has('file'))
                <span class="invalid-feedback" role="alert" style="display:block" >
                    <strong>{{ $errors->first('file') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-12 form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name" value="{{ old('name') ?? $photo->name }}">
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert" style="display:block" >
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-12 form-group">
            <label for="description">Description</label>
            <input class="form-control" type="text" name="description" id="description" value="{{ old('description') ?? $photo->description }}">
            @if ($errors->has('description'))
                <span class="invalid-feedback" role="alert" style="display:block" >
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-12 form-group">
            <label for="users">Users</label>
            <select id="users" class="photo-users form-control" name="user_id" ></select>
            @if ($errors->has('user_id'))
                <span class="invalid-feedback" role="alert" style="display:block" >
                    <strong>{{ $errors->first('user_id') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-success">{{ $photo->isNew ? 'Create' : 'Update' }}</button>
        </div>
    </div>
</form>
@section('footer-script')
    <script src="{{ asset('js/photo.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.photo-users').select2({
                placeholder: 'Select an user',
                minimumInputLength: 0,
                ajax: {
                    url: '/ajax/users',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term || '',
                            page: params.page || 1
                        }
                    },
                    processResults: function (response) {
                        return {
                            results:  $.map(response.results, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            }),
                            pagination: {
                                more: response.pagination.more
                            },
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
@endsection
