<div class="card post">
    <div class="card-header bg-inverse text-light">

        <div id="like-wrapper-<?php echo e($post->id); ?>">
            <?php if(!$post->doesUserLike(Auth::user()) || Auth::check() && Auth::user()->hasRole('admin')): ?>
            <form id="like-post-<?php echo e($post->id); ?>-form"
                  method="POST"
                  action="<?php echo e(route('posts.like', $post)); ?>"
                  class="ajax-like"
                  data-like-wrapper="#like-wrapper-<?php echo e($post->id); ?>">
                <?php echo e(csrf_field()); ?>

                <?php echo e(method_field('PUT')); ?>

                <a href="#"
                   class="float-xs-right text-muted no-decoration"
                   onclick="event.preventDefault();$('#like-post-<?php echo e($post->id); ?>-form').trigger('submit')">
                    <?php echo e($post->getLikesCount()); ?>

                    <i class="fa fa-heart fa-fw text-primary" style="position:relative">
                        <i class="fa fa-heart fa-fw heart-hollow"></i>
                    </i>
                </a>
            </form>
            <?php else: ?>
            <span class="float-xs-right text-muted">
                <?php echo e($post->getLikesCount()); ?>

                <i class="fa fa-heart fa-fw text-primary"></i>
            </span>
            <?php endif; ?>
        </div>

        <i class="fa fa-clock-o"></i>
        <?php echo e($post->updated_at->diffForHumans()); ?> by
        <strong><a href="<?php echo e(route('models.show', $post->user)); ?>"
                   class="text-light"><?php echo e($post->user->username); ?></a></strong>
    </div>
    <div style="position:relative">
        <?php if($post->media->count() > 0): ?>
        <div style="position:relative">
            <img src="<?php echo e(Storage::url($post->media->first()->getThumbnail(policy($post)->show(Auth::user(), $post))->path)); ?>"
                 class="card-img-top img-fluid w-100">
            <?php if($post->hasVideo()): ?>
            <i class="fa fa-play-circle-o fa-5x play-icon"></i>
            <?php endif; ?>

            <?php if(!policy($post)->show(Auth::user(), $post)): ?>
            <div class="vip-sign text-light text-xs-center " >
                <div class="vip-sign--inner">
                    <span class="mb-1 h6 text-xs-center" style="display: inline">Members Only</span>
                    <a href="<?php echo e(url('/register' . (isset($registerForModel) ? '?' . http_build_query(['model' => $registerForModel]) : ''))); ?>"
                       class="btn btn-primary  btn-display float-xs-right mb-1">
                        Get Full Access
                    </a>
                    <div class="clearfix"></div>
                    <small class="text-muted mb-0" >Local Scandinavian Girls</small>
                </div>
                <?php if($post->hasVideo()): ?>
                <i class="fa fa-play-circle-o fa-4x play-icon"></i>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="card-block">
            <?php if($post->content): ?>
            <p class="card-text"><?php echo e(substr(str_replace(['<p>','</p>'],'',$post->content), 0 ,85)); ?></p>
            <?php else: ?>
            <p class="card-text"><?php echo e($post->title); ?></p>
            <?php endif; ?>

        </div>
        <a href="<?php echo e(route('posts.show', ['user' => $post->getUser(), 'post' => $post])); ?>"
           class="link-wrapper"></a>
    </div>

</div>
