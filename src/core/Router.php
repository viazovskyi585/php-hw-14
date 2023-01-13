<?php
namespace Core;

class Router
{

  public function run()
  {
    $fullUrl = !empty($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : $_SERVER['REQUEST_URI'];
    $urlArr = explode('?', $fullUrl);
    $url = $urlArr[0];

    $config = include __DIR__ . '/../config/routes.php';

    $controllerName = '';
    $controller = null;
    $methodName = 'index';

    if (!empty($config[$url])) {
      $configEntry = $config[$url];
      [$className, $methodName] = explode('@', $configEntry);
      $controllerName = "App\\Controllers\\$className";
    } else {
      $controller = new \App\Controllers\Error404();
    }

    if (class_exists($controllerName)) {
      $controller = new $controllerName();
    } else {
      $controller = new \App\Controllers\Error404();
    }

    if (isset($controller::$authorization)) {
      if (!$controller->authorize()) {
        return;
      }
    }

    if (method_exists($controller, $methodName)) {
      $controller->$methodName();
    } else if (method_exists($controller, 'error')) {
      $controller->error();
    } else {
      $errorController = new \App\Controllers\Error404();
      $errorController->index();
    }
  }
}
