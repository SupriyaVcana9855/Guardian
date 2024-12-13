@extends('layouts.guest')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Home Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ isset($home->id) ? 'Edit Form' : 'Add Form' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header" style="background-color:#0476b4">
                            <h3 class="card-title">Hero Section</h3>
                        </div>
                        <form action="{{ isset($home->id) ? route('home.update', $home->id) : route('home.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($home->id))
                                @method('PUT')
                            @endif
                           <input type="hidden" value="{{ $home->id ?? '' }}" name="hidden_id">
                          
                            <div class="card-body">
                                <!-- Title and Subtitle -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input class="form-control" name="title" id="title" placeholder="Enter Title" value="{{ old('title', $home->title ?? '') }}">
                                            @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subtitle">Sub Title</label>
                                            <input class="form-control" name="subtitle" id="subtitle" placeholder="Enter SubTitle" value="{{ old('subtitle', $home->subtitle ?? '') }}">
                                            @error('subtitle')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Descriptions -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" name="description" id="description" placeholder="Enter description">{{ old('description', $home->description ?? '') }}</textarea>
                                            @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                  
                                </div>

                                <!-- Button Content and Link -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="button_content">Button Text</label>
                                            <input type="text" class="form-control" name="button_content" id="button_content" placeholder="Enter Button Text" value="{{ old('button_content', $home->button_content ?? '') }}">
                                            @error('button_content')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="button_link">Button Link</label>
                                            <input type="text" class="form-control" name="button_link" id="button_link" placeholder="Enter Button Link" value="{{ old('button_link', $home->button_link ?? '') }}">
                                            @error('button_link')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                              

                                <!-- Image and Alignment -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            @if(isset($home->image))
                                                <img id="image_preview" src="{{ asset(str_replace('storage/app/public', 'storage', $home->image)) }}" alt="Image Preview" style="width: 130px;" />
                                            @else
                                                <img id="image_preview" src="#" alt="Image Preview" style="width: 130px; display: none;" />
                                            @endif
                                            <input type="file" class="form-control" name="image" id="image_input" accept="image/*">
                                            @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                 
                                </div>
                                <!-- Status -->
                            </div>

                            <!-- Submit Button -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ isset($home->id) ? 'Update' : 'Submit' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    // CKEditor Initialization
    CKEDITOR.replace('description');
    CKEDITOR.replace('description_2');

    // Image Preview
    $('#background_image').on('change', function (evt) {
        const [file] = evt.target.files;
        const preview = $('#background_preview');
        if (file) {
            preview.attr('src', URL.createObjectURL(file)).show();
        }
    });

    $('#image_input').on('change', function (evt) {
        const [file] = evt.target.files;
        const preview = $('#image_preview');
        if (file) {
            preview.attr('src', URL.createObjectURL(file)).show();
        }
    });
</script>

@endsection
