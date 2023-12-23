<?php

namespace Modules\Blog\Models;
use CodeIgniter\Model;

class Blog_Model extends Model {
    protected $table = 'blog_posts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'content'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';

    // Grab All Posts with Images
    public function getPostsWithImages() {
        $this->select('blog_posts.*, blog_post_images.image_name, blog_post_images.image_path');
        $this->join('blog_post_images', 'blog_post_images.blog_post_id = blog_posts.id', 'left');
        return $this->findAll();
    }

    // Grab Single Post with Images
    public function getPostWithImages($postId) {
        $this->select('blog_posts.*, blog_post_images.image_name, blog_post_images.image_path');
        $this->join('blog_post_images', 'blog_post_images.blog_post_id = blog_posts.id', 'left');
        return $this->where('blog_posts.id', $postId)->first();
    }
}
