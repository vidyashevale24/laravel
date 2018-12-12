@extends('adminlte::layouts.app')
 
@section('htmlheader_title', 'Create '.$module_name)
 
@section('main-content')
@push('body-class')
hold-transition skin-blue sidebar-mini
@endpush
 
<!-- Content Header (Page header) -->
<div class="container-fluid spark-screen">
    <section class="content-header">
        <h1>
            Create {{ $module_name }}
        </h1>
    </section>
 
    <!-- Main content -->
    <section class="content">
 
        <!-- SELECT2 EXAMPLE -->
        <form action="<?php print route($route_path.'.store'); ?>" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            @if($errors->any())
                <div class="alert alert-danger">
                    <p><strong>Opps Something went wrong</strong></p>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            <div class="box box-default">                                   
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $module_name }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="slug">Slug<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description<span class="text-danger">*</span></label>
                                <textarea placeholder="Enter Description" class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
 
                </div>
                <!-- /.box-body -->
 
                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
                    <a href="{{ route($route_path.'.index') }}"><button type="button" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Cancel</button></a>
                </div>
 
            </div>
        </form>
        <!-- /.box -->
 
 
        <!-- /.row -->
 
    </section>
</div>
@endsection