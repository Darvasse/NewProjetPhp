<?php

namespace App\Src;
use App\Src\Route\Route;
use App\Src\ServiceContainer\ServiceContainer;

class App
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';

    /**
     * @var array
     */
    private $routes = array();

    /**
     * @var statusCode
     */
    private $statusCode;

    /**
     * @var ServiceContainer
     */
    private $serviceContainer;

    public function __construct(ServiceContainer $serviceContainer)
    {
        $this->serviceContainer = $serviceContainer;
    }

    /**
     * Retrieve a service from the service container
     *
     * @param string $serviceName Name of the service to retrieve
     *
     * @return mixed
     */
    public function getService(string $serviceName)
    {
        return $this->serviceContainer->get($serviceName);
    }

    /**
     * Set a service in the service container
     *
     * @param string $serviceName Name of the service to set
     * @param mixed $assigned Value of the service to set
     */
    public function setService(string $serviceName, $assigned)
    {
        $this->serviceContainer->set($serviceName, $assigned);
    }

    /**
     * Create a route for HTTP verb GET
     *
     * @param string $pattern
     * @param callable $callable
     * @return App $this
     */
    public function get(string $pattern, callable $callable)
    {
        $this->registerRoute(self::GET, $pattern, $callable);

        return $this;
    }

    /**
     * Create a route for HTTP verb POST
     *
     * @param string $pattern
     * @param callable $callable
     * @return $this
     */
    public function post(string $pattern, callable $callable)
    {
        $this->registerRoute(self::POST, $pattern, $callable);

        return $this;
    }

    /**
     * Create a route for HTTP verb PUT
     *
     * @param string $pattern
     * @param callable $callable
     * @return $this
     */
    public function put(string $pattern, callable $callable)
    {
        $this->registerRoute(self::PUT, $pattern, $callable);

        return $this;
    }

    /**
     * Create a route for HTTP verb DELETE
     *
     * @param string $pattern
     * @param callable $callable
     * @return $this
     */
    public function delete(string $pattern, callable $callable)
    {
        $this->registerRoute(self::DELETE, $pattern, $callable);

        return $this;
    }

    /**
     * Check witch route to use inside the router
     *
     * @throws HttpException
     */
    public function run()
    {
        $methode = $_SERVER['REQUEST_METHOD'] ?? self::GET;
        $uri = $_SERVER['REQUEST_URI'] ?? '/';

        foreach ($this->routes as $route)
        {
            if($route->match($methode, $uri))
            {
                return $this->process($route);
            }
        }

        header("Location: /404");
    }

    /**
     * Process route
     *
     * @param Route $route
     */
    private function process(Route $route)
    {
        try
        {
            http_response_code($this->statusCode);
            echo call_user_func_array($route->getCallable(), $route->getArguments());
        } catch (HttpException $e) {
            throw $e;
        }catch (\Exception $e){
            throw new \Error('There was an Error during the processing of your request');
        }
    }

    /**
     * Register a route in the routes array
     *
     * @param string $method
     * @param string $pattern
     * @param callable $callable
     */
    private function registerRoute(string $method, string $pattern, callable $callable)
    {
        $this->routes[] = new Route($method, $pattern, $callable);
    }
}