<!DOCTYPE html>
<html>
<head>
    <title>Blog | <?= esc($post['title']) ?></title>
</head>
<body>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
        color: #333;
        line-height: 1.6;
    }

    .wrapper {
        display: flex;
        justify-content: space-between;
        padding: 20px;
    }

    .container {
        flex: 1;
        margin-right: 20px;
    }

    .sidebar {
        width: 300px; /* Adjust as needed */
        background-color: #f4f4f4;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }

    .post {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .post h1 {
        color: #333;
    }

    .post-content {
        margin: 20px 0;
    }

    .post-images {
        display: flex;
        flex-wrap: wrap;
        gap: 10px; /* Adjust the space between images */
    }

    .post-img {
        max-width: 100%; /* Full width of container */
        height: auto;
        border-radius: 5px;
    }

    /* Sidebar Styles */
    .sidebar ul {
        list-style-type: none;
        padding: 0;
    }

    .sidebar ul li {
        margin-bottom: 10px;
    }

    .sidebar ul li a {
        text-decoration: none;
        color: #333;
        padding: 5px 10px;
        border: 1px solid transparent;
        border-radius: 4px;
        transition: all 0.3s cubic-bezier(0.25, 0.1, 1, 0.56);
    }

    .sidebar ul li a:hover,
    .sidebar ul li a:focus {
        color: #fff;
        background-color: #525252;
        border-color: #202020;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            width: 95%;
        }
    }
</style>

<div class="wrapper">
    <main class="container">
        <!-- Single post content -->
        <?php if (!empty($post)): ?>
            <div class="post">
                <h1><?= esc($post['title']) ?></h1>
                <div class="post-content">
                    <?= esc($post['content']) ?>
                </div>
                <?php if (!empty($images)): ?>
                    <div class="post-images">
                        <?php foreach ($images as $image): ?>
                            <img src="<?= esc(base_url('/' . $image['image_path'])) ?>" alt="<?= esc($image['image_name']) ?>" class="post-img">
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p>Post not found.</p>
        <?php endif; ?>
    </main>
    <aside class="sidebar">
        <!-- Sidebar content -->
        <h3>Sidebar Title</h3>
        <ul>
            <li><a href="#">Link 1</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
        </ul>
    </aside>
</div>
</body>
</html>