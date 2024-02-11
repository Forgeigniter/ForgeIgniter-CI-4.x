<form action="<?= site_url('/admin/blog/create'); ?>" method="post">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Enter post title">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" id="content" name="content" rows="3" placeholder="Enter post content"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create Post</button>
</form>