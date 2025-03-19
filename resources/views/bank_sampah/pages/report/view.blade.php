@extends('layouts.layouts-detached')
@section('title')
@lang('translation.form-layouts')
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"
    type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
Forms
@endslot
@slot('title')
Form layout
@endslot
@endcomponent

<div class="row">
    <div class="col-xxl-6">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Horizontal Form</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <form action="{{route('report.update', $reports->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Data Sampah</label>
                            <div id="input-container">
                            @foreach($reports->trashes as $index => $trash)
                                <div class="input-group mb-2">
                                    <input type="text" name="trashes[]" class="form-control"
                                        placeholder="Masukkan jenis sampah" id="trash{{$index}}"
                                        value="{{ $trash ?? null }}" required>

                                    <input type="number" name="total[]" class="form-control" placeholder="Total"
                                        required id="total{{$index}}"
                                        value="{{ $reports->total[$index] ?? null }}">
                                </div>
                            @endforeach
                            </div>
                        </div>

                        <!-- <button type="button" id="add-input" class="btn btn-primary mb-2">Tambah Input</button> -->
                        <div class="mb-3">
                            <label for="customername-field" class="form-label">Jenis Sampah</label>
                            <div class="col-lg-12">
                                <select class="js-example-basic-single" name="rooms">
                                    @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}"
                                        {{ isset($room) && $room->id == $reports->rooms ? 'selected' : '' }}>
                                        {{ $room->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="invalid-feedback">Please enter a customer name.</div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-secondary mt-2">Edit Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end row-->


@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#add-input').click(function () {
            $('#input-container').append(`
                <div class="input-group mb-2">
                    <input type="text" name="trashes[]" class="form-control" placeholder="Masukkan jenis sampah" required>
                    <input type="number" name="total[]" class="form-control" placeholder="Total" required>
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