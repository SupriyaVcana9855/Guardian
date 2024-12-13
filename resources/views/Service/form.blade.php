@extends('layouts.guest')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($service) ? 'Edit Service Section' : 'Add Service Section' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('service.index') }}">Service</a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ isset($service) ? 'Edit Form' : 'Add Form' }}
                        </li>
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
                            <h3 class="card-title">{{ isset($service) ? 'Edit Service Details' : 'Add Service Details' }}</h3>
                        </div>

                        <form action="{{ isset($service->id) ? route('service.update', $service->id) : route('service.store') }}" 
                              method="POST" enctype="multipart/form-data">
                            @csrf
                          @if($service->id)
                          @method('PUT');
                          @endif

                            <input type="hidden" name="hidden_id" value="{{ $service->id }}">
                            <div class="card-body">
                                <!-- Service Type -->
                                <div class="form-group">
                                    <label for="service_type">Please Select Type</label>
                                    <select class="form-control" name="service_type" id="service_type">
                                        <option selected disabled>Please Select Type</option>
                                        @if (isset($headerChild[0]->children) && $headerChild[0]->children->isNotEmpty())
                                            @foreach($headerChild[0]->children as $child)
                                                <option value="{{ $child->category }}" 
                                                    {{ old('service_type', $service->service_type ?? '') == $child->category ? 'selected' : '' }}>
                                                    {{ $child->category }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="">No children available</option>
                                        @endif
                                    </select>
                                    @error('service_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Title and Subtitle -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" name="title" id="title" 
                                                value="{{ old('title', $service->title ?? '') }}" placeholder="Enter Title">
                                            @error('title')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subtitle">Subtitle</label>
                                            <input type="text" class="form-control" name="subtitle" id="subtitle" 
                                                value="{{ old('subtitle', $service->subtitle ?? '') }}" placeholder="Enter Subtitle">
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
                                            <label for="description_1">Description 1</label>
                                            <textarea class="form-control" name="description_1" id="description_1">{{ old('description_1', $service->description_1 ?? '') }}</textarea>
                                            @error('description_1')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description_2">Description 2</label>
                                            <textarea class="form-control" name="description_2" id="description_2">{{ old('description_2', $service->description_2 ?? '') }}</textarea>
                                            @error('description_2')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Pointer Fields -->
                                <div class="form-group">
                                    <label>Pointers</label>
                                    <div id="Pointers-container">
                                        @if(isset($service->id) && !empty($service->pointers))
                                            @foreach(json_decode($service->pointers) as $pointer)
                                                <div class="input-group mb-2">
                                                    <input type="text" name="pointers[]" class="form-control" value="{{ $pointer }}">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-danger remove-Pointers" type="button">Remove</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="input-group mb-2">
                                                <input type="text" name="pointers[]" class="form-control" placeholder="Enter Pointers">
                                                <div class="input-group-append">
                                                    <button class="btn btn-danger remove-Pointers" type="button">Remove</button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-success" id="add-Pointers">Add Pointer</button>
                                </div>

                                <!-- Other Fields -->
                                <!-- Add similar logic for all other fields -->



                              <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Button Text</label>
                                            <input type="text" class="form-control" name="button_content" id="button_content" placeholder="Enter Button Text" value="{{ old('button_content' , $service->button_content) }}">
                                            @error('button_content')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Button Link</label>
                                            <select class="form-control" name="button_link" id="button_link">
                                                <option selected disabled>Please Select Type</option>
                                                @foreach($links as $link)
                                                    <option value="{{ $link->link }}" {{ old('button_link') == $link->link ? 'selected' : '' }}>{{ $link->link }}</option>
                                                @endforeach
                                            </select>
                                            @error('button_link')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                              <label for="image">Image</label>
                                            @if(isset($service->image))
                                                <img id="image_preview" src="{{ asset(str_replace('storage/app/public', 'storage', $service->image)) }}" alt="Image Preview" style="width: 130px;" />
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
                               
                                <div class="form-group">
                                    <label for="image">Choose whether to display an image or a color in the Content background</label>
                                    <select class="form-control" name="type" id="type">
                                                                
                                        <option value="image" {{ old('type', $service->type ?? '') == 'image' ? 'selected' : ''}}>Image</option>
                                        <option value="color" {{ old('type', $service->type ?? '') == 'color' ? 'selected' : ''}}>Color</option>
                                    
                                    
                                    </select>
                                    @error('type')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                              
                                <div class="row">
                                    <div class="col-md-6" id="backgroundImage" style="display: none;">
                                        <div class="form-group">
                                            <label for="background_image">Background Image</label>
                                            @if(isset($service->background_image))
                                                <img id="background_preview" src="{{ asset($service->background_image) }}" alt="Image Preview" style="width: 130px;" />
                                            @else
                                                <img id="background_preview" src="#" alt="Image Preview" style="width: 130px; display: none;" />
                                            @endif
                                            <input type="file" class="form-control" name="background_image" id="background_image" accept="image/*">
                                            @error('background_image')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="backgroundColor" style="display: none;">
                                        <div class="form-group">
                                            <label for="background_color">Background Color</label>
                                            <input type="color" class="form-control" name="background_color" id="background_color" value="{{ old('background_color', $service->background_color ?? '#000000') }}">
                                            @error('background_color')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mt-4"> 
                                        <div class="form-group">
                                            <input type="checkbox" id="status" name="status" {{ (old('status', $service->status ?? '') == '1' || $service->status) ? 'checked' : '' }}>
                                            <label for="status">Show On Website</label>
                                            @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-4"> 
                                        <div class="form-group">
                                            <input type="checkbox" id="show_on_home_page" name="show_on_home_page" {{ (old('show_on_home_page', $service->show_on_home_page ?? '') == '1' || $service->show_on_home_page) ? 'checked' : '' }}>
                                            <label for="show_on_home_page">Show On Home Page</label>
                                            @error('show_on_home_page')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- Submit Button -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{ isset($service->id) ? 'Update' : 'Submit' }}</button>
                                </div>
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


  // Handle dynamic display of background image or color based on the selected type
    document.addEventListener('DOMContentLoaded', function () {

        const typeSelect = document.getElementById('type');
        const backgroundImageDiv = document.getElementById('backgroundImage');
        const backgroundColorDiv = document.getElementById('backgroundColor');

        // Update display on change
        typeSelect.addEventListener('change', function () {
            toggleBackgroundFields();
        });

        // Function to toggle fields
        function toggleBackgroundFields() {
            if (typeSelect.value === 'image') {
                backgroundImageDiv.style.display = 'block';
                backgroundColorDiv.style.display = 'none';
            } else if (typeSelect.value === 'color') {
                backgroundImageDiv.style.display = 'none';
                backgroundColorDiv.style.display = 'block';
            }
        }

        // Initial check to show the correct field based on the pre-selected type value
        toggleBackgroundFields();
    });


    document.getElementById('add-Pointers').addEventListener('click', function () {
        const container = document.getElementById('Pointers-container');
        const newInputGroup = document.createElement('div');
        newInputGroup.classList.add('input-group', 'mb-2');
        newInputGroup.innerHTML = `
            <input type="text" name="pointers[]" class="form-control" placeholder="Enter Pointers">
            <div class="input-group-append">
                <button class="btn btn-danger remove-Pointers" type="button">Remove</button>
            </div>
        `;
        container.appendChild(newInputGroup);
    });

    document.getElementById('Pointers-container').addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-Pointers')) {
            event.target.closest('.input-group').remove();
        }
    });
   

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
        // Background image preview functionality
        $('#background_image').on('change', function (evt) {
            const [file] = evt.target.files;
            if (file) {
                $('#background_preview').attr('src', URL.createObjectURL(file)).show();
            } else {
                $('#background_preview').attr('src', '#').hide();
            }
        });
     const type = $('#type').val();
        toggleBackgroundFields(type);

        // Change event to toggle fields dynamically
        $('#type').on('change', function () {
            toggleBackgroundFields($(this).val());
        });

        // Function to show/hide background fields
        function toggleBackgroundFields(type) {
            if (type === 'image') {
                $('#backgroundImage').show();
                $('#backgroundColor').hide();
            } else if (type === 'color') {
                $('#backgroundImage').hide();
                $('#backgroundColor').show();
            }
        }
</script>


@endsection
