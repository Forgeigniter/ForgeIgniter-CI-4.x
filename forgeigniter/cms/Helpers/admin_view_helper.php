<?php

if (!function_exists('admin_view')) {

    function admin_view(string $view, array $data = [], array $options = []): string
    {
        // We need to get the module name from the controller
        // Possibly take this approach later ?
        $viewPath = "Modules\Blog\Views\admin\\{$view}";

        return view($viewPath, $data, $options);
    }
}