// Simple styles to get the ball rolling
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        color: #333;
        margin: 0;
        padding: 20px;
    }
    h2, h3 {
        color: #333;
    }
    .container {
        background-color: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        border-radius: 4px;
        overflow: hidden; /* Ensures the child elements adhere to the container's border radius */
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        background-color: #f9f9f9; /* Light grey to match the table header */
        border-bottom: 1px solid #ddd; /* To blend with the table's border */
    }

    .header h2 {
        margin: 0;
        display: inline-block;
    }

    .header-left {
        display: flex;
        align-items: baseline;
    }

    .header-left h2 {
        margin: 0;
        display: inline-block;
    }

    .header-left h2, .view-posts a {
        margin: 0;
        color: #333; /* Ensuring the title is visible on dark background */
        text-decoration: none; /* Optional: removes underline from links */
    }

    .view-posts {
        font-size: smaller;
        margin-left: 10px;
        display: inline-block;
    }

    .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .table-container {
        flex-grow: 1;
    }
    .btn {
        padding: 10px 15px;
        border-radius: 5px;
        display: inline-block;
        font-size: 14px;
        margin: 2px;
        cursor: pointer;
        border: none;
        outline: none;
        text-decoration: none;
        background-color: #007bff;
        color: white;
    }
    .btn-primary {
        color: #f2f2f2;
        background-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .btn-edit {
        background-color: rgb(255 193 7 / 59%);
        color: #242424;
    }
    .btn-delete {
        background-color: #dc3545;
        color: #fff;
    }
    /* Additional styles for form within table cell for alignment */
    form.delete-form {
        display: inline; /* Align form with buttons */
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-top: 0px;
    }
    th {
        background-color: #f9f9f9;
        color: #333;
        font-weight: bold;
        text-align: left;
        padding: 15px;
        border-bottom: 1px solid #ddd;
    }
    td {
        padding: 15px;
        border-bottom: 1px solid #ddd;
        color: #333; /* Dark text color for readability */
    }
    tr:hover {
        background: linear-gradient(to bottom, #f8f9fa, #ebebeb);
        color: #ffffff; /* Optional: if you want to change text color on hover */
    }
    a {
        text-decoration: none;
    }
    a:hover {
        text-decoration: none;
    }

    .btn-delete:hover, .btn-edit:hover, .btn-primary:hover {
        opacity: 0.8;
    }

</style>

<div class="container">
    <div class="table-container">
        <?= view('Modules\Blog\Views\admin\partials\status_messages'); ?>
        <div class="header">
            <div class="header-left">
                <h2>Blog Posts</h2>
                <span class="view-posts">- <a href="<?= base_url('/blog/'); ?>" target="_blank">View Posts</a></span>
            </div>
            <a href="<?= base_url('admin/blog/create'); ?>" class="btn btn-primary">Create New Post</a>
        </div>
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
                    <td><?= date("j, F, Y, g:i a", strtotime($post['created_at'])) ?></td>
                    <td>
                        <a href="/admin/blog/edit/<?= $post['id'] ?>" class="btn btn-edit">Edit</a>
                        <button type="button" onclick="confirmDelete(<?= $post['id'] ?>)" class="btn btn-delete">Delete Post</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
// My JavaScript stuff sucks =(
function confirmDelete(postId) {
    var userChoice = confirm("Do you want to delete this post and its images?");
    if (userChoice) {
        // If the user confirms, submit the form ?
        var form = document.createElement('form');
        form.action = '/admin/blog/delete/' + postId;
        form.method = 'post';

        // CSRF field ???
        var csrfField = document.createElement('input');
        csrfField.type = 'hidden';
        csrfField.name = '<?= csrf_token() ?>';
        csrfField.value = '<?= csrf_hash() ?>';
        form.appendChild(csrfField);

        // Method override field (if using RESTful routes)
        var methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);

        // Add a field to indicate the user's choice regarding associated images
        var deleteImagesField = document.createElement('input');
        deleteImagesField.type = 'hidden';
        deleteImagesField.name = 'delete_files';
        deleteImagesField.value = 'yes';
        form.appendChild(deleteImagesField);

        document.body.appendChild(form);
        form.submit();
    }
}
</script>