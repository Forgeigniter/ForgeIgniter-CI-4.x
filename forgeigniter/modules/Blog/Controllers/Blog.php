<?php
namespace Modules\Blog\Controllers;

use Modules\Blog\Models\Blog_Model;
use CodeIgniter\Controller;

class Blog extends Controller {

    public function index() {
        $model = new Blog_Model();
        $data['blog_posts'] = $model->getPostsWithImages();

        echo view('Modules\Blog\Views\blog_posts', $data);
    }

    public function post($postId) {
        $blogModel = new Blog_Model();
        $data['post'] = $blogModel->getPostWithImages($postId);

        echo view('Modules\Blog\Views\blog_single_post', $data);
    }

}
