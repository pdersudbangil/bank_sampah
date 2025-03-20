@extends('layouts.layouts-detached')
@section('title') @lang('translation.datatables') @endsection
@section('css')
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
    type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"
    type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Tables @endslot
@slot('title')Datatables @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <!-- @if(Auth::user()->room_id != '414')
                <div class="card-header">
                <h5 class="card-title mb-0">Basic Datatables</h5>
                <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn"
                    data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add</button>
                </div>
            @endif -->
            <div class="card-body">
                <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <!-- <th scope="col" style="width: 10px;">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                </div>
                            </th> -->
                            <!-- <th data-ordering="false">SR No.</th>
                            <th data-ordering="false">ID</th>
                            <th data-ordering="false">Purchase ID</th>
                            <th data-ordering="false">Title</th>
                            <th data-ordering="false">report</th> -->
                            <th>Nama</th>
                            <th>Ruangan</th>
                            <th>Daftar Sampah</th>
                            <th>Total</th>
                            <th>Tanggal Dihapus</th>
                            <!-- <th>Priority</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($reports as $report)
                        <tr>
                            <!-- <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                </div>
                            </th>
                            <td>01</td>
                            <td>VLZ-452</td>
                            <td>VLZ1400087402</td>
                            <td><a href="#!">Post launch reminder/ post list</a></td>
                            <td>Joseph Parker</td> -->
                            <td>{{$report->user->name}}</td>
                            <td>{{$report->room->name}}</td>
                            <td>
                                <!-- @foreach($report->trashes as $trash)
                                {{ $trash }}
                                @endforeach -->
                                {{ count($report->trashes) }} Jenis Sampah
                            </td>
                            <td>
                                <!-- @foreach($report->total as $total)
                                {{ $total }},
                                @endforeach -->
                                {{ array_sum($report->total) }} Total Sampah
                            </td>
                            <td>{{$report->deleted_at}}</td>
                            <!-- <td><img class="rounded-circle header-profile-report"
                                    src="@if (Auth::user()->avatar != null) {{ URL::asset('images/' . Auth::user()->avatar) }}@else{{ URL::asset('bank_sampah/images/account.png') }} @endif"
                                    alt="Header Avatar"></td> -->
                            <!-- <td>{{$report->created_at}}</td> -->
                            <!-- <td><span class="badge bg-danger">High</span></td> -->
                            @if(Auth::user()->role != 'user')
                                @if(Auth::user()->room_id == '217' || Auth::user()->room_id == '198')
                                <td>
                                    <a href="{{route('reports.show', $report->id)}}" class="btn btn-secondary add-btn">Detail</a>
                                    <a class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteRecordModal{{$report->id}}">Delete</a>
                                    <a class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#deletesRecordModal{{$report->id}}">Restore</a>
                                    <!-- <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                            <li><a class="dropdown-item edit-item-btn" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{$report->id}}"><i
                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item remove-item-btn" data-bs-toggle="modal"
                                                    data-bs-target="#deleteRecordModal{{$report->id}}">
                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div> -->
                                </td>
                                @endif
                            @endif
                        </tr>
                        <div class="modal fade" id="editModal{{$report->id}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-light p-3">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="close-modal"></button>
                                    </div>
                                    <form method="POST" action="{{route('reports.update', $report->id)}}"
                                        autocomplete="off" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">reportname</label>
                                                <input type="text" id="customername-field" class="form-control"
                                                    placeholder="Masukkan reportname" name="name"
                                                    value="{{ old('name', $report->name) }}" required />
                                                <div class="invalid-feedback">Masukkan reportname</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Role</label>
                                                <div class="col-lg-12">
                                                    <select class="js-example-basic-single" name="role">
                                                        <option value="{{old('name', $report->role)}}" selected>
                                                            {{$report->role}}</option>
                                                        <option value="superadmin">Super Admin</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="report">report</option>
                                                        <!-- <option value="LO">Londan</option> -->
                                                        <!-- <option value="WY">Wyoming</option> -->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success" id="add-btn">Add
                                                    Data</button>
                                                <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade zoomIn" id="deleteRecordModal{{$report->id}}" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="btn-close"></button>
                                    </div>
                                    <form action="{{ route('report.destroy', $report->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <div class="mt-2 text-center">
                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                    colors="primary:#f7b84b,secondary:#f06548"
                                                    style="width:100px;height:100px"></lord-icon>
                                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                    <h4>Are you Sure ?</h4>
                                                    <p class="text-muted mx-4 mb-0">Yakin ingin hapus data?</p>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                <button type="button" class="btn w-sm btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn w-sm btn-danger "
                                                    id="delete-record">Yes,
                                                    Delete It!</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade zoomIn" id="deletesRecordModal{{$report->id}}" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="btn-close"></button>
                                    </div>
                                    <form action="{{ route('reports.restore', $report->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <div class="mt-2 text-center">
                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                    colors="primary:#f7b84b,secondary:#f06548"
                                                    style="width:100px;height:100px"></lord-icon>
                                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                    <h4>Are you Sure ?</h4>
                                                    <p class="text-muted mx-4 mb-0">Yakin restore data?</p>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                <button type="button" class="btn w-sm btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn w-sm btn-danger "
                                                    id="delete-record">Yes,
                                                    Delete It!</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--end modal -->
                        @endforeach

                    </tbody>


                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{route('report.store')}}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Nama</label>
                        <input type="hidden" name="users" value="{{Auth::user()->id}}">
                        <input type="text" id="customername-field" class="form-control" placeholder="Masukkan Nama"
                            value="{{Auth::user()->name}}" required disabled />
                        <div class="invalid-feedback">Masukkan Nama</div>
                    </div>

                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Pilih Ruangan</label>
                        <div class="col-lg-12">
                            <select class="js-example-basic-single" name="rooms">
                                @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">
                                    {{ $room->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="invalid-feedback">Please enter a customer name.</div>
                    </div>

                    <div id="input-container">
                        <div class="input-group mb-2">
                            <input type="text" name="trashes[]" class="form-control" placeholder="Masukkan jenis sampah"
                                required>
                            <!-- <input type="number" name="total[]" class="form-control" placeholder="Total" required> -->
                            <button type="button" class="btn btn-danger remove-input">Hapus</button>
                        </div>
                    </div>

                    <button type="button" id="add-input" class="btn btn-primary">Tambah Input</button>

                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="add-btn">Add Data</button>
                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')


<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#add-input').click(function () {
            $('#input-container').append(`
                <div class="input-group mb-2">
                    <input type="text" name="trashes[]" class="form-control" placeholder="Masukkan jenis sampah" required>
                    <button type="button" class="btn btn-danger remove-input">Hapus</button>
                </div>
            `);
        });

        $(document).on('click', '.remove-input', function () {
            $(this).parent().remove();
        });
    });
</script>

@endsection