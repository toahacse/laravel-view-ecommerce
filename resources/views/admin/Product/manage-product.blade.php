@extends("admin/layout/layout")
@section("content")
    <script src="{{ asset('ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>

    <div class="page-wrapper">
        <div class="page-content">
              <!--breadcrumb-->
              <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Product</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Product</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                        <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                            <a class="dropdown-item" href="javascript:;">Another action</a>
                            <a class="dropdown-item" href="javascript:;">Something else here</a>
                            <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

            <h6 class="mb-0 text-uppercase">Product</h6>
            <hr/>
            <div class="col text-end">
                <a href="{{ url('admin/manage-product') }}/0" class="btn btn-outline-primary mb-2" ><i class="bx bx-plus mr-1"></i>Add </a>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bxs-user me-1 font-22 text-info"></i>
                            </div>
                            <h5 class="mb-0 text-info">Add Product</h5>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Select Category</label>
                            <div class="col-sm-9">
                                <select class="form-control"  name="category_id" id="category_id">
                                    <option value="0">Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Select Brand</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="brand_id" id="brand_id">
                                    <option value="0">Select Brand</option>
                                    @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->text}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Product Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" value="{{ $data->name }}" id="name" placeholder="Enter product name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="slug" class="col-sm-3 col-form-label">Slug</label>
                            <div class="col-sm-9">
                                <input type="text" name="slug" class="form-control" value="{{ $data->slug }}" id="slug" placeholder="Enter slug">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="item_code" class="col-sm-3 col-form-label">Item Code</label>
                            <div class="col-sm-9">
                                <input type="text" name="item_code" class="form-control" value="{{ $data->item_code }}" id="item_code" placeholder="Enter item code">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="keywords" class="col-sm-3 col-form-label">Keywords</label>
                            <div class="col-sm-9">
                                <input type="text" name="keywords" class="form-control" value="{{ $data->keywords }}" id="keywords" placeholder="Enter keywords">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Select Tax</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="tax_id" id="tax_id">
                                    <option value="0">Select Tax</option>
                                    @foreach($taxes as $tax)
                                    <option value="{{$tax->id}}">{{$tax->text}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" id="description" rows="3" placeholder="Description">{{ $data->description }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="image" class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" name="image" class="form-control" id="photo" required>
                            </div>
                            <div id="image_key">
                                <img src="{{ URL::asset('images/upload-image.png') }}" id="imgPreview" height="200px" width="200px" alt="">
                            </div>
                        </div>
                        
                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-info px-5">Register</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
         var editor = CKEDITOR.replace('description', {
            extraPlugins: 'uploadimage', // Ensure the uploadimage plugin is enabled
            filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images', // Adjust the URL path to your server
            filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?type=Images',
            filebrowserUploadMethod: 'form'
        });

        CKFinder.setupCKEditor(editor);

        $("#category_id").change(function(e) {
            e.preventDefault()
            if($(this).parsley().validate()) {
                var url = "{{ url('registration_process') }}";
                $.ajax({
                    url: url,
                    data: $('#formSubmit').serialize(),
                    type: 'post',
                    success: function(result) {
                        if (result.status == 200) {
                            alert('Succesfully submit');
                        }else{
                            console.log(result);
                            alert(result.message);
                        }
                    }
                });
            }
        });

    </script>
@endsection