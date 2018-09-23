<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\MVC;

use Sphp\Exceptions\RuntimeException;
use Sphp\Stdlib\Networks\URL;
use Sphp\Stdlib\Datastructures\PriorityQueue;
use Sphp\Exceptions\IllegalStateException;

/**
 * Implements an URL router
 *
 * a router is a web application between the URL and the function executed to 
 * perform a request. The router determines which function to execute for a given URL.
 *
 * <pre>
 * $router = new Router;
 *
 * // Adding a basic route
 * $router->route( '/login', 'login_function' );
 *
 * // Adding a route with a named alphanumeric capture, using the <:var_name> syntax
 * $router->route( '/user/view/<:username>', 'view_username' );
 *
 * // Adding a route with a named numeric capture, using the <#var_name> syntax
 * $router->route( '/user/view/<#user_id>', array( 'UserClass', 'view_user' ) );
 *
 * // Adding a route with a wildcard capture (Including directory separtors), using
 * // the <*var_name> syntax
 * $router->route( '/browse/<*categories>', 'category_browse' );
 *
 * // Adding a wildcard capture (Excludes directory separators), using the
 * // <!var_name> syntax
 * $router->route( '/browse/<!category>', 'browse_category' );
 *
 * // Adding a custom regex capture using the <:var_name|regex> syntax
 * $router->route( '/lookup/zipcode/<:zipcode|[0-9]{5}>', 'zipcode_func' );
 *
 * // Specifying priorities
 * $router->route( '/users/all', 'view_users', 1 ); // Executes first
 * $router->route( '/users/<:status>', 'view_users_by_status', 100 ); // Executes after
 *
 * // Specifying a default callback function if no other route is matched
 * $router->setDefaultRoute( 'page_404' );
 *
 * // Run the router
 * $router->execute();
 * </pre>
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Router {

  /**
   * Contains the callback function to execute if none of the given routes can
   * be matched to the current URL.
   *
   * @var callable
   */
  private $defaultRoute = null;

  /**
   * A priority queue containing routing rules and their callback
   * functions.
   *
   * @var PriorityQueue
   */
  private $routes;

  /**
   * A sanitized version of the URL, excluding the domain and base component
   *
   * @var string
   */
  private $path = '';

  /**
   * Constructor
   * 
   * Initializes the router by getting the URL and cleaning it.
   *
   * @param  string|null $url optional URL to route
   */
  public function __construct(string $url = null) {
    $this->path = $this->getPath($url);
    $this->routes = new PriorityQueue();
  }

  /**
   * Sets the callback function for the default route
   * 
   * If the router cannot match the current URL to any of the given routes,
   * the function passed to this method will be executed instead. This would
   * be useful for displaying a 404 page for example.
   *
   * @param  callable $callback the callback function for the default route
   * @return $this for a fluent interface
   */
  public function setDefaultRoute($callback) {
    $this->defaultRoute = $callback;
    return $this;
  }

  /**
   * Runs the router matching engine and then calls the dispatcher
   * 
   * Tries to match one of the URL routes to the current URL, otherwise
   * execute the default function.
   *
   * @param  string|null $url optional URL to route
   * @return $this for a fluent interface
   * @throws InvalidStateException
   * @throws RuntimeException
   */
  public function execute(string $url = null) {
    if ($this->isEmpty()) {
      throw new IllegalStateException('The router is empty and cannot be executed');
    }
    if ($url === null) {
      $path = $this->path;
    } else {
      $path = $this->getPath($url);
    }
    // Whether or not we have matched the URL to a route
    $routeFound = false;
    // Loop through routes
    foreach ($this->routes as $routingData) {
      $route = $routingData['route'];
      $callback = $routingData['callback'];
      // Does the routing rule match the current URL?
      if (preg_match($route, $path, $matches)) {
        // A routing rule was matched
        $routeFound = true;
        // Parameters to pass to the callback function
        $params = [$path];
        // echo "<pre>";
        // var_dump($matches);
        // echo "</pre>";
        // Get any named parameters from the route
        foreach ($matches as $key => $match) {
          if (is_string($key)) {
            $params[] = $match;
          }
        }
        // execute the callback and stop
        call_user_func_array($callback, $params);
        break;
      }
    }
    // Was a match found or should we execute the default callback?
    if (!$routeFound && $this->defaultRoute !== null) {
      call_user_func_array($this->defaultRoute, [$path]);
      $routeFound = true;
    }
    if (!$routeFound) {
      throw new IllegalStateException('No callback found for the route');
    }
    return $this;
  }

  /**
   * Adds a new URL routing rule to the routing table
   *
   * @param  string   $route
   * @param  callable $callback
   * @param  integer  $priority
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function route(string $route, $callback, int $priority = 10) {
    // Make sure the route ends in a / since all of the URLs will
    $route = rtrim($route, '/') . '/';
    // Custom capture, format: <:var_name|regex>
    $route = preg_replace('/\<\:(.*?)\|(.*?)\>/', '(?P<\1>\2)', $route);
    // Alphanumeric capture (0-9A-Za-z-_), format: <:var_name>
    $route = preg_replace('/\<\:(.*?)\>/', '(?P<\1>[A-Za-z0-9\-\_]+)', $route);
    // Numeric capture (0-9), format: <#var_name>
    $route = preg_replace('/\<\#(.*?)\>/', '(?P<\1>[0-9]+)', $route);
    // Wildcard capture (Anything INCLUDING directory separators), format: <*var_name>
    $route = preg_replace('/\<\*(.*?)\>/', '(?P<\1>.+)', $route);
    // Wildcard capture (Anything EXCLUDING directory separators), format: <!var_name>
    $route = preg_replace('/\<\!(.*?)\>/', '(?P<\1>[^\/]+)', $route);
    // Add the regular expression syntax to make sure we do a full match or no match
    $route = '#^' . $route . '$#';
    $this->routes->enqueue(['route' => $route, 'callback' => $callback], $priority);
    return $this;
  }

  /**
   * Checks whether the router has no routes defined
   * 
   * @return bool true if the router has no routes defined, false otherwise
   */
  public function isEmpty(): bool {
    return $this->defaultRoute === null && $this->routes->isEmpty();
  }

  /**
   * 
   * @param string $url
   * @return string
   */
  public static function getPath(string $url = null): string {
    if ($url === null) {
      $url = URL::getCurrent();
    } else {
      $url = new URL($url);
    }
    return rtrim($url->getPath(), '/') . '/';
  }

}
