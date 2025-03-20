
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
            <!-- <?php if(Auth::user()->room_id != '414'): ?>
                <div class="card-header">
                <h5 class="card-title mb-0">Basic Datatables</h5>
                <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn"
                    data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add</button>
                </div>
            <?php endif; ?> -->
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
                        <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                            <td><?php echo e($report->user->name); ?></td>
                            <td><?php echo e($report->room->name); ?></td>
                            <td>
                                <!-- <?php $__currentLoopData = $report->trashes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($trash); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
                                <?php echo e(count($report->trashes)); ?> Jenis Sampah
                            </td>
                            <td>
                                <!-- <?php $__currentLoopData = $report->total; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $total): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($total); ?>,
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
                                <?php echo e(array_sum($report->total)); ?> Total Sampah
                            </td>
                            <td><?php echo e($report->deleted_at); ?></td>
                            <!-- <td><img class="rounded-circle header-profile-report"
                                    src="<?php if(Auth::user()->avatar != null): ?> <?php echo e(URL::asset('images/' . Auth::user()->avatar)); ?><?php else: ?><?php echo e(URL::asset('bank_sampah/images/account.png')); ?> <?php endif; ?>"
                                    alt="Header Avatar"></td> -->
                            <!-- <td><?php echo e($report->created_at); ?></td> -->
                            <!-- <td><span class="badge bg-danger">High</span></td> -->
                            <?php if(Auth::user()->role != 'user'): ?>
                            <?php if(Auth::user()->room_id == '414' || Auth::user()->room_id == '434'): ?>
                            <td>
                                <a href="<?php echo e(route('reports.show', $report->id)); ?>" class="btn btn-secondary add-btn">Detail</a>
                                <a class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteRecordModal<?php echo e($report->id); ?>">Delete</a>
                                <a class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#deletesRecordModal<?php echo e($report->id); ?>">Restore</a>
                                <!-- <div class="dropdown d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                        <li><a class="dropdown-item edit-item-btn" data-bs-toggle="modal"
                                                data-bs-target="#editModal<?php echo e($report->id); ?>"><i
                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn" data-bs-toggle="modal"
                                                data-bs-target="#deleteRecordModal<?php echo e($report->id); ?>">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div> -->
                            </td>
                            <?php endif; ?>
                            <?php endif; ?>
                        </tr>
                        <div class="modal fade" id="editModal<?php echo e($report->id); ?>" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-light p-3">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="close-modal"></button>
                                    </div>
                                    <form method="POST" action="<?php echo e(route('reports.update', $report->id)); ?>"
                                        autocomplete="off" enctype="multipart/form-data">
                                        <?php echo method_field('PUT'); ?>
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">reportname</label>
                                                <input type="text" id="customername-field" class="form-control"
                                                    placeholder="Masukkan reportname" name="name"
                                                    value="<?php echo e(old('name', $report->name)); ?>" required />
                                                <div class="invalid-feedback">Masukkan reportname</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Role</label>
                                                <div class="col-lg-12">
                                                    <select class="js-example-basic-single" name="role">
                                                        <option value="<?php echo e(old('name', $report->role)); ?>" selected>
                                                            <?php echo e($report->role); ?></option>
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
                        <div class="modal fade zoomIn" id="deleteRecordModal<?php echo e($report->id); ?>" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="btn-close"></button>
                                    </div>
                                    <form action="<?php echo e(route('report.destroy', $report->id)); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
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
                        <div class="modal fade zoomIn" id="deletesRecordModal<?php echo e($report->id); ?>" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="btn-close"></button>
                                    </div>
                                    <form action="<?php echo e(route('reports.restore', $report->id)); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
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

            <form method="POST" action="<?php echo e(route('report.store')); ?>" autocomplete="off" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Nama</label>
                        <input type="hidden" name="users" value="<?php echo e(Auth::user()->id); ?>">
                        <input type="text" id="customername-field" class="form-control" placeholder="Masukkan Nama"
                            value="<?php echo e(Auth::user()->name); ?>" required disabled />
                        <div class="invalid-feedback">Masukkan Nama</div>
                    </div>

                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Pilih Ruangan</label>
                        <div class="col-lg-12">
                            <select class="js-example-basic-single" name="rooms">
                                <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($room->id); ?>">
                                    <?php echo e($room->name); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php echo $__env->make('layouts.layouts-detached', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\bank_sampah\resources\views/bank_sampah/recycle_bin/report/index.blade.php ENDPATH**/ ?>