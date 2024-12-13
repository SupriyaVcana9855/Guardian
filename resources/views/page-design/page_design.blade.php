@extends('layouts.guest')
@section('content')
<!-- Include CKEditor CSS -->
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.css">

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Styles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('page.index')}}">Styles</a></li>
                        <li class="breadcrumb-item active">Styles Form</li>
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
                            <h3 class="card-title">Add Styles</h3>
                        </div>
                        <!-- Form Start -->
                        <form  action="{{ isset($pageData->id) ? route('page.update', $pageData->id) : route('page.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                             @if (isset($pageData->id))
                                @method('PUT')
                            @endif
                            <div class="card-body">
                              <input type="hidden" name="hidden_id" value="{{$pageData->id}}">

                                <div class="col-md-12">
                                    <label for="category">Category</label>
                                    <select class="form-control" name="category" id="category">
                                        @foreach(['Title', 'Subtitle', 'Description', 'Header', 'Footer'] as $category)
                                            <option value="{{ $category }}" {{ isset($pageData) && $pageData->category == $category ? 'selected' : '' }}>
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('font_size')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <br><br>
                                <div class="row">
                                    <div class="col-md-6">
                                         <label for="font_size">Font Size</label>
                                            <select class="form-control" name="font_size" id="font_size">
                                                <option value="8px" {{ old('font_size', $pageData->font_size ?? '') == '8px' ? 'selected' : '' }}>8px</option>
                                                <option value="10px" {{ old('font_size', $pageData->font_size ?? '') == '10px' ? 'selected' : '' }}>10px</option>
                                                 <option value="12px" {{ old('font_size', $pageData->font_size ?? '') == '12px' ? 'selected' : '' }}>12px</option>
                                                <option value="14px" {{ old('font_size', $pageData->font_size ?? '') == '14px' ? 'selected' : '' }}>14px</option>
                                                <option value="16px" {{ old('font_size', $pageData->font_size ?? '') == '16px' ? 'selected' : '' }}>16px</option>
                                                <option value="18px" {{ old('font_size', $pageData->font_size ?? '') == '18px' ? 'selected' : '' }}>18px</option>
                                                <option value="20px" {{ old('font_size', $pageData->font_size ?? '') == '20px' ? 'selected' : '' }}>20px</option>
                                            </select>
                                            @error('font_size')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="font_weight">Font Weight</label>
                                             <select class="form-control" name="font_weight" id="font_weight">
                                                <option value="100" {{ old('font_weight', $pageData->font_weight ?? '') == '100' ? 'selected' : '' }}>100</option>
                                                <option value="200" {{ old('font_weight', $pageData->font_weight ?? '') == '200' ? 'selected' : '' }}>200</option>
                                                 <option value="300" {{ old('font_weight', $pageData->font_weight ?? '') == '300' ? 'selected' : '' }}>300</option>
                                                <option value="400" {{ old('font_weight', $pageData->font_weight ?? '') == '400' ? 'selected' : '' }}>400</option>
                                                <option value="500" {{ old('font_weight', $pageData->font_weight ?? '') == '500' ? 'selected' : '' }}>500</option>
                                                <option value="600" {{ old('', $pageData->font_weight ?? '') == '600' ? 'selected' : '' }}>600</option>
                                                <option value="700" {{ old('font_weight', $pageData->font_weight ?? '') == '700' ? 'selected' : '' }}>700</option>
                                                <option value="800" {{ old('font_weight', $pageData->font_weight ?? '') == '800' ? 'selected' : '' }}>800</option>
                                                <option value="900" {{ old('font_weight', $pageData->font_weight ?? '') == '900' ? 'selected' : '' }}>900</option>
                                            </select>
                                            @error('font_weight')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="content_color">Color</label>
                                            <input type="color" class="form-control" name="content_color" id="content_color" value="{{ old('content_color') }}">
                                            @error('content_color')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="text_alignment">Alignment</label>
                                            <select class="form-control" name="text_alignment" id="text_alignment">
                                               @foreach(['Left', 'Right', 'Center', 'Justify'] as $alignment)
                                                    <option value="{{ $alignment }}" {{ isset($pageData) && $pageData->text_alignment == $alignment ? 'selected' : '' }}>
                                                        {{ $alignment }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('text_alignment')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            
                            
                            </div>

                            <!-- Submit Button -->
                            <div class="card-footer">
                             <button type="button" class="btn btn-primary apply" style=" margin-left: 3px;">Apply</button>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <!-- Form End -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Include CKEditor JS -->
<script src="https://cdn.ckeditor.com/4.25.0/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  
  $('.apply').on('click',function(){
    alert("hfks");
    var font_size = $('[name="font_size"]').val();
    var text_alignment = $('[name="text_alignment"]').val();
    var content_color = $('[name="content_color"]').val();
    var font_weight = $('[name="font_weight"]').val();
    var category = $('[name="category"]').val();
    var hidden_id = $('[name="hidden_id"]').val();

    $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "{{ route('saveDesign') }}",
        data : {'font_size' : font_size,
        'text_alignment':text_alignment,
        'content_color':content_color,
        'font_weight':font_weight,
        'category':category,
               'hidden_id':hidden_id},
        type : 'post',
        dataType : 'json',
        success : function(result){

           Swal.fire({
                    title: result.message,
                    icon: 'success',
                    confirmButtonColor: '#02476c',
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
        }
    });

   
  })
  

</script>


@endsection
