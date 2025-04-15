<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - electroSH</title>
    <link rel="stylesheet" href="../css/login-style.css">
    <style>
        input:-webkit-autofill {
        -webkit-box-shadow: 0 0 0 1000px #111 inset !important;
        -webkit-text-fill-color: #fff !important;
        caret-color: #0f0; /* optional: green caret for style */
        transition: background-color 5000s ease-in-out 0s;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<!-- Define popup function early -->
<script>
  function popup(){
    Swal.fire({
            title: "Login Successfull!",
            icon: "success",
            draggable: true,
            background: '#1e1e1e',
            color: '#ffffff',
            confirmButtonColor: '#0f0'
    });
  }
</script>

<!-- Disable Inspect Tools -->
<script>
  document.addEventListener("contextmenu", function(e){
    e.preventDefault();
  }, false);

  document.onkeydown = function(e) {
    if (e.keyCode == 123 || 
        (e.ctrlKey && e.shiftKey && (e.keyCode == 73 || e.keyCode == 74 || e.keyCode == 67)) || 
        (e.ctrlKey && e.keyCode == 85)) {
      return false;
    }
  };

  
</script>

<body>
    <section>
        <?php for ($i = 0; $i < 300; $i++) echo "<span></span>"; ?>

        <div class="signin">
            <div class="content">
                <h2>Sign In</h2>
                    <form action="" method="post" class="form">
                        <div class="inputBox">
                            <input type="email" name="email" required> <i>email</i>
                        </div>
                        <div class="inputBox">
                            <input type="password" name="password" required> <i>Password</i>
                        </div>
                        <div class="links"> <a href="#">Forgot Password</a> <a href="register.php">Signup</a></div>
                        <div class="inputBox">
                            <input type="submit" name="login" value="Login">
                        </div>
                        <p style="color:#ffffff">
                        <?php
                            include 'connection.php';

                            if (isset($_POST['login'])) {
                                $username = trim($_POST['email']);
                                $password = trim($_POST['password']);

                                if (!empty($username) && !empty($password)) {
                                    $stmt = $conn->prepare("INSERT INTO `test` (`name`, `pass`) VALUES (?, ?)");
                                    $stmt->bind_param("ss", $username, $password); 

                                    if ($stmt->execute()) {
                                        echo "<script>popup();</script>";
                                    } else {
                                        echo "Upload failed: " . $stmt->error;
                                    }

                                    $stmt->close();
                                } else {
                                    echo "All fields are required.";
                                }
                            }
                        ?>
                    </p>
                </form>
            </div>
        </div>
    </section> 
</body>
</html>
