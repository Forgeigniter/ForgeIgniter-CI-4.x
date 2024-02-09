<h2>Blog Posts</h2>
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