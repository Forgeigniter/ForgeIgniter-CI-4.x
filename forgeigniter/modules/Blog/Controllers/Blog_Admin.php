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
        helper(['form', 'url']);
        $model = new Blog_Model();

        if ($this->request->is('post')) { // More explicit check for POST request
            // Validation Rules
            $rules = [
                'title' => 'required|min_length[3]|max_length[255]',
                'content' => 'required',
                'image' => 'uploaded[image]|max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]',
            ];

            if (!$this->validate($rules)) {
                // Send back with errors
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $title = $this->request->getPost('title');
            $content = $this->request->getPost('content');
            $data = ['title' => $title, 'content' => $content]; // Default data array

            $img = $this->request->getFile('image');
            if ($img->isValid() && !$img->hasMoved()) {
                $newName = $img->getRandomName(); // Generate a new, random name for the file
                $img->move(WRITEPATH . 'uploads/blog', $newName); // Move the file to the server
                $data['image_name'] = $img->getName(); // Original name or $newName after move
                $data['image_path'] = WRITEPATH . 'uploads/blog/' . $newName; // Path where the image is stored
            }

            if ($model->save($data)) {
                // Optionally handle image data in model if necessary
                if (isset($data['image_name'])) {
                    // Assuming your model has a method for additional image processing
                    $blogPostId = $model->getInsertID(); // Get the ID of the newly created blog post
                    $model->saveImage($blogPostId, $data['image_name'], $data['image_path']);
                }
                return redirect()->to('/admin/blog')->with('message', 'Post created successfully');
            } else {
                // Handle failure
                return redirect()->back()->withInput()->with('error', 'Failed to create post');
            }
        }

        // Load the view for creating a new post
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