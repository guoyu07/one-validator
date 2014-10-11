<?php
/**
 * Created by PhpStorm.
 * User: matanya
 * Date: 10/11/14
 * Time: 5:24 PM
 */

namespace Fish\OneValidator;

use Mustache_Engine;

class AssetsPublisher {
    /**
     * @var
     */
    protected $version;

    /**
     * @param $version
     */
    public function __construct($version) {
        $this->version = $version;
    }

    public function publish(){

        $controllerPath = $this->version<5?"controllers/OneValidatorController.php":"Http/Controllers/OneValidatorController.php";
        $controller = app_path($controllerPath);

        $routesPath = $this->version<5?"routes.php":"Http/routes.php";
        $route = app_path($routesPath);

        if (file_exists($controller)) return false;

        $appName = $this->version==5?$this->getAppName():false;
        $rendered = $this->renderControllerTemplate($appName);

        $this->saveAssets($controller, $rendered, $route);

        return true;
    }

    private function getAppName() {

        if (!file_exists(base_path('composer.json'))) return "App";

        $composer = file_get_contents(base_path("composer.json"));
        preg_match('/"(.+)\\\\\\\\"\s*:\s*"app\/"/',$composer, $matches);
        $appName = count($matches)>0?$matches[1]:false;

        return $appName;
    }

    /**
     * @param $appName
     * @return string
     */
    private function renderControllerTemplate($appName)
    {
        $mustache = new \Mustache_Engine();
        $template = file_get_contents(__DIR__ . "/assets/OneValidatorController.template");
        $rendered = $mustache->render($template, ["appname" => $appName, "laravel5" => $this->version >= 5]);
        return $rendered;
    }

    /**
     * @param $controller
     * @param $rendered
     * @param $route
     */
    private function saveAssets($controller, $rendered, $route)
    {
        file_put_contents($controller, $rendered);
        copy(__DIR__ . "/assets/one-validator.min.js", public_path("one-validator.min.js"));
        $routes = file_get_contents(__DIR__ . '/assets/routes.php');
        file_put_contents($route, PHP_EOL . $routes, FILE_APPEND);
    }
} 