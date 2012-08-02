<?php

class route {

    var $routestack;

    public function __construct() {
        $this->routestack = array();
    }

    /**
     * Add a route to the route stack.
     * @param string $alias The 'alias' that will be routed.
     * @param array $options The options in an array (controller, action, id and otherid).
     * @return void
     */
    public function AddRoute($alias, $options) {
        if (!isset($options['action'])) {
            $options['action'] = null;
        }
        if (!isset($options['id'])) {
            $options['id'] = null;
        }
        if (!isset($options['otherid'])) {
            $options['otherid'] = null;
        }
        array_push($this->routestack, array(
            'alias' => $alias,
            'controller' => $options['controller'],
            'action' => $options['action'],
            'id' => $options['id'],
            'otherid' => $options['otherid'],
        ));
    }

    /**
     * Processes the registered application routes.
     * @return void
     */
    public function ProcessRoutes() {
        $appbase = explode('index.php', $_SERVER['SCRIPT_NAME']);
        $requestalias = str_ireplace($appbase[0], '', $_SERVER['REQUEST_URI']);
        if (count($this->routestack) > 0) {
            foreach ($this->routestack as $route) {
                if (('/' . $requestalias == $route['alias']) || ('/' . $requestalias == $route['alias'] . '/')) {
                    $_GET['controller'] = $route['controller'];
                    if (isset($route['action'])) {
                        $_REQUEST['action'] = $route['action'];
                    }
                    if (isset($route['id'])) {
                        $_GET['id'] = $route['id'];
                    }
                    if (isset($route['otherid'])) {
                        $_GET['otherid'] = $route['otherid'];
                    }
                }
            }
        }
    }

}

?>
