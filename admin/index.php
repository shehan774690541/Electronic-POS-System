<?php
    $permission = false;
    if (!$permission) {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        $path = $_SERVER['REQUEST_URI'];

        $fullUrl = $protocol . "://" . $host . $path;
        $parts = explode("/", trim($path, "/"));
        $parts[count($parts) - 1] = "admin/login";
        $newPath = implode("/", $parts);
        $getTo = $protocol . "://" . $host . "/" . $newPath;

        header("Location: $getTo");
        exit;
    }else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php
    }
?>

