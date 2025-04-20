<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - ElectroSH</title>
    
    <style>
        input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 1000px #111 inset !important;
            -webkit-text-fill-color: #fff !important;
            caret-color: #0f0;
            transition: background-color 5000s ease-in-out 0s;
        }
        .scroll-hidden {
            overflow-y: scroll;       
            scrollbar-width: 1px;   
            -ms-overflow-style: 1px;
        }
        .scroll-hidden::-webkit-scrollbar {
            display: none;           
        }

        /* OTP POPUP STYLES */
        .otp-popup {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }
        .otp-box {
            background-color: #111;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            color: #fff;
            width: 90%;
            max-width: 400px;
        }
        .otp-box h3 {
            margin-bottom: 20px;
            color: #0f0;
        }
        .otp-inputs {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .otp-inputs input {
            width: 40px;
            height: 50px;
            font-size: 22px;
            text-align: center;
            border: 1px solid #0f0;
            background-color: #222;
            color: #0f0;
            border-radius: 5px;
        }
        .otp-buttons button {
            margin: 5px;
            padding: 8px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .confirm-btn {
            background-color: #0f0;
            color: #000;
        }
        .cancel-btn {
            background-color: #f00;
            color: #fff;
        }
        #form_2{
            display: none;
        }
    </style>
    <link rel="stylesheet" href="../css/login-style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>



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

<body onload="start()">
    <section> 
        <?php for ($i = 0; $i < 300; $i++) echo "<span></span>"; ?>
        <div class="signin">
            <div class="content">
                <h2>Register</h2>
                <form action="" method="post" class="form scroll-hidden">
                    <div class="form" id="form_1">
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

                        <div class="links"> <a href="#"></a> <a href="login.php">login</a>
                        </div>
                        <div class="inputBox">
                            <div style="width:100%; padding: 1px;">
                                <input type="button" value="NEXT" onclick="showOtpPopupOTP()">
                            </div>
                        </div>
                    </div>
                    <div class="form" id="form_2">
                        <div class="inputBox">
                            <input type="text" name="userName" required> <i>password</i>
                        </div>

                        <div class="inputBox">
                            <input type="text" name="firstName" id="first_name" required> <i>Confirm</i>
                        </div>

                        <div class="links"> <a href="#"></a> <a href="login.php">login</a> </div>

                        <div class="inputBox">
                            <div style="width:100%; padding: 1px; display: flex; justify-content: center;">
                                <div class="g-recaptcha" 
                                    data-sitekey="6Le11R4rAAAAADAHrMqRL6qUO5F40FBFNhx5NzLK">
                                </div>
                            </div>
                        </div>

                        <div class="inputBox">
                            <div style="width:100%; padding: 1px;">
                                <input type="submit" value="NEXT" name="register">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section> 

    <?php
include 'connection.php';

if (isset($_POST['register'])) {
    $userName = trim($_POST['userName']);
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match!');</script>";
        exit;
    }

    // reCAPTCHA
    $recaptcha = $_POST['g-recaptcha-response'];
    $secret_key = '6Le11R4rAAAAAOM4XmkHFUROrq4EssWpYFfK7O4v';
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $recaptcha;
    $response = file_get_contents($url);
    $response = json_decode($response);

    if (intval($responseKeys["success"]) !== 1) {
        echo "<script>alert('Please complete CAPTCHA!');</script>";
        exit;
    }

    // Example DB Insert (secure this later)
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, first_name, last_name, email, password) VALUES ('$userName', '$firstName', '$lastName', '$email', '$passwordHash')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Registered successfully!'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>
    <!-- OTP POPUP -->
    <div class="otp-popup" id="otpPopup">
        <div class="otp-box">
            <h3>hi  Enter 6-Digit OTP</h3>
            <div class="otp-inputs">
                <input type="text" maxlength="1" oninput="moveToNext(this, 1)" id="otp1">
                <input type="text" maxlength="1" oninput="moveToNext(this, 2)" id="otp2">
                <input type="text" maxlength="1" oninput="moveToNext(this, 3)" id="otp3">
                <input type="text" maxlength="1" oninput="moveToNext(this, 4)" id="otp4">
                <input type="text" maxlength="1" oninput="moveToNext(this, 5)" id="otp5">
                <input type="text" maxlength="1" oninput="moveToNext(this, 6)" id="otp6">
            </div>
            <div class="otp-buttons">
                <button class="confirm-btn" onclick="confirmOtp()">Confirm</button>
                <button class="cancel-btn" onclick="hideOtpPopup()">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        function start(){
            document.getElementById("form_1").style.display = "flex";
            document.getElementById("form_2").style.display = "none";

            const form = document.querySelector("form");
            form.addEventListener("submit", function(e) {
                if (grecaptcha.getResponse() === "") {
                    e.preventDefault();
                    alert("Please complete the reCAPTCHA.");
                }
            });
        }
        
        function showOtpPopupOTP() {
            const useOtp = false; // s86503
            const letters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            const letter = letters[Math.floor(Math.random() * letters.length)];

            if(!useOtp){
                let numbers = "";
                for (let i = 0; i < 5; i++) {
                    numbers += Math.floor(Math.random() * 10);
                }

                const otpArray = (letter + numbers).split("");
                for (let i = otpArray.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [otpArray[i], otpArray[j]] = [otpArray[j], otpArray[i]];
                }

                // alert(otpArray.join(""));
                sha256(otpArray.join("")).then(hash => {
                    setCookie("OTP", hash, 1);
                });

                document.getElementById('otpPopup').style.display = 'flex';
                document.getElementById('otp1').focus();
            }else{
                document.getElementById("form_1").style.display = "none";
                document.getElementById("form_2").style.display = "flex";
            }
        }

        function hideOtpPopup() {
            document.getElementById('otpPopup').style.display = 'none';
            const inputs = document.querySelectorAll('.otp-inputs input');
            inputs.forEach(input => input.value = '');
        }

        function moveToNext(current, nextId) {
            if (current.value.length == 1 && nextId <= 6) {
                document.getElementById('otp' + nextId).focus();
            }
        }

        async function confirmOtp() {
            let otp = ''; // T87670
            for (let i = 1; i <= 6; i++) {
                const val = document.getElementById('otp' + i).value;
                if (val === '') {
                    alert("Please enter all 6 digits.");
                    return;
                }
                otp += val;
            }

            const hashedOtp = await sha256(otp);

            if (getCookie("OTP") === hashedOtp) {
                document.getElementById("form_1").style.display = "none";
                document.getElementById("form_2").style.display = "flex";
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                    footer: '<a href="#">Why do I have this issue?</a>'
                });
            }
            hideOtpPopup();
        }

        async function sha256(message) {
            const msgBuffer = new TextEncoder().encode(message);
            const hashBuffer = await crypto.subtle.digest('SHA-256', msgBuffer);
            const hashArray = Array.from(new Uint8Array(hashBuffer));
            const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
            return hashHex;
        }

        function setCookie(name, value, days = 1) {
            const date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            const expires = "expires=" + date.toUTCString();
            document.cookie = `${name}=${value}; ${expires}; path=/`;
        }
        
        function getCookie(name) {
            const cookies = document.cookie.split(';');
            for (let cookie of cookies) {
                const [key, val] = cookie.trim().split('=');
                if (key === name) return val;
            }
            return null;
        }
    </script>

</body>
</html>
