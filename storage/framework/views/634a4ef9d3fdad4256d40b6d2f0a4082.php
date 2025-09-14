<?php if (app('laratrust')->hasPermission('product&service edit')) : ?>
    <div class="action-btn bg-warning ms-2">
        <a class="mx-3 btn btn-sm  align-items-center" href="<?php echo e(route('product-service.show', $productService->id)); ?>"
            data-size="md" data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>">
            <i class="ti ti-eye text-white"></i>
        </a>
    </div>
<?php endif; // app('laratrust')->permission ?>
<?php if (app('laratrust')->hasPermission('product&service edit')) : ?>
    <div class="action-btn bg-info ms-2">
        <a href="<?php echo e(route('product-service.edit', $productService->id)); ?>"
            class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>">
            <span class="text-white"> <i class="ti ti-pencil"></i></span></a>
    </div>
<?php endif; // app('laratrust')->permission ?>
<?php if (app('laratrust')->hasPermission('product&service delete')) : ?>
    <div class="action-btn bg-danger ms-2">
        <?php echo Form::open([
            'method' => 'DELETE',
            'route' => ['product-service.destroy', $productService->id],
            'id' => 'delete-form-' . $productService->id,
        ]); ?>

        <a class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm" data-bs-toggle="tooltip"
            title="<?php echo e(__('Delete')); ?>"
            data-text="<?php echo e(__('Are you sure you want to proceed? This action cannot be undone, and it will delete all associated data.')); ?>"><i
                class="ti ti-trash text-white text-white"></i></a>
        <?php echo Form::close(); ?>

    </div>
<?php endif; // app('laratrust')->permission ?>
<?php /**PATH C:\Users\Espacegamers\Documents\lumex\packages\workdo\ProductService\src\Providers/../Resources/views/action.blade.php ENDPATH**/ ?>