<?php namespace MusicCollection\Bootstrap;

use MusicCollection\Handlers\BaseHandler;
use MusicCollection\Utils\Session;
use MusicCollection\Utils\Logger;

/**
 * Class WebBootstrap
 * @package MusicCollection\Bootstrap
 */
class WebBootstrap implements BootstrapInterface
{
    private string $className;
    private string $action;
    private Session $session;
    private Logger $logger;

    public function __construct()
    {
        session_start();
        $this->session = new Session($_SESSION);
        $this->logger = new Logger();
        $this->setup();
    }

    /**
     * Set up the route based on current path
     */
    public function setup(): void
    {
        //Get the url from the htaccess parameter & check existence (if not: 404!)
        $route = (!isset($_GET['_url']) || $_GET['_url'] == '' ? '' : $_GET['_url']);
        $routes = getRoutes();

        //Check existence of route & initiate correct Handler & actions based on route
        if (isset($routes[$route])) {
            list($class, $action) = explode('@', $routes[$route]);
            $this->className = '\\MusicCollection\\Handlers\\' . $class;
            $this->action = $action;
        } else {
            header('HTTP/1.0 404 Not Found');
            $this->className = '\\MusicCollection\\Handlers\\NotFoundHandler';
            $this->action = 'index';
        }
    }

    /**
     * Initialize controller, set dynamic properties, call current action & get the rendered data
     *
     * @return string
     */
    public function render(): string
    {
        try {
            if (!class_exists($this->className)) {
                throw new \Exception('Class ' . $this->className . ' does not exist!');
            }
            /** @var BaseHandler $page */
            $page = new $this->className($this->action);
            $page->session = $this->session;
            $page->logger = $this->logger;

            return $page->{$this->action}()->getHTML();
        } catch (\Exception $e) {
            $this->logger->error($e);
            die('Oops, something went wrong, please contact the site administrator.');
        }
    }
}
