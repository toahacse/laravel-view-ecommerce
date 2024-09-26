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

                        <form id="formSubmit" action="{{ url('admin/updateProduct') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ $id }}">
                            <div id="remove_image_div">
                                <input type="hidden" name="remove_image_id[]" value="0">
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-sm-3 col-form-label">Select Brand</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="brand_id" id="brand_id">
                                        <option value="0">Select Brand</option>
                                        @foreach($brands as $brand)
                                        <option value="{{$brand->id}}" {{ $brand->id == $data->brand_id ? 'selected' : '' }}>{{$brand->text}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-sm-3 col-form-label">Select Category</label>
                                <div class="col-sm-9">
                                    <select class="form-control"  name="category_id" id="category_id">
                                        <option value="0">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{ $category->id == $data->category_id ? 'selected' : '' }}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="attribute_id" class="col-sm-3 col-form-label">Attribute</label>
                                <div class="col-sm-9">
                                <span id="multiAttr">
                                    {{-- @foreach($data->attributes as $attribute)
                                        @dd($data->attributes);
                                    @endforeach --}}
                                    @if(isset($data->attributes[0]->id))
                                        <select class="form-control"  name="attribute_id[]" id="attribute_id" multiple>
                                            @foreach($data->attributes as $attribute)
                                                <option value="{{ $attribute->attribute_value?->id }}" selected>{{ $attribute->attribute_value?->singleAttribute?->name }} ({{ $attribute->attribute_value?->value }})</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </span>
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
                                        <option value="{{$tax->id}}" {{ $tax->id == $data->tax_id ? 'selected' : '' }}>{{$tax->text}}</option>
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
                                    <input type="file" name="image" class="form-control" id="photo" @if(!$data->image) required @endif>
                                    <div id="image_key" class="d-flex justify-content-center align-items-center mt-2">
                                        <img @if($data->image) src="{{ URL::asset($data->image)}}" @else src="{{ URL::asset('images/upload-image.png') }}" @endif id="imgPreview" height="200px" width="200px" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="image" class="col-sm-3 col-form-label">Product Attribute</label>
                                
                                <div class="row col-sm-9">
                                    <div class="col-sm-3 mt-2">
                                        <button type="button" id="addAttributeButton" class="btn btn-info form-control">Add Attribute</button>
                                    </div>

                                    @php
                                        $count = 1;
                                        $imageCount=rand(111, 999);
                                    @endphp
                                    <div class="row" id="addAttr">
                                        @if(isset($data->productAttributes[0]->id))
                                            @foreach($data->productAttributes as $productAttribute)
                                                <input type="hidden" name="productAttributeId[]" value="{{ $productAttribute->id }}">
                                                <div class="row" id="addAttr_{{ $count }}">
                                                    <div class="col-sm-3 mt-2">
                                                        <select class="form-control" name="color_id[]" id="color_id">
                                                            <option value="0">Select Color</option>
                                                            @foreach($colors as $color)
                                                            <option style="background-color:{{ $color->value }}" value="{{$color->id}}" {{ $color->id == $productAttribute->color_id ? 'selected' : '' }}>{{$color->text}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3 mt-2">
                                                        <select class="form-control" name="size_id[]" id="size_id">
                                                            <option value="0">Select Size</option>
                                                            @foreach($sizes as $size)
                                                            <option value="{{$size->id}}" {{ $size->id == $productAttribute->size_id ? 'selected' : '' }}>{{$size->text}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3 mt-2">
                                                        <input type="text" name="sku[]" value="{{ $productAttribute->sku }}" class="form-control" id="sku" required placeholder="Enter SKU">
                                                    </div>
                                                    <div class="col-sm-3 mt-2">
                                                        <input type="text" name="mrp[]" value="{{ $productAttribute->mrp }}" class="form-control" id="mrp" required placeholder="Enter MRP">
                                                    </div>
                                                    <div class="col-sm-3 mt-2">
                                                        <input type="text" name="price[]" value="{{ $productAttribute->price }}" class="form-control" id="price" required placeholder="Enter Price">
                                                    </div>
                                                    <div class="col-sm-3 mt-2">
                                                        <input type="text" name="length[]" value="{{ $productAttribute->length }}" class="form-control" id="length" required placeholder="Enter Length">
                                                    </div>
                                                    <div class="col-sm-3 mt-2">
                                                        <input type="text" name="breadth[]" value="{{ $productAttribute->breadth }}" class="form-control" id="breadth" required placeholder="Enter Breadth">
                                                    </div>
                                                    <div class="col-sm-3 mt-2">
                                                        <input type="text" name="height[]" value="{{ $productAttribute->height }}" class="form-control" id="height" required placeholder="Enter Height">
                                                    </div>
                                                    <div class="col-sm-3 mt-2">
                                                        <input type="text" name="weight[]" value="{{ $productAttribute->weight }}" class="form-control" id="weight" required placeholder="Enter Weight">
                                                    </div>
                                                    <div class="row mb-3 mt-3 m-0 p-0">
                                                        <label for="image" class="col-sm-3 col-form-label">Product Image</label>
                                                        
                                                        <div class="row col-sm-9">
                                                            <input type="hidden" name="imageValue[]" value="{{ $count }}">
                                                            <div class="col-sm-3">
                                                                <button type="button" onclick="addAttrImage('attrImage_{{ $count }}', {{ $count }})" class="btn btn-info form-control">Add Image</button>
                                                            </div>
                                                            <div id="attrImage_{{ $count }}">
                                                                @foreach($productAttribute->images as $productImg)
                                                                    <div class="row" id="attrImage_{{ $imageCount }}">
                                                                        <div class="col-sm-9">
                                                                            <input type="hidden" name="attr_image_id_{{ $count }}[]" id="attr_image_id_{{ $imageCount }}" value="{{ $productImg->id }}">

                                                                            <input type="file" name="attr_image_{{ $count }}[]" onchange="removeAttrImgId('attr_image_id_{{ $imageCount }}')" class="form-control" id="photo" @if(!$productImg->image) required @endif>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <img @if($productImg->image) src="{{ URL::asset($productImg->image)}}" @else src="{{ URL::asset('images/upload-image.png') }}" @endif id="imgPreview" height="50px" width="50px" alt="">
                                                                        </div>
                                                                        @if($count!=1)
                                                                            <button type="button" onclick="removeAttr('attrImage_{{ $imageCount }}', 'image', {{ $productImg->id }})" class="btn btn-danger form-control">Remove</button>
                                                                        @endif
                                                                    </div>
                                                                    @php $imageCount++ @endphp
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if($count!=1)
                                                        <button type="button" onclick="removeAttr('addAttr_{{ $count }}')" class="btn btn-danger form-control">Remove Attribute</button>
                                                    @endif
                                                </div>
                                                @php $count++ @endphp
                                                @php $imageCount++ @endphp
                                            @endforeach
                                        @else
                                            <input type="hidden" name="productAttributeId[]" value="0">
                                            <div class="row" id="addAttr_{{ $count }}">
                                                <div class="col-sm-3 mt-2">
                                                    <select class="form-control" name="color_id[]" id="color_id">
                                                        <option value="0">Select Color</option>
                                                        @foreach($colors as $color)
                                                        <option style="background-color:{{ $color->value }}" value="{{$color->id}}">{{$color->text}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-3 mt-2">
                                                    <select class="form-control" name="size_id[]" id="size_id">
                                                        <option value="0">Select Size</option>
                                                        @foreach($sizes as $size)
                                                        <option value="{{$size->id}}">{{$size->text}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-3 mt-2">
                                                    <input type="text" name="sku[]" class="form-control" id="sku" required placeholder="Enter SKU">
                                                </div>
                                                <div class="col-sm-3 mt-2">
                                                    <input type="text" name="mrp[]" class="form-control" id="mrp" required placeholder="Enter MRP">
                                                </div>
                                                <div class="col-sm-3 mt-2">
                                                    <input type="text" name="price[]" class="form-control" id="price" required placeholder="Enter Price">
                                                </div>
                                                <div class="col-sm-3 mt-2">
                                                    <input type="text" name="length[]" class="form-control" id="length" required placeholder="Enter Length">
                                                </div>
                                                <div class="col-sm-3 mt-2">
                                                    <input type="text" name="breadth[]" class="form-control" id="breadth" required placeholder="Enter Breadth">
                                                </div>
                                                <div class="col-sm-3 mt-2">
                                                    <input type="text" name="height[]" class="form-control" id="height" required placeholder="Enter Height">
                                                </div>
                                                <div class="col-sm-3 mt-2">
                                                    <input type="text" name="weight[]" class="form-control" id="weight" required placeholder="Enter Weight">
                                                </div>
                                                <div class="row mb-3 mt-3 m-0 p-0">
                                                    <label for="image" class="col-sm-3 col-form-label">Product Image</label>
                                                    
                                                    <div class="row col-sm-9">
                                                        <input type="hidden" name="imageValue[]" value="{{ $count }}">
                                                        <div class="col-sm-3">
                                                            <button type="button" onclick="addAttrImage('attrImage_{{ $count }}', {{ $count }})" class="btn btn-info form-control">Add Image</button>
                                                        </div>
                                                        <div id="attrImage_{{ $count }}">
                                                            <div id="attrImage_{{ $imageCount }}">
                                                                <div class="col-sm-3">
                                                                    <input type="hidden" name="attr_image_id_{{ $count }}[]" value="0">
                                                                    <input type="file" name="attr_image_{{ $count }}[]" class="form-control" id="photo" required>
                                                                </div>
                                                                @if($count!=1)
                                                                    <button type="button" onclick="removeAttr('attrImage_{{ $imageCount }}')" class="btn btn-danger form-control">Remove</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($count!=1)
                                                    <button type="button" onclick="removeAttr('addAttr_{{ $count }}')" class="btn btn-danger form-control">Remove Attribute</button>
                                                @endif
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>  
                            
                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <span id="submitButton">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        var imageCount = 1999;
        function addAttrImage(id, count){
            imageCount++;
            let html = `<div id="attrImage_${ imageCount }">
                            <div class="col-sm-3">
                                    <input type="file" name="attr_image_${count}[]" class="form-control" id="photo" required>
                                </div>
                                <button type="button" onclick="removeAttr('attrImage_${ imageCount }')" class="btn btn-danger form-control">Remove</button>
                            </div>`;

            // let html = `<input type="file" name="attr_image[]" class="form-control" id="photo" required>`;
            $('#'+id+'').append(html);       
        }
    </script>
    <script>
        function removeAttr(id, type='', imgId=''){
            $('#'+id+'').remove();

            console.log(type);
            
            if(type == 'image'){
                console.log(type, 'test');
                $('#remove_image_div').append(`<input type="hidden" name="remove_image_id[]" value="${imgId}">`)
            }
        }

        function removeAttrImgId(id){
            $('#'+id+'').remove()
        }
    </script>
  
    <script>
        var count = 111;
       $('#addAttributeButton').click(function(e){
        count++;
        imageCount++;
        let html = '';
        let sizeData = $('#size_id').html();
        let colorData = $('#color_id').html();
        
        html += `<div class="row" id="addAttr_${ count }">`;
        html += `<input type="hidden" name="productAttributeId[]" value="0">`;
        html += '<div class="col-sm-3 mt-2"><select class="form-control" name="color_id[]">'+colorData+'</select></div>';
        html += '<div class="col-sm-3 mt-2"><select class="form-control" name="size_id[]">'+sizeData+'</select></div>';
        html += `<div class="col-sm-3 mt-2">
                    <input type="text" name="sku[]" class="form-control" id="sku" required placeholder="Enter SKU">
                </div>
                <div class="col-sm-3 mt-2">
                    <input type="text" name="mrp[]" class="form-control" id="mrp" required placeholder="Enter MRP">
                </div>
                <div class="col-sm-3 mt-2">
                    <input type="text" name="price[]" class="form-control" id="price" required placeholder="Enter Price">
                </div>
                <div class="col-sm-3 mt-2">
                    <input type="text" name="length[]" class="form-control" id="length" required placeholder="Enter Length">
                </div>
                <div class="col-sm-3 mt-2">
                    <input type="text" name="breadth[]" class="form-control" id="breadth" required placeholder="Enter Breadth">
                </div>
                <div class="col-sm-3 mt-2">
                    <input type="text" name="height[]" class="form-control" id="height" required placeholder="Enter Height">
                </div>
                <div class="col-sm-3 mt-2">
                    <input type="text" name="weight[]" class="form-control" id="weight" required placeholder="Enter Weight">
                </div>
                <div class="row mb-3 mt-3 m-0 p-0">
                    <label for="image" class="col-sm-3 col-form-label">Product Image</label>
                    
                    <div class="row col-sm-9">
                        <input type="hidden" name="imageValue[]" value="${ count }">
                        <div class="col-sm-3">
                            <button type="button" onclick="addAttrImage('attrImage_${ count }', ${ count })" class="btn btn-info form-control">Add Image</button>
                        </div>
                        <div id="attrImage_${ count }">
                            <div id="attrImage_${ imageCount }">
                                <div class="col-sm-3">
                                    <input type="hidden" name="attr_image_id_${ count }[]" value="0">
                                    <input type="file" name="attr_image_${ count }[]" class="form-control" id="photo" required>
                                </div>
                                <button type="button" onclick="removeAttr('attrImage_${ imageCount }')" class="btn btn-danger form-control">Remove</button>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" onclick="removeAttr('addAttr_${ count }')" class="btn btn-danger form-control">Remove Attribute</button>
                `;
        html += `</div>`;
        
        $('#addAttr').append(html);
        
       }); 
    </script>
    <script>
        $("#category_id").change(function(e) {
            const category_id = $("#category_id").val();
            var url = "{{ url('admin/getAttributes') }}";
            var html = '';
            $.ajax({
                url: url,
                headers:{
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'category_id' : category_id
                },
                type: 'post',
                success: function(result) {
                    if(result.status == 'success'){
                        html += ' <select class="form-control"  name="attribute_id[]" id="attribute_id" multiple>'
                        jQuery.each(result.data, function(key, val){
                            jQuery.each(val.values, function(attrKey, attrVal){
                                html +='<option value="'+attrVal.id+'">'+val.attribute.name+'('+attrVal.value+')</option>';
                            });
                        });
                        html += '</select>'
 
                        $('#multiAttr').html(html);
                        $('#attribute_id').multiSelect();
                        // showAlert(result.status, result.message)
                    }else{
                        showAlert(result.status, result.message)
                    }
                },
                error: function(result){
                    showAlert(result.responseJSON.status, result.responseJSON.message)
                }
            });
        });
    </script>
    
    <script>
        var editor = CKEDITOR.replace('description');
        CKFinder.setupCKEditor(editor);
    </script>
@endsection