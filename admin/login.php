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
  function popup(t_title, t_icon, t_path){
    Swal.fire({
            title: t_title,
            icon: t_icon,
            draggable: true,
            background: '#1e1e1e',
            color: '#ffffff',
            confirmButtonColor: '#0f0'
    }).then((result) => {
        if (result.isConfirmed && t_path) {
            window.location.href = "../";
        }
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
                    <form action="login" method="post" class="form">
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
                            include 'models/encripter.php';

                            if (isset($_POST['login'])) {
                                $email = trim($_POST['email']);
                                $password = trim($_POST['password']);
                            
                                if (!empty($email) && !empty($password)) {
                                    $stmt = $conn->prepare("SELECT * FROM `user` WHERE `email` = ? AND `password` = ?");
                                    $stmt->bind_param("ss", $email, hash1($password));
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                            
                                    if ($result->num_rows > 0) {
                                        $dta = $result->fetch_assoc();

                                        $data = array(
                                            "id" => $dta['id'],
                                            "user_name" => $dta['user_name'],
                                            "role_id" => $dta['role_id'],
                                            "token_expiry" => $dta['token_expiry']
                                        );
                                        
                                        $json_data = json_encode($data);
                                        $base64_data = base64_encode($json_data);

                                        $token_expiry = date('Y-m-d H:i:s', strtotime('+5 days'));
                            
                                        $update_stmt = $conn->prepare("UPDATE `user` SET `token` = ?, `token_expiry` = ? WHERE `id` = ?");
                                        $update_stmt->bind_param("ssi", $base64_data, $token_expiry, $dta['id']);
                                        $update_stmt->execute();
                            
                                        ?><script>
                                            localStorage.setItem('username', '<?php echo $dta['user_name']; ?>');
                                            localStorage.setItem('token', '<?php echo $base64_data; ?>'); // Store the token
                                            popup("Login Successfull!", "success", true);
                                        </script> 
                                        <?php
                                    } else {
                                        echo "<script>popup('Invalid email or password.', 'error', false);</script>";
                                        //echo "Invalid email or password.";
                                    }
                                } else {
                                    echo "<script>popup('Please enter both email and password.', 'error', false);</script>";
                                    //echo "Please enter both email and password.";

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
