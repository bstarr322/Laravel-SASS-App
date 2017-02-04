<?php $__env->startSection('content'); ?>
<?php if($girlOfTheWeek->count() > 0 && $settings->get('botm_count', 5) > 0): ?>
<div class="gallery gallery--botm mb-3">
    <?php $__currentLoopData = $girlOfTheWeek->take($settings->get('botm_count', 5)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
    <div class="item media post">
        <?php if($post->media->count() > 0): ?>
        <div class="media-left">
            <img src="<?php echo e(Storage::url($post->media->first()->getImage(!$post->media->first()->protected)->path)); ?>" class="media-object img-fluid">
            <?php if($post->hasVideo()): ?>
            <i class="fa fa-play-circle-o play-icon"></i>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="media-body row align-middle text-light">
            <div class="col-xs-12 text-xs-center">
                <img src="/images/crown.png" class="crown">
                <h1 class="text-uppercase font-weight-bold">Babe of the Month</h1>
                <h3 class="media-heading text-uppercase font-weight-normal mb-0">
                    <?php echo e($post->title); ?>

                </h3>
                <p class="text-muted text-uppercase mb-0">
                    Published <?php echo e($post->created_at->format('Y-m-d')); ?>

                </p>
                <img src="/images/crown-bottom.png" class="crown-bottom">
            </div>
        </div>
        <a href="<?php echo e(route('botm.show', $post)); ?>" class="link-wrapper"></a>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
</div>
<?php endif; ?>

<div class="row grid-list post-list">
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 grid-item stamp stamp-left model-list hidden-sm-down">
        <?php $__currentLoopData = $models->take($settings->get('model_list_count', 20)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        <?php $backgroundImage = isset($model->profile->cover) ? 'style="background-image: url(' . Storage::url($model->profile->cover->path) . ')"' : '' ?>
        <div class="card card-inverse">
            <div class="card-header bg-inverse">
                <?php echo e($loop->iteration); ?>. <?php echo e($model->username); ?>

            </div>
            <div class="card-block text-xs-center text-white" <?php echo $backgroundImage; ?>>
                <div class="card-title">
                    <?php echo e($model->username); ?>

                </div>
            </div>

            <a class="link-wrapper" href="<?php echo e(route('models.show', $model)); ?>"></a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 grid-item stamp stamp-right post-list post-list--small hidden-sm-down">
        <div class="card">
            <div class="card-header bg-inverse text-light">
                <strong>Most popular</strong>
            </div>
            <div class="list-group list-group-flush">
                <?php $__currentLoopData = $popularPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <a class="list-group-item list-group-item-action"
                   href="<?php echo e(route('posts.show', ['model' => $post->user, 'post' => $post])); ?>">
                    <span class="likes float-xs-right text-muted">
                        <?php echo e($post->getLikesCount()); ?>

                        <i class="fa fa-heart fa-fw text-primary"></i>
                    </span>
                    <div class="post">
                        <strong><?php echo e($post->user->username); ?></strong> - <?php echo e($post->title); ?>

                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </div>
        </div>
    </div>
    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 grid-item hidden-sm-down">
        <?php echo $__env->make('partials.posts.grid-item', ['post' => $post], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    <div class="row hidden-md-up">
        <div class="col-xs-6 ">
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <?php if($loop->iteration%2 ==0): ?>
            <div class="n">
                <?php echo $__env->make('partials.posts.grid-item', ['post' => $post], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </div>
       <div class="col-xs-6 ">
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <?php if($loop->iteration%2 ==1): ?>
            <div class="n">
                <?php echo $__env->make('partials.posts.grid-item', ['post' => $post], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </div>
    </div>
</div>

<nav class="text-xs-center">
    <?php echo e($posts->links('vendor.pagination.bootstrap-4')); ?>

</nav>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>