<?php

$route = $_SERVER['REQUEST_URI'];
if (str_contains($route, "?")) {
    $route = strstr($route, "?", true);
}
$route = str_replace('/', '', $route);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if ($route == '') {
    if ($_SESSION['is_logged_in'] === 1) {
        header('location: /dashboard');
    } else {
        header('location: /login');
    }
} else if ($route == 'logout') {
    session_destroy();
    header('location: /login');
} else {
    function render_view()
    {
        $view = $_SERVER['REQUEST_URI'];
        $params = array();

        if (str_contains($view, '?')) {
            $view = strstr($view, "?", true);
            parse_str($_SERVER['QUERY_STRING'], $params);
        }

        $view = str_replace('/', '', $view);

        if ($view == '') {
            $view = 'views/dashboard.php';
        } else {
            $view = 'views/' . $view . '.php';
        }
        require_once($view);
    }
    require_once('views/layout.php');
}
?>