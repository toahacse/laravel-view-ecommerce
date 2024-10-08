@extends("admin/layout/layout")
@section("content")
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Coupon</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Coupon</li>
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

            <h6 class="mb-0 text-uppercase">Coupon</h6>
            <hr/>
            <div class="col text-end">
                <button type="button" onclick="saveData('0', '', '', '', '')" class="btn btn-outline-primary px-5 mb-2"  data-bs-toggle="modal" data-bs-target="#addModal"><i class="bx bx-plus mr-1"></i>Add </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>minValue</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $list)
                                    <tr>
                                        <td>{{ $list->id }}</td>
                                        <td>{{ $list->name }}</td>
                                        <td>{{ $list->type == 1 ? 'Value' : 'Parcentage' }}</td>
                                        <td>{{ $list->value }}</td>
                                        <td>{{ $list->minValue }}</td>
                                        <td>
                                            <button type="button" onclick="saveData('{{ $list->id }}', '{{ $list->name }}', '{{ $list->type }}', '{{ $list->value }}', '{{ $list->minValue }}')" class="btn btn-outline-primary mb-2"  data-bs-toggle="modal" data-bs-target="#addModal"><i class="bx bx-pen mr-1"></i>Edit </button>
                                            <button type="button" onclick="deleteData('{{ $list->id }}', 'coupons')" class="btn btn-outline-danger mb-2" ><i class="bx bx-trash mr-1"></i>Delete </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>minValue</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Coupon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formSubmit" action="{{ url('admin/updateCoupon') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <div><i class="bx bxs-user me-1 font-22 text-info"></i>
                                    </div>
                                    {{-- <h5 class="mb-0 text-info">User Registration</h5> --}}
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="type" class="col-sm-3 col-form-label">Type</label>
                                    <div class="col-sm-9">
                                        <select name="type" class="form-control" id="type">
                                            <option value="1">Value</option>
                                            <option value="2">Parcentage</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="value" class="col-sm-3 col-form-label">Value</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="value" class="form-control" id="value" placeholder="Enter Value">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="minValue" class="col-sm-3 col-form-label">minValue</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="minValue" class="form-control" id="minValue" placeholder="Enter minValue">
                                    </div>
                                </div>

                                <input type="hidden" name="id" id="id">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <span id="submitButton">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function saveData(id, name, type, value, minValue){
            $('#id').val(id);
            $('#name').val(name);
            $('#type').val(type);
            $('#value').val(value);
            $('#minValue').val(minValue);
        }
    </script>
@endsection
