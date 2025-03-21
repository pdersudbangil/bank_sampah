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
            <!-- <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Input Example</h4>
            </div> -->
            <form action="#" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-xxl-3 col-md-6">
                                <div id="input-container">
                                    @foreach($transaction as $trash)
                                    <div class="input-group mb-2">
                                        <!-- <span class="input-group-text bg-dark text-light">Sampah</span> -->
                                        <input type="text" class="form-control" placeholder="Masukkan jenis sampah"
                                            value="{{ $trash->trashes }}" required disabled>

                                        <!-- <span class="input-group-text bg-dark text-light">Total</span> -->
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <!--end col-->
                            <!-- <div class="col-xxl-3 col-md-6">
                                <div id="input-container">
                                    @foreach($transaction as $trash)
                                    <div class="input-group mb-2">
                                        <select class="js-example-basic-single trash-select" name="trash_id[]"
                                            id="trash-select-{{ $trash->id }}" data-index="{{ $trash->id }}">
                                            <option value="" selected>Pilih Kategori</option>
                                            @foreach ($trashes as $type)
                                            <option value="{{ $type->id }}" data-price="{{ $type->price }}"
                                                data-unit="{{ $type->unit }}">
                                                {{ $type->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endforeach
                                </div>
                            </div> -->

                            <!-- Input Harga & Satuan -->
                            <div class="col-xxl-3 col-md-6">
                                @foreach($transaction as $index => $trash)
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" id="price-{{ $trash->id ?? $index }}"name="price[]"
                                        placeholder="Harga" value="{{$trash->trash->price}}" readonly>
                                    <input type="text" class="form-control" id="unit-{{ $trash->id ?? $index }}" value="{{$trash->trash->unit}}" placeholder="Satuan"
                                        readonly>

                                </div>
                                @endforeach
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div id="input-container">
                                    @foreach($transaction as $trash)
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" placeholder="Total" required
                                            value="{{ $trash->total }}" disabled>

                                        <!-- <input type="text" class="form-control" placeholder="Jumlah Yang Diproses"
                                            name="total[]"> -->
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div id="input-container">
                                    @foreach($transaction as $trash)
                                    <div class="input-group mb-2">
                                        <!-- <input type="number" class="form-control" placeholder="Total" required
                                            value="{{ $trash->total }}" disabled> -->

                                        <input type="text" class="form-control" placeholder="Jumlah Yang Diproses"
                                            name="proces[]" value="{{old('proces', $trash->proces)}}">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <div class="card-footer">
                    <div class="text-end">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </div>
            </form>
            <!--end row-->
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
    $(".js-example-basic-single").select2().on("select2:select", function (e) {
    let selectedOption = e.params.data.element;
    
    // Ubah index ke tipe data yang benar (hindari objek)
    let index = String($(this).data("index"));  // Pastikan hanya string atau angka
    console.log("🔥 Change Event Triggered for Index:", index);
    
    let price = $(selectedOption).data("price");
    let unit = $(selectedOption).data("unit");

    console.log("📌 Selected Price:", price);
    console.log("📌 Selected Unit:", unit);

    $("#price-" + index).val(price || "");
    $("#unit-" + index).val(unit || "");

    // Hitung total harga
    let totalQty = parseFloat($("#total-" + index).val()) || 0;
    let totalHarga = totalQty * (parseFloat(price) || 0);
    $("#total-harga-" + index).val(totalHarga);
});

</script>

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