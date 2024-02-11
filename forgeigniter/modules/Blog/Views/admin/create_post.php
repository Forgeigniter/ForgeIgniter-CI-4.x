<form action="<?= site_url('/admin/blog/create'); ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?> <!-- CSRF protection -->
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= old('title') ?>" placeholder="Enter post title" required>
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" id="content" name="content" rows="5" placeholder="Enter post content" required><?= old('content') ?></textarea>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control-file" name="image" id="image" required>
    </div>
    <button type="submit" class="btn btn-primary">Create Post</button>
</form>
