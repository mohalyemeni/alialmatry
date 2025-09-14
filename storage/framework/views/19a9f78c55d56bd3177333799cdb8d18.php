<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i> <?php echo e(__('panel.edit_video')); ?>

                </h3>
                <ul class="breadcrumb pt-3">
                    <li><a href="<?php echo e(route('admin.index')); ?>"><?php echo e(__('panel.home')); ?></a> /</li>
                    <li class="ms-1"><a href="<?php echo e(route('admin.videos.index')); ?>"><?php echo e(__('panel.manage_videos')); ?></a> /</li>
                    <li class="ms-1"><?php echo e($video->title); ?></li>
                </ul>
            </div>
            <div class="ml-auto">
                <?php if (\Entrust::ability('admin', 'create_videos')) : ?>
                    <a href="<?php echo e(route('admin.videos.create')); ?>" class="btn btn-primary">
                        <span class="icon text-white-50 d-none d-sm-inline-block">
                            <i class="fa fa-plus-square"></i>
                        </span>
                        <span class="text"><?php echo e(__('panel.add_new_content')); ?></span>
                    </a>
                <?php endif; // Entrust::ability ?>
            </div>
        </div>

        <div class="card-body">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger pt-0 pb-0 mb-3">
                    <ul class="px-2 py-3 m-0" style="list-style-type: circle">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.videos.update', $video->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <input type="hidden" name="youtube_id" id="youtube_id"
                    value="<?php echo e(old('youtube_id', $video->youtube_id)); ?>">
                <input type="hidden" name="thumbnail" id="thumbnail" value="<?php echo e(old('thumbnail', $video->thumbnail)); ?>">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="content-tab" data-bs-toggle="tab" data-bs-target="#content"
                            type="button" role="tab" aria-controls="content"
                            aria-selected="true"><?php echo e(__('panel.content')); ?></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button"
                            role="tab" aria-controls="seo" aria-selected="false"><?php echo e(__('panel.seo')); ?></button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">

                    
                    <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">

                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-2 pt-2">
                                <label for="category_id"><?php echo e(__('panel.category')); ?></label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-2">
                                <select name="category_id" id="category_id"
                                    class="form-select <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                    <option value=""><?php echo e(__('panel.select_category')); ?></option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"
                                            <?php echo e(old('category_id', $video->category_id) == $category->id ? 'selected' : ''); ?>>
                                            <?php echo e($category->title); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-2 pt-2">
                                <label for="youtube_url"><?php echo e(__('panel.youtube_url')); ?></label>
                            </div>
                            <div class="col-sm-12 col-md-7 pt-2">
                                <input type="text" id="youtube_url" class="form-control"
                                    placeholder="https://www.youtube.com/watch?v=..."
                                    value="https://www.youtube.com/watch?v=<?php echo e(old('youtube_id', $video->youtube_id)); ?>">
                                <small class="text-muted"><?php echo e(__('panel.enter_youtube_url_to_refresh_data')); ?></small>
                            </div>
                            <div class="col-sm-12 col-md-3 pt-2">
                                <button id="fetchBtn" class="btn btn-outline-primary w-100" type="button">
                                    <?php echo e(__('panel.fetch_data')); ?>

                                </button>
                            </div>
                        </div>

                        
                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-2 pt-2">
                                <label for="title"><?php echo e(__('panel.title')); ?></label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-2">
                                <input type="text" name="title" id="title"
                                    value="<?php echo e(old('title', $video->title)); ?>"
                                    class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-2 pt-2">
                                <label for="description"><?php echo e(__('panel.description')); ?></label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-2">
                                <textarea name="description" id="description" rows="8" class="form-control summernote"><?php echo e(old('description', $video->description)); ?></textarea>
                                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        
                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-2 pt-2">
                                <label><?php echo e(__('panel.preview')); ?></label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-2">
                                <div id="video_embed_container" style="max-width:100%;">
                                    
                                    <?php if(!empty($video->youtube_id)): ?>
                                        <div class="ratio ratio-16x9">
                                            <iframe src="https://www.youtube.com/embed/<?php echo e($video->youtube_id); ?>"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                        </div>
                                    <?php elseif(!empty($video->html)): ?>
                                        <?php echo $video->html; ?>

                                    <?php else: ?>
                                        <p class="text-muted"><?php echo e(__('panel.no_preview_available')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-2 pt-2">
                                <label for="published_on"><?php echo e(__('panel.publish_date')); ?></label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-2">
                                <div class="input-group flatpickr" id="flatpickr-datetime">
                                    <input type="text" name="published_on"
                                        value="<?php echo e(old('published_on', optional($video->published_on)->format('Y-m-d H:i'))); ?>"
                                        class="form-control" data-input>
                                    <span class="input-group-text input-group-addon" data-toggle><i
                                            data-feather="calendar"></i></span>
                                </div>
                                <?php $__errorArgs = ['published_on'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-2 pt-2">
                                <label class="control-label"><?php echo e(__('panel.status')); ?></label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_active"
                                        value="1" <?php echo e(old('status', $video->status) ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="status_active"><?php echo e(__('panel.active')); ?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_inactive"
                                        value="0" <?php echo e(old('status', $video->status) ? '' : 'checked'); ?>>
                                    <label class="form-check-label"
                                        for="status_inactive"><?php echo e(__('panel.inactive')); ?></label>
                                </div>
                                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-3 pt-2">
                                <label for="meta_keywords"><?php echo e(__('panel.seo_keywords')); ?></label>
                            </div>
                            <div class="col-sm-12 col-md-9 pt-2">
                                <input name="meta_keywords" id="meta_keywords"
                                    value="<?php echo e(old('meta_keywords', $video->meta_keywords)); ?>" class="form-control" />
                                <?php $__errorArgs = ['meta_keywords'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <hr>

                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-3 pt-2">
                                <label for="meta_description"><?php echo e(__('panel.seo_description')); ?></label>
                            </div>
                            <div class="col-sm-12 col-md-9 pt-2">
                                <textarea name="meta_description" id="meta_description" rows="3" class="form-control"><?php echo e(old('meta_description', $video->meta_description)); ?></textarea>
                                <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row mt-4">
                    <div class="col-sm-12 col-md-2 pt-3 d-none d-md-block"></div>
                    <div class="col-sm-12 col-md-10 pt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="icon-lg me-2" data-feather="save"></i> <?php echo e(__('panel.update')); ?>

                        </button>
                        <a href="<?php echo e(route('admin.videos.index')); ?>" class="btn btn-outline-danger">
                            <i class="icon-lg me-2" data-feather="x"></i> <?php echo e(__('panel.cancel')); ?>

                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('backend/vendors/select2/select2.min.js')); ?>"></script>


    <script>
        $(function() {
            // init summernote
            if (!$('.summernote').data('summernote')) {
                $('.summernote').summernote({
                    tabSize: 2,
                    height: 200,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]
                });
            }
            if ($('#flatpickr-datetime').length) {
                const oldDate = "<?php echo e(old('published_on')); ?>";
                const videoDate = "<?php echo e(optional($video->published_on)->format('Y-m-d H:i')); ?>";
                const defaultDate = oldDate ? oldDate : (videoDate ? videoDate : new Date());

                flatpickr("#flatpickr-datetime", {
                    enableTime: true,
                    wrap: true,
                    dateFormat: "Y-m-d H:i",
                    altInput: true,
                    altFormat: "Y/m/d h:i K",
                    locale: "ar",
                    defaultDate: defaultDate,
                });
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                }
            });


            $('#fetchBtn').on('click', function() {
                const url = $('#youtube_url').val().trim();
                if (!url) {
                    alert('أدخل رابط يوتيوب أولاً');
                    return;
                }

                const $btn = $(this);
                $btn.prop('disabled', true).text('جاري الجلب...');

                $.post("<?php echo e(route('admin.videos.fetch_data')); ?>", {
                        url: url
                    })
                    .done(function(res) {
                        if (res.success) {

                            if (res.title) {
                                $('#title').val(res.title);


                                if ($('#description').hasClass('summernote')) {
                                    $('#description').summernote('code', res.title || '');
                                } else {
                                    $('#description').val(res.title || '');
                                }
                            }
                            if (res.thumbnail) {
                                $('#thumbnail_preview').attr('src', res.thumbnail);
                                $('#thumbnail').val(res.thumbnail);
                            }
                            if (res.youtube_id) {
                                $('#youtube_id').val(res.youtube_id);
                                // تحديث الـ iframe
                                $('#video_embed_container').html(
                                    '<div class="ratio ratio-16x9"><iframe src="https://www.youtube.com/embed/' +
                                    res.youtube_id +
                                    '" frameborder="0" allowfullscreen></iframe></div>');
                            } else if (res.html) {
                                $('#video_embed_container').html(res.html);
                            }
                        } else {
                            alert(res.message || 'فشل في جلب بيانات الفيديو');
                        }
                    })
                    .fail(function() {
                        alert('فشل الاتصال بالخادم');
                    })
                    .always(function() {
                        $btn.prop('disabled', false).text('<?php echo e(__('panel.fetch_data')); ?>');
                    });
            });

            $('#youtube_id').on('input', function() {
                const id = $(this).val().trim();
                if (id) {
                    const thumb = 'https://img.youtube.com/vi/' + id + '/hqdefault.jpg';
                    $('#thumbnail_preview').attr('src', thumb);
                    $('#thumbnail').val(thumb);
                }
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new\alshaik\root\resources\views/backend/videos/edit.blade.php ENDPATH**/ ?>