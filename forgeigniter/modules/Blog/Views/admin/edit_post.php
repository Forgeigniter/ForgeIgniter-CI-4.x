<h2>Edit Post</h2>
<form action="<?= site_url('admin/blog/edit/' . $post['id']) ?>" method="post">
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?= esc($post['title']) ?>">
        <br>
        <label for="content">Content</label>
        <textarea name="content" id="content"><?= esc($post['content']) ?></textarea>
        <br>
    </div>
    <!-- Add other fields as necessary -->
    <div>
        <button type="submit">Update Post</button>
    </div>
</form>