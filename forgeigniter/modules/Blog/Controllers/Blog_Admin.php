<?php
/**
 * ForgeIgniter
 *
 * We'll clean things up later on
 *
 */
namespace Modules\Blog\Controllers;

use Modules\Blog\Models\Blog_Model;

class Blog_Admin extends \App\Controllers\Admin_Controller {

    public function index() {
        $model = new Blog_Model();
        $data['blog_posts'] = $model->getPostsWithImages();

        //echo view('Modules\Blog\Views\admin\list_posts', $data);
        //return $this->moduleView('admin\list_posts', $data);
        echo admin_view('list_posts', $data);
    }

    //CREATE
    public function create() {
        helper(['form', 'url']);
        $model = new Blog_Model();

        if ($this->request->is('post')) {
            // Validation Rules
            $rules = [
                'title' => 'required|min_length[3]|max_length[255]',
                'content' => 'required',
                'image' => 'max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $title = $this->request->getPost('title');
            $content = $this->request->getPost('content');
            $data = ['title' => $title, 'content' => $content];

            // This image shit pisses me off here
            // Image Manager needed!

            $img = $this->request->getFile('image');
            if (!empty($img) && $img->isValid() && !$img->hasMoved()) {
                $newName = $img->getRandomName();
                $targetPath = 'uploads/blog'; // Should pick later on !?
                $img->move(FCPATH . $targetPath, $newName);
                $data['image_name'] = $newName;
                $data['image_path'] = $targetPath . '/';
            }

            if ($model->save($data)) {
                if (isset($data['image_name'])) {
                    $blogPostId = $model->getInsertID();
                    $model->saveImage($blogPostId, $data['image_name'], $data['image_path']);
                }
                return redirect()->to('/admin/blog')->with('message', 'Post created successfully');
            } else {
                return redirect()->back()->withInput()->with('error', 'Failed to create post');
            }
        }

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

    // DELETE
    public function delete($postId = null) {
        $model = new Blog_Model();
        helper(['form', 'url']);

        if ($postId && $model->find($postId)) {

            $deleteFiles = $this->request->getPost('delete_files') === 'yes';

            if ($deleteFiles) {
                $images = $model->getImagesByPostId($postId);
                foreach ($images as $image) {
                    $filePath = FCPATH . $image['image_path'] . $image['image_name'];
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }

                    $model->deleteImage($image['id']);
                }
            }

            $model->delete($postId);

            return redirect()->to('/admin/blog')->with('message', 'Post Deleted');
        } else {
            return redirect()->to('/admin/blog')->with('error', 'Post not found');
        }
    }

}