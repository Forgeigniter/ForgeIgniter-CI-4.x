<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Admin_Controller extends Controller
{
    protected $moduleName;
    protected $viewPath;
    protected $appDirectory;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Another way ?
        helper(['admin_view_helper']);


        $paths = new \Config\Paths();
        $this->appDirectory = $paths->appDirectory;

        $classNameParts = explode('\\', get_class($this));
        $this->moduleName = $classNameParts[1] ?? null;
        $this->viewPath = "Modules/{$this->moduleName}/Views/";
    }

    protected function moduleView($view, $data = [], $options = [])
    {

        $viewPath = str_replace('\\', '/', $view);

        $fullPath = realpath(APPPATH . '../Modules/' . $this->moduleName . '/Views/' . $viewPath . '.php');

        if ($fullPath && file_exists($fullPath)) {
            extract($data);
            ob_start();
            include($fullPath);
            $buffer = ob_get_contents();
            ob_end_clean();
            return $buffer;
        } else {
            throw new \Exception("View file does not exist: {$fullPath}");
        }
    }
}
