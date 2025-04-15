<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - ElectroSH</title>
    <link rel="stylesheet" href="../css/login-style.css">
    <style>
        input:-webkit-autofill {
        -webkit-box-shadow: 0 0 0 1000px #111 inset !important;
        -webkit-text-fill-color: #fff !important;
        caret-color: #0f0; /* optional: green caret for style */
        transition: background-color 5000s ease-in-out 0s;
        }
        .scroll-hidden {
        overflow-y: scroll;        /* allow vertical scroll */
        scrollbar-width: 1px;     /* Firefox */
        -ms-overflow-style: 1px;  /* IE and Edge */
        }

        .scroll-hidden::-webkit-scrollbar {
        display: none;             /* Chrome, Safari, Opera */
        }

    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<script>
  document.addEventListener("contextmenu", function(e){
    e.preventDefault();
  }, false);

  document.onkeydown = function(e) {
    // Disable F12, Ctrl+Shift+I/J/C, Ctrl+U
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
                <!-- user name, email, password, full name,  -->
                <h2>Register</h2>
                <!-- <div class="form"> -->
                    <form action="" method="post" class="form scroll-hidden">
                        <div class="inputBox">
                            <input type="text" name="userName" required> <i>user name</i>
                        </div>
                    
                        <div class="inputBox">
                            <input type="text" name="firstName" required> <i>first name</i>
                        </div>
                        <div class="inputBox">
                            <input type="text" name="lastName" required> <i>last name</i>
                        </div>
                        <div class="inputBox">
                            <input type="email" name="email" required> <i>email</i>
                        </div>
                        <div class="inputBox">
                            <input type="password" name="password" required> <i>Password</i>
                        </div>
                        <div class="links"> <a href="#"></a> <a href="login.php">login</a>
                        </div>
                        <div class="inputBox">
                                <div style="width:100%; padding: 1px;">
                                    <!-- <button></button> -->
                                    <input type="submit" name="register" value="register">
                                </div>
                        </div>
                        <?php
                            include 'connection.php';

                            if (isset($_POST['register'])) {
                                $firstName = trim($_POST['firstName']);
                                $lastName = trim($_POST['lastName']);
                                ?><script>
                                     async function askOTP() {
                                        const { value: url } = await Swal.fire({
                                            input: "text",
                                            inputLabel: "Check your mail inbox or spam folder.",
                                            inputPlaceholder: "Hi <?php echo $firstName; ?>, Enter the OTP code.",
                                            background: '#1e1e1e',
                                            color: '#ffffff',
                                            confirmButtonColor: '#0f0'
                                        });
                                        if (url) {
                                            Swal.fire({
                                                title:`Entered OTP: ${url}`,
                                                background: '#1e1e1e',
                                                color: '#ffffff',
                                                confirmButtonColor: '#0f0'
                                            });
                                        } else {
                                            Swal.fire({
                                                title:"OTP input was cancelled or empty.",
                                                background: '#1e1e1e',
                                                color: '#ffffff',
                                                confirmButtonColor: '#dc3545 '
                                            });
                                        }
                                    }
                                    askOTP();
                                </script><?php


                                // if (!empty($username) && !empty($password)) {
                                //     $stmt = $conn->prepare("INSERT INTO `test` (`name`, `pass`) VALUES (?, ?)");
                                //     $stmt->bind_param("ss", $username, $password); 

                                //     if ($stmt->execute()) {
                                //         echo "<script>popup();</script>";
                                //     } else {
                                //         echo "Upload failed: " . $stmt->error;
                                //     }

                                //     $stmt->close();
                                // } else {
                                //     echo "All fields are required.";
                                // }
                            }

                        ?>

                    </form>
                <!-- </div> -->
            </div>
        </div>
    </section> 

</body>
</html>