<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('welcome', 'Modules\Welcome\Controllers\Welcome::index');

// // We'll create clever routes for modules later, for now manually add for tests.
// if (file_exists(ROOTPATH . 'forgeigniter/modules/WelcomeModule/Config/Routes.php')) {
//     require_once ROOTPATH . 'forgeigniter/modules/WelcomeModule/Config/Routes.php';
// }


// Dynamic module routing
// NOTE: Possibly just load via config file instead of this ( performance )
$modulesPath = ROOTPATH . 'forgeigniter/modules';
$dir = new DirectoryIterator($modulesPath);

foreach ($dir as $fileinfo) {
    if ($fileinfo->isDir() && !$fileinfo->isDot()) {
        $moduleName = $fileinfo->getFilename();
        $routesFilePath = $modulesPath . '/' . $moduleName . '/Config/Routes.php';

        // Because the routes file may not be found
        // NOTE: We should check via the module installer too
        /**
         * NOTE: Maybe add a nice error view page for this
         * like
         * echo view('routes_config_error', ['message' => $errorMessage]);
         */
        if (!file_exists($routesFilePath)) {
            echo "Error: Config Routes file not found for module: " . htmlentities($moduleName);
            exit;
        }

        require_once $routesFilePath;
    }
}