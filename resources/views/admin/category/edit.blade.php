@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        edit category
    </div>
    <div class="card-body">
        <form action="{{ route("admin.category.update", [$category->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('global.product.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($category) ? $category->name : '') }}">
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.product.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group">
                @if ("/storage/images/{{ $category->photo }}")
                    <img src="/storage/images/{{ $category->photo }}" style="width: 50px;">
                @else
                    <p>No image found</p>
                @endif
                    <input type="file" name="photo" value="{{ $category->photo }}"/>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection