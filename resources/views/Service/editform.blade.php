@extends('layouts.guest')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Service Section</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('service.index')}}">Service</a></li>
                        <li class="breadcrumb-item active"> Update Form</li>
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
                            <h3 class="card-title">Update Service Details</h3>
                        </div>
                        <form action="{{ route('service.update',$services->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" value="{{old('title',$services->title)}}">
                                    @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title">Subtitle</label>
                                    <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="Enter Subtitle" value="{{old('subtitle',$services->subtitle)}}">
                                    @error('subtitle')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title">Please Select Type</label>
                                    <select class="form-control" name="service_type" id="service_type">
                                        <option selected disabled>Please Select Type</option>
                                        <option value="Real Estate Consulting Service"
                                            {{ old('service_type', $services->service_type) === 'Real Estate Consulting Service' ? 'selected' : '' }}>
                                            Real Estate Consulting Service
                                        </option>
                                        <option value="Development"
                                            {{ old('service_type', $services->service_type) === 'Development' ? 'selected' : '' }}>
                                            Development
                                        </option>
                                    </select>
                                    @error('service_type')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="title">Decription 1</label>
                                    <textarea type="text" class="form-control" name="description_1" id="description_1">{{old('description_1',$services->description_1)}}</textarea>
                                    @error('description_1')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="title">Decription 2</label>
                                    <textarea type="text" class="form-control" name="description_2" id="description_2">{{old('description_2',$services->description_2)}}</textarea>
                                    @error('description_2')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @php
                                $pointers = json_decode($services->pointers) ?? [];

                                @endphp

<div class="form-group">
    <label>Pointers</label>
    <div id="Pointers-container">
        @foreach ($pointers as $pointer)
        <div class="input-group mb-2 pointer-group">
            <input type="text" name="pointers[]" class="form-control" placeholder="Enter Pointer" value="{{ $pointer }}">
            <div class="input-group-append">
                <button class="btn btn-danger remove-Pointer" type="button">Remove</button>
            </div>
        </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-success" id="add-Pointer">Add Pointer</button>
</div>

                                <div class="form-group">
                                    <label for="title">Button Text</label>
                                    <input type="text" class="form-control" name="button_content" id="button_content" placeholder="Enter Button Text" value="{{old('button_content',$services->button_content)}}">
                                    @error('button_content')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title">Button Link</label>
                                    <input type="text" class="form-control" name="button_link" id="button_link" placeholder="Enter Button Link" value="{{old('button_link',$services->button_link)}}">
                                    @error('button_link')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title">Background Color</label>
                                    <input type="color" class="form-control" name="background_color" id="background_color">
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <img id="blah"  src="{{ asset(str_replace('storage/app/public', 'storage', $services->image)) }}" alt="your image" style="width: 130px;" />
                                    <input type="file" class="form-control" name="image" id="imgInp">
                                    @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="background_image">Background Center Image</label>
                                    <img id="bg_image" src="{{ asset(str_replace('storage/app/public', 'storage', $services->background_image)) }}" style="width: 130px;" />
                                    <input type="file" class="form-control" name="background_image" id="background_image">
                                    @error('background_image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    // Add new pointer input field
    document.getElementById('add-Pointer').addEventListener('click', function () {
    const container = document.getElementById('Pointers-container');
    const newInputGroup = document.createElement('div');
    newInputGroup.classList.add('input-group', 'mb-2');
    newInputGroup.innerHTML = `
        <input type="text" name="pointers[]" class="form-control" placeholder="Enter Pointer">
        <div class="input-group-append">
            <button class="btn btn-danger remove-Pointer" type="button">Remove</button>
        </div>
    `;
    container.appendChild(newInputGroup);
});

document.getElementById('Pointers-container').addEventListener('click', function (event) {
    if (event.target && event.target.classList.contains('remove-Pointer')) {
        const inputGroup = event.target.closest('.input-group');
        if (inputGroup) {
            inputGroup.remove();
        }
    }
});


    imgInp.onchange = evt => {
        const [file] = imgInp.files;
        if (file) {
            blah.src = URL.createObjectURL(file);
            blah.style.display = "block"; // Show the image
        } else {
            blah.style.display = "none"; // Hide the image if no file is selected
            blah.src = "#"; // Reset the src
        }
    };

    background_image.onchange = evt => {
        const [file] = background_image.files;
        if (file) {
            bg_image.src = URL.createObjectURL(file);
            bg_image.style.display = "block"; // Show the image
        } else {
            bg_image.style.display = "none"; // Hide the image if no file is selected
            bg_image.src = "#"; // Reset the src
        }
    };
</script>

@endsection