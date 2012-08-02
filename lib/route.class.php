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
        array_push($this->routestack, array(
            'alias' => $alias,
            'controller' => $options['controller'],
            'action' => $options['action'],
            'id' => $options['id'],
            'otherid' => $options['otherid'],
        ));
    }

    /**
     * Processes the registered routes.
     * @return void
     */
    public function ProcessRoutes() {
        $appbase = explode('index.php', $_SERVER['SCRIPT_NAME']);
        $requestalias = str_ireplace($appbase[0], '', $_SERVER['REQUEST_URI']);
        if (count($this->routestack) > 0) {
            foreach ($this->routestack as $route) {
                if ('/' . $requestalias == $route['alias']) {
                    $_GET['controller'] = $route['controller'];
                    $_REQUEST['action'] = $route['action'];
                    $_GET['id'] = $route['id'];
                    $_GET['otherid'] = $route['otherid'];
                }
            }
        }
    }

}

?>
