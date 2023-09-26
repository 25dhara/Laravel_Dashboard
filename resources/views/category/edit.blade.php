@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Category</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Category</a></li>
                            <li class="breadcrumb-item active">Edit Category</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Edit Category</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="POST" action="{{ route('category.update', $category->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') <!-- Use the PUT method for updating -->
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ $category->name }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Slug</label>
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                            id="slug" name="slug" value="{{ $category->slug }}">
                                        @error('slug')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="d-flex form-group">
                                        <div class="d-flex align-items-center">
                                            <label for="icon" class="mr-2">Icon</label>
                                            <input type="file" class="@error('icon') is-invalid @enderror" id="icon"
                                                name="icon">
                                            <span class="mx-2">
                                                <img src="/{{ $category->icon }}" width="60px" alt="Category Image"
                                                    id="categoryImage1">
                                            </span>
                                            <span class="mx-2" id="deleteIcon">
                                                <i class="fas fa-trash text-danger" onclick="removeIcon()"></i>
                                            </span>
                                            <span class="mx-2" id="undoIcon" style="display: none;">
                                                <i class="fas fa-undo text-primary" onclick="undoIcon()"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <input type="hidden" id="removeicontxt" name="removeicontxt" value="">


                                    @error('icon')
                                        <span class="error invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="d-flex form-group">
                                        <div class="d-flex align-items-center">
                                            <label for="logo" class="mr-2">Logo</label>
                                            <input type="file" class="@error('logo') is-invalid @enderror" id="logo"
                                                name="logo">
                                            <span class="mx-2">
                                                <img src="/{{ $category->logo }}" width="60px" alt="Category Image"
                                                    id="categoryImage2">
                                            </span>
                                            <span class="mx-2" id="deleteLogo">
                                                <i class="fas fa-trash text-danger" onclick="removeLogo()"></i>
                                            </span>
                                            <span class="mx-2" id="undoLogo" style="display: none;">
                                                <i class="fas fa-undo text-primary" onclick="undoLogo()"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <input type="hidden" id="removelogotxt" name="removelogotxt" value="">
                                    @error('logo')
                                        <span class="error invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror



                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="is_active"
                                                id="customSwitch1" {{ $category->is_active == 1 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customSwitch1">Active</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="is_popular"
                                                id="customSwitch2" {{ $category->is_popular == 1 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customSwitch2">Popular</label>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="is_technical"
                                                id="customSwitch3" {{ $category->is_technical == 1 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customSwitch3">Technical</label>
                                        </div>
                                    </div>


                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function removeIcon() {
        $('#undoIcon').show();
        $('#deleteIcon').hide();
        $('#removeicontxt').val('removed');
        $('#categoryImage1').attr('src', '{{ asset('Images/NoImage.png') }}');
    }

    function undoIcon() {
        $('#undoIcon').hide();
        $('#deleteIcon').show();
        $('#removeicontxt').val('');
        $('#categoryImage1').attr('src', '/{{ $category->icon }}');
    }

    function removeLogo() {
        $('#undoLogo').show();
        $('#deleteLogo').hide();
        $('#removelogotxt').val('removed');
        $('#categoryImage2').attr('src', '{{ asset('Images/NoImage.png') }}');
    }

    function undoLogo() {
        $('#undoLogo').hide();
        $('#deleteLogo').show();
        $('#removelogotxt').val('');
        $('#categoryImage2').attr('src', '/{{ $category->logo }}');
    }
</script>
