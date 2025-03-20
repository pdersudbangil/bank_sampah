
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
            <?php if(Auth::user()->room_id != '414'): ?>
            <div class="card-header">
                <!-- <h5 class="card-title mb-0">Basic Datatables</h5> -->
                <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn"
                    data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add</button>
            </div>
            <?php endif; ?>
            <div class="card-body">
                <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Sampah</th>
                            <th>Total</th>
                            <th>Pelapor</th>
                            <th>Ruangan</th>
                            <!-- <th>Created At</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>

                            <!-- Ambil data dari relasi ke report -->
                            <td>
                                <?php if($transaction->report): ?>
                                <?php $__currentLoopData = json_decode($transaction->report->trashes, true) ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($trash); ?><br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                -
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if($transaction->report): ?>
                                <?php $__currentLoopData = json_decode($transaction->report->total, true) ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $total): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($total); ?><br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                -
                                <?php endif; ?>
                            </td>

                            <td><?php echo e($transaction->report->user->name ?? '-'); ?></td>
                            <td><?php echo e($transaction->report->room->name ?? '-'); ?></td>
                            <!-- <td><?php echo e($transaction->report ? \Carbon\Carbon::parse($transaction->report->created_at)->format('d M Y H:i') : '-'); ?>

                            </td> -->
                            <td>
                                <a href="<?php echo e(route('transaction.show', $transaction->id)); ?>" class="btn btn-secondary add-btn">Detail</a>
                                <a class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteRecordModal<?php echo e($transaction->id); ?>">Delete</a>
                                <!-- <a class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#prosesModal<?php echo e($transaction->id); ?>">Proses</a> -->
                            </td>
                        </tr>
                        <div class="modal fade" id="editModal<?php echo e($transaction->id); ?>" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-light p-3">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="close-modal"></button>
                                    </div>
                                    <form method="POST" action="<?php echo e(route('transaction.update', $transaction->id)); ?>"
                                        autocomplete="off" enctype="multipart/form-data">
                                        <?php echo method_field('PUT'); ?>
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="customername-field"
                                                    class="form-label">transactionname</label>
                                                <input type="text" id="customername-field" class="form-control"
                                                    placeholder="Masukkan transactionname" name="name"
                                                    value="<?php echo e(old('name', $transaction->name)); ?>" required />
                                                <div class="invalid-feedback">Masukkan transactionname</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Role</label>
                                                <div class="col-lg-12">
                                                    <select class="js-example-basic-single" name="role">
                                                        <option value="<?php echo e(old('name', $transaction->role)); ?>" selected>
                                                            <?php echo e($transaction->role); ?></option>
                                                        <option value="superadmin">Super Admin</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="transaction">transaction</option>
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
                        <div class="modal fade zoomIn" id="deleteRecordModal<?php echo e($transaction->id); ?>" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="btn-close"></button>
                                    </div>
                                    <form action="<?php echo e(route('transaction.destroy', $transaction->id)); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <div class="modal-body">
                                            <div class="mt-2 text-center">
                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                    colors="primary:#f7b84b,secondary:#f06548"
                                                    style="width:100px;height:100px"></lord-icon>
                                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                    <h4>Are you Sure ?</h4>
                                                    <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this
                                                        Record ?</p>
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
                        <div class="modal fade zoomIn" id="prosesModal<?php echo e($transaction->id); ?>" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="btn-close"></button>
                                    </div>
                                    <form action="<?php echo e(route('transaction.store', $transaction->id)); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-body">
                                            <div class="mt-2 text-center">
                                                <img src="<?php echo e(asset('/bank_sampah/images/process.svg')); ?>" trigger="loop"
                                                    colors="primary:#f7b84b,secondary:#f06548"
                                                    style="width:100px;height:100px">
                                                <input type="hidden" name="transactions" value="<?php echo e($transaction->id); ?>">
                                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                    <h4>Anda yakin ?</h4>
                                                    <p class="text-muted mx-4 mb-0">Dengan klik tombol proses, anda akan
                                                        mengolah sampah!</p>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                <button type="button" class="btn w-sm btn-light"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn w-sm btn-primary "
                                                    id="delete-record">Iya, Setuju</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
            <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('transaction.store')); ?>" autocomplete="off"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Nama</label>
                        <input type="hidden" name="users" value="<?php echo e(Auth::user()->id); ?>">
                        <input type="text" id="customername-field" class="form-control" placeholder="Masukkan Nama"
                            value="<?php echo e(Auth::user()->name); ?>" required disabled />
                        <div class="invalid-feedback">Masukkan Nama</div>
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
<?php echo $__env->make('layouts.layouts-detached', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\bank_sampah\resources\views/bank_sampah/pages/transaction/index.blade.php ENDPATH**/ ?>