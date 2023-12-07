<!DOCTYPE html>
<html>
<head>
    <title>Blog Posts</title>
</head>
<body>

<style>
/* Responsive Stuff ? */
@media (max-width: 992px) {
    .wrapper {
        flex-direction: column;
    }

    .container, .sidebar {
        width: 100%;
        margin-right: 0;
    }
}

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
    width: 300px;
    background-color: #f4f4f4;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

.post {
    display: flex;
    align-items: flex-start;
    background: #fff;
    margin-bottom: 20px;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}
.post:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.post-img {
    width: 100px;
    height: auto;
    margin-right: 20px;
    border-radius: 5px;
}

.post-content {
    flex: 1; /* Takes up the remaining space */
}

.post h2 {
    margin-top: 0;
    color: #333;
}

.post p {
    margin: 10px 0;
}

.post:not(:last-child) {
    border-bottom: 1px solid #eee;
}

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

</style>

<div class="wrapper">
    <main class="container">
        <h1>Blog Posts</h1>

        <?php foreach ($blog_posts as $post): ?>

        <div class="post">
            <?php if (!empty($post['image_path'])): ?>
                <img src="<?= esc(base_url($post['image_path'].$post['image_name'])) ?>" alt="<?= esc($post['image_name'] ?? 'Post Image') ?>" class="post-img">
            <?php endif; ?>
            <div class="post-content">
                <h2><?= esc($post['title']) ?></h2>
                <p><?= esc($post['content']) ?></p>
            </div>
        </div>

        <?php endforeach; ?>
    </main>
    <aside class="sidebar">
        <h3>Sidebar Stuff</h3>
        <ul>
            <li><a href="#">Link 1</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
        </ul>
        <h3>Sidebar Stuff</h3>
        <ul>
            <li><a href="#">Link 1</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
        </ul>
    </aside>
</div>
</body>
</html>
