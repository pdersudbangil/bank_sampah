
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('translation.form-layouts'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"
    type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?>
Forms
<?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?>
Form layout
<?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<div class="row">
    <div class="col-xxl-6">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Horizontal Form</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="live-preview">
                    <form action="<?php echo e(route('report.update', $reports->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="mb-3">
                            <label class="form-label">Data Sampah</label>
                            <div id="input-container">
                            <?php $__currentLoopData = $reports->trashes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $trash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="input-group mb-2">
                                    <input type="text" name="trashes[]" class="form-control"
                                        placeholder="Masukkan jenis sampah" id="trash<?php echo e($index); ?>"
                                        value="<?php echo e($trash ?? null); ?>" required>

                                    <input type="number" name="total[]" class="form-control" placeholder="Total"
                                        required id="total<?php echo e($index); ?>"
                                        value="<?php echo e($reports->total[$index] ?? null); ?>">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <!-- <button type="button" id="add-input" class="btn btn-primary mb-2">Tambah Input</button> -->
                        <div class="mb-3">
                            <label for="customername-field" class="form-label">Jenis Sampah</label>
                            <div class="col-lg-12">
                                <select class="js-example-basic-single" name="rooms">
                                    <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($room->id); ?>"
                                        <?php echo e(isset($room) && $room->id == $reports->rooms ? 'selected' : ''); ?>>
                                        <?php echo e($room->name); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="<?php echo e(URL::asset('build/js/pages/select2.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layouts-detached', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\bank_sampah\resources\views/bank_sampah/pages/report/view.blade.php ENDPATH**/ ?>