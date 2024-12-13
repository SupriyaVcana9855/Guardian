@extends('layouts.guest')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ ucfirst($category) }} Background Section</h1>
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
                        <h3 class="card-title">Basic Details</h3>
                    </div>
                    <form action="{{ route('savebackground') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <input type="hidden" value="{{ $category }}" name="category" id="background_color">
                            
                             <div class="form-group">
                                <label for="image">Choose whether to display an image or a color in the center background</label>
                                <select class="form-control" name="type" id="type">
                                <option value ="image">{{"Image"}}</option>
                                <option value ="color">{{"Color"}}</option>
                                </select>
                                @error('type')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6" id ="backgroundImage" >
                                    <div class="form-group">
                                        <label for="background_image">Background
                                         Image</label>
                                        @if($centerData->id)
                                            <img id="bg_image" src="{{ asset(str_replace('storage/app/public', 'storage', $centerData->background_image)) }}" style="width: 130px;" />
                                        @endif

                                        <img id="bg_image" src="#" alt="Background Image Preview" style="width: 130px; display:none" />
                                        <input type="file" class="form-control" name="background_image" id="background_image" accept="image/*">
                                        @error('background_image')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6" id ="backgroundColor" style="display:none">
                                    <div class="form-group">
                                        <label for="background_color">Background Color</label>
                                        <input type="color" class="form-control" value="{{ old('background_color') }}" name="background_color" id="background_color">
                                        @error('background_color')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
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

    $('#type').on('change', function () {
    const type = $(this).val();
    if (type === 'image') {
        $('#backgroundImage').show();
        $('#backgroundColor').hide();
    } else if (type === 'color') {
        $('#backgroundImage').hide();
        $('#backgroundColor').show();
    }
});

</script>

@endsection