
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
            <div class="card-header">
                <!-- <h5 class="card-title mb-0">Basic Datatables</h5> -->
                <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn"
                    data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add</button>
            </div>
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
                            <th data-ordering="false">User</th> -->
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Satuan</th>
                            <th>Jenis Sampah</th>
                            <!-- <th>Status</th>
                            <th>Priority</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $trashes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                            <td><?php echo e($trash->name); ?></td>
                            <td><?php echo e($trash->price); ?></td>
                            <td><?php echo e($trash->unit); ?></td>
                            <td><?php echo e($trash->typeTrash->type_of_trash); ?></td>
                            <!-- <td><span class="badge bg-danger">High</span></td> -->
                            <td>
                            <a class=" btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#editModal<?php echo e($trash->id); ?>">Edit</a>
                                <a class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteRecordModal<?php echo e($trash->id); ?>">Delete</a>
                            </td>
                        </tr>
                        <div class="modal fade" id="editModal<?php echo e($trash->id); ?>" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-light p-3">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="close-modal"></button>
                                    </div>
                                    <form method="POST" action="<?php echo e(route('trash.update', $trash->id)); ?>"
                                        autocomplete="off" enctype="multipart/form-data">
                                        <?php echo method_field('PUT'); ?>
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Nama Barang</label>
                                                <input type="text" id="customername-field" class="form-control"
                                                    placeholder="Masukkan Nama Barang" name="name"
                                                    value="<?php echo e(old('name', $trash->name)); ?>" required />
                                                <div class="invalid-feedback">Masukkan Nama Barang</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Masukkan
                                                    Harga</label>
                                                <input type="text" id="customername-field" class="form-control"
                                                    placeholder="Masukkan Harga" name="price"
                                                    value="<?php echo e(old('price', $trash->price)); ?>" required />
                                                <div class="invalid-feedback">Masukkan Harga</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Satuan</label>
                                                    <select class="js-example-basic-single" name="unit">
                                                        <option value="<?php echo e(old('unit', $trash->unit)); ?>" selected><?php echo e($trash->unit); ?></option>
                                                        <option value="mg">Miligram</option>
                                                        <option value="g">Gram</option>
                                                        <option value="kg">Kilogram</option>
                                                        <!-- <option value="LO">Londan</option> -->
                                                        <!-- <option value="WY">Wyoming</option> -->
                                                    </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Jenis Sampah</label>
                                                <div class="col-lg-12">
                                                    <select class="js-example-basic-single" name="type_of_trash">
                                                    <?php $__currentLoopData = $typeTrashes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typeTrash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($typeTrash->id); ?>" 
                                                            <?php echo e(isset($trash) && $trash->type_of_trash == $typeTrash->id ? 'selected' : ''); ?>>
                                                            <?php echo e($typeTrash->type_of_trash); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="invalid-feedback">Please enter a customer name.</div>
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
                        <div class="modal fade zoomIn" id="deleteRecordModal<?php echo e($trash->id); ?>" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="btn-close"></button>
                                    </div>
                                    <form action="<?php echo e(route('trash.destroy', $trash->id)); ?>" method="post">
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
            <form method="POST" action="<?php echo e(route('trash.store')); ?>" autocomplete="off" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3" id="modal-id" style="display: none;">
                        <label for="id-field" class="form-label">ID</label>
                        <input type="text" id="id-field" class="form-control" placeholder="ID" readonly />
                    </div>

                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Nama Barang</label>
                        <input type="text" id="customername-field" class="form-control"
                            placeholder="Masukkan Nama Barang" name="name" required />
                        <div class="invalid-feedback">Masukkan Nama Barang</div>
                    </div>

                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Harga</label>
                        <input type="text" id="customername-field" class="form-control" placeholder="Masukkan Harga"
                            name="price" required />
                        <div class="invalid-feedback">Masukkan Harga</div>
                    </div>

                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Satuan</label>
                        <div class="col-lg-12">
                            <select class="js-example-basic-single" name="unit">
                                <option value="mg">Miligram</option>
                                <option value="g">Gram</option>
                                <option value="kg">Kilogram</option>
                                <!-- <option value="LO">Londan</option> -->
                                <!-- <option value="WY">Wyoming</option> -->
                            </select>
                        </div>
                        <div class="invalid-feedback">Pilih Satuan</div>
                    </div>

                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Jenis Sampah</label>
                        <div class="col-lg-12">
                            <select class="js-example-basic-single" name="type_of_trash">
                                <?php $__currentLoopData = App\Models\TypeTrash::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($x->id); ?>"><?php echo e($x->type_of_trash); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="invalid-feedback">Please enter a customer name.</div>
                    </div>
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

<!--jquery cdn-->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layouts-detached', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\bank_sampah\resources\views/bank_sampah/pages/trash/index.blade.php ENDPATH**/ ?>