<?php
    // Set a cookie
    function setCookiePHP($name, $value, $minutes) {
        $expire = time() + ($minutes * 60);
        setcookie($name, $value, $expire, "/"); 
    }

    // Get a cookie
    function getCookiePHP($name) {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }
?>
