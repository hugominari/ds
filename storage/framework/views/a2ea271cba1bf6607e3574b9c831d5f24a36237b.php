<!-- Social icons -->
<div class="pt-3 bg-blue-dark border-top border-warning font-20">
    <?php if(!empty($socials)): ?>
        <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($social->url); ?>" target="_blank">
                <i class="fab fa-<?php echo e($social->icon); ?> font-24 mr-3"></i>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<!-- Social icons -->

<!--Copyright-->
<div class="footer-copyright pb-3 bg-blue-dark py-3">
    © 2018 <a href="javascript:;" class="gibson-bold color-yellow-dark ml-3" target="_blank"> SINDIRECEITA DF</a>
</div>
<!--/.Copyright-->