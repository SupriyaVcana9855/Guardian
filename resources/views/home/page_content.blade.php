@extends('layouts.guest')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Section</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('content.index') }}">Content</a></li>
                        <li class="breadcrumb-item active">{{ isset($content->id) ? 'Edit Form' : 'Add Form' }}</li>
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
                            <h3 class="card-title">Page Content</h3>
                        </div>
                        <form action="{{ isset($content->id) ? route('content.update', $content->id) : route('content.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($content->id))
                                @method('PUT')
                            @endif
                           <input type="hidden" value="{{ $content->id ?? '' }}" name="hidden_id">
                          
                            <div class="card-body">
                                <!-- Title and Subtitle -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input class="form-control" name="title" id="title" placeholder="Enter Title" value="{{ old('title', $content->title ?? '') }}">
                                            @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subtitle">Sub Title</label>
                                            <input class="form-control" name="subtitle" id="subtitle" placeholder="Enter SubTitle" value="{{ old('subtitle', $content->subtitle ?? '') }}">
                                            @error('subtitle')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Descriptions -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description_1">First Description</label>
                                            <textarea class="form-control" name="description_1" id="description_1" placeholder="Enter description">{{ old('description_1', $content->description_1 ?? '') }}</textarea>
                                            @error('description_1')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description_2">Second Description</label>
                                            <textarea class="form-control" name="description_2" id="description_2" placeholder="Enter description">{{ old('description_2', $content->description_2 ?? '') }}</textarea>
                                            @error('description_2')
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
                                            <input type="text" class="form-control" name="button_content" id="button_content" placeholder="Enter Button Text" value="{{ old('button_content', $content->button_content ?? '') }}">
                                            @error('button_content')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="button_link">Button Link</label>
                                            <input type="text" class="form-control" name="button_link" id="button_link" placeholder="Enter Button Link" value="{{ old('button_link', $content->button_link ?? '') }}">
                                            @error('button_link')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Background Image and Color -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="background_image">Background Image</label>

                                            @if(isset($content->content_background_image))
                                                <img id="background_preview" src="{{ asset(str_replace('storage/app/public', 'storage', $content->content_background_image)) }}" alt="Image Preview" style="width: 130px;" />
                                            @else
                                                <img id="background_preview" src="#" alt="Image Preview" style="width: 130px; display: none;" />
                                            @endif
                                            <input type="file" class="form-control" name="background_image" id="background_image" accept="image/*">
                                            @error('background_image')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="background_color">Background Color</label>
                                            <input type="color" class="form-control" name="content_background_color" id="background_color" value="{{ old('background_color', $content->content_background_color ?? '#000000') }}">
                                            @error('background_color')
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
                                            @if(isset($content->image))
                                                <img id="image_preview" src="{{ asset(str_replace('storage/app/public', 'storage', $content->image)) }}" alt="Image Preview" style="width: 130px;" />
                                            @else
                                                <img id="image_preview" src="#" alt="Image Preview" style="width: 130px; display: none;" />
                                            @endif
                                            <input type="file" class="form-control" name="image" id="image_input" accept="image/*">
                                            @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="content_alignment">Choose Alignment</label>
                                            <select class="form-control" name="content_alignment" id="content_alignment">
                                                <option value="left" {{ old('content_alignment', $content->content_alignment ?? '') == 'left' ? 'selected' : '' }}>Left</option>
                                                <option value="right" {{ old('content_alignment', $content->content_alignment ?? '') == 'right' ? 'selected' : '' }}>Right</option>
                                            </select>
                                            @error('content_alignment')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <input type="checkbox" id="status" name="status" {{ old('status', $content->status ?? false) ? 'checked' : '' }}>
                                            <label for="status">Show On Website</label>
                                            @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ isset($content->id) ? 'Update' : 'Submit' }}</button>
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
    CKEDITOR.replace('description_1');
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
