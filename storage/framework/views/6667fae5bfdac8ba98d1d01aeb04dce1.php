<?php if(session()->has('message')): ?>
    <div class="alert alert-<?php echo e(session()->get('alert-type')); ?> alert-dismissible fade show" role="alert"
        id="alert-message" style="border: 2px solid red;">
        <?php echo e(session()->get('message')); ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/partial/backend/flash.blade.php ENDPATH**/ ?>