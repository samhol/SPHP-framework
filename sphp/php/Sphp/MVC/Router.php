<?php

/**
 * Router.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\MVC;

use Sphp\Exceptions\RuntimeException;
use Sphp\Stdlib\URL;

/**
 * Simple URL router
 *
 * This it the Igniter URL Router, the layer of a web application between the
 * URL and the function executed to perform a request. The router determines
 * which function to execute for a given URL.
 *
 * <code>
 * $router = new \Igniter\Router;
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
 * </code>
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Router {

  /**
   * Contains the callback function to execute if none of the given routes can
   * be matched to the current URL.
   *
   * @var atring|array
   */
  private $default_route = null;

  /**
   * An array containing the list of routing rules and their callback
   * functions, as well as their priority and any additional paramters.
   *
   * @var array
   */
  private $routes = [];

  /**
   * A sanitized version of the URL, excluding the domain and base component
   *
   * @var string
   */
  private $path = '';

  /**
   * Constructs a new instance
   * 
   * Initializes the router by getting the URL and cleaning it.
   *
   * @param  URL|string|null $url optional URL to route
   */
  public function __construct($url = null) {
    if ($url === null) {
      $url = URL::getCurrent();
    }
    if (is_string($url)) {
      $url = new URL($url);
    }
    $this->path = rtrim($url->getPath(), '/') . '/';
  }

  /**
   * If the router cannot match the current URL to any of the given routes,
   * the function passed to this method will be executed instead. This would
   * be useful for displaying a 404 page for example.
   *
   * @param  callable $callback
   * @return $this for a fluent interface
   */
  public function setDefaultRoute($callback) {
    $this->default_route = $callback;
    return $this;
  }

  /**
   * Runs the router matching engine and then calls the dispatcher
   * 
   * Tries to match one of the URL routes to the current URL, otherwise
   * execute the default function.
   *
   * @return $this for a fluent interface
   */
  public function execute() {
    // Whether or not we have matched the URL to a route
    $matched_route = false;
    // Sort the array by priority
    ksort($this->routes);
    // Loop through each priority level
    foreach ($this->routes as $routes) {
      // Loop through each route for this priority level
      foreach ($routes as $route => $callback) {
        // Does the routing rule match the current URL?
        if (preg_match($route, $this->path, $matches)) {
          // A routing rule was matched
          $matched_route = TRUE;
          // Parameters to pass to the callback function
          $params = [$this->path];
          // echo "<pre>";
          // var_dump($matches);
          // echo "</pre>";
          // Get any named parameters from the route
          foreach ($matches as $key => $match) {
            if (is_string($key)) {
              $params[] = $match;
            }
          }
          // Store the parameters and callback function to execute later
          $theParams = $params;
          $theCallback = $callback;
          break;
        }
      }
    }
    // Was a match found or should we execute the default callback?
    if (!$matched_route && $this->default_route !== null) {
      $theParams = $this->default_route;
      $theCallback = [$this->path];
    }
    if ($theParams === null || $theCallback === null) {
      throw new RuntimeException('No callback or parameters found for the route');
    }
    call_user_func_array($theCallback, $theParams);
    return $this;
  }

  /**
   * Adds a new URL routing rule to the routing table, after converting any of
   * our special tokens into proper regular expressions.
   *
   * @param  string   $route
   * @param  callable $callback
   * @param  integer  $priority
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function route(string $route, callable $callback, int $priority = 10) {
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
    // Does this URL routing rule already exist in the routing table?
    if (isset($this->routes[$priority][$route])) {
      throw new RuntimeException('The URI "' . htmlspecialchars($route) . '" already exists in the router table');
    }
    // Add the route to our routing array
    $this->routes[$priority][$route] = $callback;
    return $this;
  }

}
