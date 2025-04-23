<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<script>
    // Save data to localStorage
    localStorage.setItem("username", "Shehan");

    // Send to PHP using fetch
    fetch("save.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            username: localStorage.getItem("username")
        })
    });

        // Save data
    localStorage.setItem("username", "Shehan");

    // Read data
    const username = localStorage.getItem("username");

    if (username) {
        console.log("Username from localStorage:", username);
    } else {
        console.log("No data found in localStorage.");
    }


</script>
</body>
</html>