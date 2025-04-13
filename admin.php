<?php
    $permission = true;
    if ($permission) {
        
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        $path = $_SERVER['REQUEST_URI'];

        $fullUrl = $protocol . "://" . $host . $path;

        $parts = explode("/", trim($path, "/"));

        echo "paths : <br />";
        for ($i=0; $i < 2; $i++) {
            echo $parts[$i] . "<br />";
        }
        echo "===============<br />";

        // Echo it
        echo "💻 Your current path is: <strong>$fullUrl</strong>";
    }else{
        header("Location: /404.php");
        exit;
    }
?>