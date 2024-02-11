<?php

namespace Modules\Blog\Models;
use CodeIgniter\Model;

class Blog_Model extends Model {
    protected $table = 'blog_posts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'content'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

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

    // Save / Update Image Data
    public function saveImage($blogPostId, $imageName, $imagePath) {
        $db = \Config\Database::connect();
        $builder = $db->table('blog_post_images');

        $data = [
            'blog_post_id' => $blogPostId,
            'image_name'   => $imageName,
            'image_path'   => $imagePath,
        ];

        // Check if an entry for this blog post already exists
        $existingImage = $builder->where('blog_post_id', $blogPostId)->get()->getRow();

        if ($existingImage) {
            // Entry exists, update
            if ($builder->where('blog_post_id', $blogPostId)->update($data)) {
                return true; // Successfully updated
            }
        } else {
            // Entry does not exist, insert
            if ($builder->insert($data)) {
                return true; // Successfully inserted
            }
        }

        // Log error or handle it as needed
        return false; // Failed to save or update
    }
}
