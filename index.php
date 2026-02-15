<?php
session_start();
include 'db.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // --- SIGN UP LOGIC ---
    if (isset($_POST['signup'])) {
        $user = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        
        // Security: Hash the password
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        // Check if email already exists in 'signup' table
        $check = $conn->prepare("SELECT * FROM signup WHERE email=?");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $msg = "Email already exists!";
        } else {
            // Insert into 'signup' table
            $insertQuery = $conn->prepare("INSERT INTO signup (username, email, password) VALUES (?, ?, ?)");
            $insertQuery->bind_param("sss", $user, $email, $hashed_password);
            if ($insertQuery->execute()) {
                $msg = "Account created! Please Sign In.";
            } else {
                $msg = "Error: " . $conn->error;
            }
        }
    }

    // --- SIGN IN LOGIC ---
    if (isset($_POST['signin'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $sql = $conn->prepare("SELECT * FROM signup WHERE email=?");
        $sql->bind_param("s", $email);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the hashed password
            if (password_verify($pass, $row['password'])) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                header("Location: home.php");
                exit();
            } else {
                $msg = "Incorrect Password!";
            }
        } else {
            $msg = "User not found!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup By Rafay!!</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

<div class="container" id="container">
    
    <div class="form-container sign-up">
        <form action="index.php" method="POST">
            <h1>Create Account</h1>
            <div class="social-icons">
                <a href="https://www.google.com/ class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                <a href="https://www.facebook.com/" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://github.com/" class="icon"><i class="fa-brands fa-github"></i></a>
                <a href="https://www.linkedin.com" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
            <span>or use your email for registration</span>
            <input type="text" name="username" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="signup">Sign Up</button>
            <?php if($msg && isset($_POST['signup'])) echo "<p style='color:red; font-size:12px;'>$msg</p>"; ?>
        </form>
    </div>

    <div class="form-container sign-in">
        <form action="index.php" method="POST">
            <h1>Sign In</h1>
            <div class="social-icons">
                <a href="https://www.google.com/ class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                <a href="https://www.facebook.com/" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://github.com/" class="icon"><i class="fa-brands fa-github"></i></a>
                <a href="https://www.linkedin.com" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
            <span>or use your email password</span>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <a href="#">Forget Your Password?</a>
            <button type="submit" name="signin">Sign In</button>
            <?php if($msg && isset($_POST['signin'])) echo "<p style='color:red; font-size:12px;'>$msg</p>"; ?>
        </form>
    </div>

    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>Welcome Back!</h1>
                <p>Enter your personal details to use all of site features</p>
                <button class="hidden" id="login">Sign In</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Hello, Bro</h1>
                <p>Register with your personal details to use all of site features</p>
                <button class="hidden" id="register">Sign Up</button>
            </div>
        </div>
    </div>
</div>

<script>
    const container = document.getElementById('container');
    const registerBtn = document.getElementById('register');
    const loginBtn = document.getElementById('login');

    registerBtn.addEventListener('click', () => {
        container.classList.add("active");
    });

    loginBtn.addEventListener('click', () => {
        container.classList.remove("active");
    });
</script>

</body>
</html>