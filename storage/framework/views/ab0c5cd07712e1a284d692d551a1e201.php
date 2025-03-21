
<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.datatables'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
    type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"
    type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> Tables <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?>Datatables <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <!-- <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Input Example</h4>
            </div> -->
            <form action="#" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-xxl-3 col-md-6">
                                <div id="input-container">
                                    <?php $__currentLoopData = $transaction; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="input-group mb-2">
                                        <!-- <span class="input-group-text bg-dark text-light">Sampah</span> -->
                                        <input type="text" class="form-control" placeholder="Masukkan jenis sampah"
                                            value="<?php echo e($trash->trashes); ?>" required disabled>

                                        <!-- <span class="input-group-text bg-dark text-light">Total</span> -->
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <!--end col-->
                            <!-- <div class="col-xxl-3 col-md-6">
                                <div id="input-container">
                                    <?php $__currentLoopData = $transaction; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="input-group mb-2">
                                        <select class="js-example-basic-single trash-select" name="trash_id[]"
                                            id="trash-select-<?php echo e($trash->id); ?>" data-index="<?php echo e($trash->id); ?>">
                                            <option value="" selected>Pilih Kategori</option>
                                            <?php $__currentLoopData = $trashes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($type->id); ?>" data-price="<?php echo e($type->price); ?>"
                                                data-unit="<?php echo e($type->unit); ?>">
                                                <?php echo e($type->name); ?>

                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div> -->

                            <!-- Input Harga & Satuan -->
                            <div class="col-xxl-3 col-md-6">
                                <?php $__currentLoopData = $transaction; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $trash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" id="price-<?php echo e($trash->id ?? $index); ?>"name="price[]"
                                        placeholder="Harga" value="<?php echo e($trash->trash->price); ?>" readonly>
                                    <input type="text" class="form-control" id="unit-<?php echo e($trash->id ?? $index); ?>" value="<?php echo e($trash->trash->unit); ?>" placeholder="Satuan"
                                        readonly>

                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div id="input-container">
                                    <?php $__currentLoopData = $transaction; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" placeholder="Total" required
                                            value="<?php echo e($trash->total); ?>" disabled>

                                        <!-- <input type="text" class="form-control" placeholder="Jumlah Yang Diproses"
                                            name="total[]"> -->
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div id="input-container">
                                    <?php $__currentLoopData = $transaction; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="input-group mb-2">
                                        <!-- <input type="number" class="form-control" placeholder="Total" required
                                            value="<?php echo e($trash->total); ?>" disabled> -->

                                        <input type="text" class="form-control" placeholder="Jumlah Yang Diproses"
                                            name="proces[]" value="<?php echo e(old('proces', $trash->proces)); ?>">
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="<?php echo e(URL::asset('build/js/pages/select2.init.js')); ?>"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="<?php echo e(URL::asset('build/js/pages/datatables.init.js')); ?>"></script>

<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>

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


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layouts-detached', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\bank_sampah\resources\views/bank_sampah/pages/transaction/view.blade.php ENDPATH**/ ?>