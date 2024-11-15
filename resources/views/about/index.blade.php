@extends('layouts.guest')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Header</h3>
                <button class="btn btn-primary" style="margin-left: 82%;" ><a style="color:white" href="{{ route('abouts.create') }}">Add Home Section</a></button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description 1</th>
                            <th>Description 2</th>
                           <!--   <th>Button Content</th> -->
                            <th>Background Color</th>
                             <!-- <th>Button Link</th> -->
                            <th>Background Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aboutUs as $key => $home)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $home->title }}</td>
                            <td>{{ $home->description_1 }}</td>
                            <td>{{ $home->description_2 }}</td>
                          <!--   <td>{{ $home->button_content }}</td> -->
                            <td>{{ $home->background_color }}</td>
                            <!-- <td>{{ $home->button_link }}</td> -->
                            <td>{{ $home->background_image }}</td>
                            <td>
                                <i class="fa fa-edit"></i>
                                <i class="fa fa-trash"></i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection