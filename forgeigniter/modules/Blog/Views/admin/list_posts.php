<h2>Blog Posts</h2>
<h3><a href="<?= base_url('/blog/'); ?>" target="_blank">View Posts</a></h3>
<a href="<?= base_url('/blog/create'); ?>" class="btn btn-primary">Create New Post</a>
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($blog_posts as $post): ?>
        <tr>
            <td><?= esc($post['title']) ?></td>
            <td><?= date("j, F, Y , g:i a", strtotime($post['created_at'])) ?></td>
            <td>
                <a href="/admin/blog/edit/<?= $post['id'] ?>">Edit</a>
                <a href="/admin/blog/delete/<?= $post['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>