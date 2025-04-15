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
    </style>
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

<body>
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
                                <input type="button" value="NEXT" onclick="showOtpPopup()">
                            </div>
                        </div>
                    </div>
                    <div class="form" id="form_2">
                        <div class="inputBox">
                            <input type="text" name="userName" required> <i>user name</i>
                        </div>
                    
                        <div class="inputBox">
                            <input type="text" name="firstName" id="first_name" required> <i>first name</i>
                        </div>
                        <div class="inputBox">
                            <input type="text" name="lastName" id="last_name" required> <i>last name</i>
                        </div>
                        <div class="inputBox">
                            <input type="email" name="email" id="mail" required> <i>email</i>
                        </div>

                        <div class="links"> <a href="#"></a> <a href="login.php">login</a>
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
$firstName = trim($_POST['firstName']);
$lastName = trim($_POST['lastName']);

echo "<script>console.log('$firstName')</script>";
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
        function showOtpPopup() {
            document.getElementById('otpPopup').style.display = 'flex';
            document.getElementById('otp1').focus();
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

        function confirmOtp() {
            let otp = '';
            for (let i = 1; i <= 6; i++) {
                const val = document.getElementById('otp' + i).value;
                if (val === '') {
                    alert("Please enter all 6 digits.");
                    return;
                }
                otp += val;
            }
            alert("Entered OTP: " + otp);
            hideOtpPopup();
        }
    </script>

</body>
</html>
