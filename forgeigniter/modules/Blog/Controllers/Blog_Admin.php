<?php
namespace Modules\Blog\Controllers;

use Modules\Blog\Models\Blog_Model;
use CodeIgniter\Controller;

class Blog_Admin extends Controller {

    public function index() {
        $model = new Blog_Model();
        $data['blog_posts'] = $model->getPostsWithImages();

        // Load a view
        echo view('Modules\Blog\Views\admin\list_posts', $data);
    }

    //CREATE
    public function create() {
        $model = new Blog_Model();

        // Check if the form was submitted
        if ($this->request->is('post')) {
            $postData = [
                'title' => $this->request->getPost('title'),
                'content' => $this->request->getPost('content'),
            ];
            $model->save($postData);

            // Redirect after successful creation
            return redirect()->to('/admin/blog');
        }

        // Load the view
        return view('Modules\Blog\Views\admin\create_post');
    }

    //EDIT
    public function edit($postId = null) {
        $model = new Blog_Model();

        // Check if the form was submitted
        if ($this->request->is('post')) {
            $updatedData = [
                'title' => $this->request->getPost('title'),
                'content' => $this->request->getPost('content'),
            ];
            $model->update($postId, $updatedData);

            // Redirect after successful update
            return redirect()->to('/admin/blog');
        }

        // Fetch the existing post data
        $data['post'] = $model->find($postId);

        // Load the view
        return view('Modules\Blog\Views\admin\edit_post', $data);
    }

    //DELETE

}