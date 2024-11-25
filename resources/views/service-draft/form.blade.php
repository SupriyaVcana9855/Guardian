@extends('layouts.guest')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Service Section</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('service-draft.edit')}}">Service</a></li>
                        <li class="breadcrumb-item active">Add Form</li>
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
                            <h3 class="card-title">Add Service Details</h3>
                        </div>
                        <form action="{{ route('service-draft.store') }}" method="POST" enctype="multipart/form-data" id="serviceForm">
                            @csrf
                            <input type="hidden" name="id" id="draft_id" value="{{ old('id', $draft->id ?? '') }}">

                            <div class="card-body">
                                <!-- Title -->
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control draft-service-store" name="title" id="title" placeholder="Enter title" value="{{ old('title', $draft->title ?? '') }}">
                                </div>

                                <!-- Subtitle -->
                                <div class="form-group">
                                    <label for="title">Subtitle</label>
                                    <input type="text" class="form-control draft-service-store" name="subtitle" id="subtitle" placeholder="Enter Subtitle" value="{{old('subtitle', $draft->subtitle ?? '')}}">
                                </div>

                                <div class="form-group">
    <label for="title">Please Select Type</label>
    <select class="form-control" name="service_type" id="service_type">
        <option selected disabled>Please Select Type</option>
        <option value="Real Estate Consulting Service"
            {{ (old('service_type') ?? ($draft->service_type ?? '')) === 'Real Estate Consulting Service' ? 'selected' : '' }}>
            Real Estate Consulting Service
        </option>
        <option value="Development"
            {{ (old('service_type') ?? ($draft->service_type ?? '')) === 'Development' ? 'selected' : '' }}>
            Development
        </option>
    </select>
    @error('service_type')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>



                                <!-- Description 1 -->
                                <div class="form-group">
                                    <label for="title">Description 1</label>
                                    <textarea type="text" class="form-control draft-service-store" name="description_1" id="description_1">{{old('description_1', $draft->description_1 ?? '')}}</textarea>
                                </div>

                                <!-- Description 2 -->
                                <div class="form-group">
                                    <label for="title">Description 2</label>
                                    <textarea type="text" class="form-control draft-service-store" name="description_2" id="description_2">{{old('description_2', $draft->description_2 ?? '')}}</textarea>
                                </div>

                                <!-- Pointers -->
                          <!-- Pointers -->
@php
$pointers = isset($draft->pointers) ? json_decode($draft->pointers) : [];
@endphp

@if (empty($pointers))
<div class="form-group">
    <label>Pointers</label>
    <div id="Pointers-container">
        <div class="input-group mb-2 pointer-group">
            <input type="text" name="pointers[]" class="form-control" placeholder="Enter Pointer" value="">
            <div class="input-group-append">
                <button class="btn btn-danger remove-Pointer" type="button">Remove</button>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-success" id="add-Pointer">Add Pointer</button>
</div>
@else
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
@endif


                                <!-- Button Content -->
                                <div class="form-group">
                                    <label for="title">Button Text</label>
                                    <input type="text" class="form-control draft-service-store" name="button_content" id="button_content" placeholder="Enter Button Text" value="{{old('button_content', $draft->button_content ?? '')}}">
                                </div>

                                <!-- Button Link -->
                                <div class="form-group">
                                    <label for="title">Button Link</label>
                                    <input type="text" class="form-control draft-service-store" name="button_link" id="button_link" placeholder="Enter Button Link" value="{{old('button_link', $draft->button_link ?? '')}}">
                                </div>

                                <!-- Background Color -->
                                <div class="form-group">
                                    <label for="background_color">Background Color</label>
                                    <input type="color" class="form-control draft-service-store" name="background_color" id="background_color" value="{{ old('background_color', $draft->background_color ?? '#0476b4') }}">
                                </div>

                                <!-- Image Upload -->
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <img id="blah" src="{{ asset($draft->image ?? '') }}" style="width: 130px;" />

                                    <input type="file" class="form-control" name="image" id="imgInp" accept="image/*">
                                </div>

                                <!-- Background Image Upload -->
                                <div class="form-group">
                                    <label for="background_image">Background Image</label>
                                    <img id="bg_image" src="{{ asset($draft->background_image ?? '') }}" style="width: 130px;" />

                                    <input type="file" class="form-control" name="background_image" id="background_image" accept="image/*">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="submit" id="submit_status" value="1" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<script>
// Handle the 'keyup' and 'change' events for draft saving
document.querySelectorAll('.draft-service-store').forEach(element => {
    element.addEventListener('keyup', function () {
        saveDraft(0); // Save as draft with submit_status 0
    });
});

document.querySelectorAll('input[type="file"]').forEach(element => {
    element.addEventListener('change', function () {
        saveDraft(0); // Save as draft with submit_status 0
    });
});

// Handle form submission
document.getElementById('serviceForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission
    saveDraft(1); // Set submit_status to 1 for actual submission
});

// Function to save the draft or submit the form
function saveDraft(submitStatus) {
    const formData = new FormData(document.getElementById('serviceForm'));
    formData.append('submit_status', submitStatus); // Set submit_status dynamically

    // Include the draft ID if available
    const draftId = document.getElementById('draft_id') ? document.getElementById('draft_id').value : null;
    if (draftId) {
        formData.append('id', draftId); // Attach draft ID to the form data
    }

    $.ajax({
        url: "{{ route('service-draft.store') }}", // URL for storing the draft
        type: "POST",
        data: formData,
        processData: false, // Prevent jQuery from processing the data
        contentType: false, // Let FormData set the content-type header
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for security
        },
        success: function(response) {
            if (response.draft_id) {
                document.getElementById('draft_id').value = response.draft_id; // Update draft ID
            }
            if (submitStatus === 1) {
                // If submitted, you can redirect or show a success message
                // alert("Form submitted successfully!");
                window.location.href= "{{route('service-draft.index')}}";
            }
        },
        error: function(xhr) {
            console.error("Error saving draft:", xhr.responseText);
        }
    });
}

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