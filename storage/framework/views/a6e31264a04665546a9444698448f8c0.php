<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Items')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Items')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <?php echo $__env->make('layouts.includes.datatable-css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-action'); ?>
    <?php if (app('laratrust')->hasPermission('product&service create')) : ?>
        <div>
            <?php echo $__env->yieldPushContent('addButtonHook'); ?>
            <?php if (app('laratrust')->hasPermission('product&service import')) : ?>
                <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true"
                    data-title="<?php echo e(__('Product & Service Import')); ?>" data-url="<?php echo e(route('product-service.file.import')); ?>"
                    data-toggle="tooltip" title="<?php echo e(__('Import')); ?>"><i class="ti ti-file-import"></i>
                </a>
            <?php endif; // app('laratrust')->permission ?>
            <a href="<?php echo e(route('product-service.grid')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                data-title="<?php echo e(__('Grid View')); ?>" title="<?php echo e(__('Grid View')); ?>"><i
                    class="ti ti-layout-grid text-white"></i></a>

            <a href="<?php echo e(route('category.index')); ?>"data-size="md" class="btn btn-sm btn-primary"
                data-bs-toggle="tooltip"data-title="<?php echo e(__('Setup')); ?>" title="<?php echo e(__('Setup')); ?>"><i
                    class="ti ti-settings"></i></a>

            <a href="<?php echo e(route('productstock.index')); ?>"data-size="md" class="btn btn-sm btn-primary"
                data-bs-toggle="tooltip"data-title="<?php echo e(__(' Product Stock')); ?>" title="<?php echo e(__('Product Stock')); ?>"><i
                    class="ti ti-shopping-cart"></i></a>

            <a href="<?php echo e(route('product-service.create')); ?>" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip"
                data-bs-placement="top" data-title="<?php echo e(__('Create New Product')); ?>" title="<?php echo e(__('Create')); ?>"><i
                    class="ti ti-plus text-white"></i></a>

        </div>
    <?php endif; // app('laratrust')->permission ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class=" multi-collapse mt-2" id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-6">
                                <div class="row">

                                    <div class="col-xl-6 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('item_type', __('Item'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::select('item_type', $product_type, isset($_GET['item_type']) ? $_GET['item_type'] : '', ['class' => 'form-control ', 'placeholder' => 'Select Item Type'])); ?>

                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('category', __('Category'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::select('category', $category, isset($_GET['category']) ? $_GET['category'] : '', ['class' => 'form-control ', 'placeholder' => 'Select Category'])); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto mt-4">
                                <div class="row">
                                    <div class="col-auto">
                                        <a class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                            title="<?php echo e(__('Apply')); ?>" id="applyfilter"
                                            data-original-title="<?php echo e(__('apply')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                                        <a href="#!" class="btn btn-sm btn-danger " data-bs-toggle="tooltip"
                                            title="<?php echo e(__('Reset')); ?>" id="clearfilter"
                                            data-original-title="<?php echo e(__('Reset')); ?>">
                                            <span class="btn-inner--icon"><i
                                                    class="ti ti-trash-off text-white-off "></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <h5></h5>
                    <div class="table-responsive">
                        <?php echo e($dataTable->table(['width' => '100%'])); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('layouts.includes.datatable-js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo e($dataTable->scripts()); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Espacegamers\Documents\lumex\packages\workdo\ProductService\src\Providers/../Resources/views/index.blade.php ENDPATH**/ ?>