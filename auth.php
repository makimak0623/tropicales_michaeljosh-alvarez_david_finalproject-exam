<?php
session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!file_exists("users.xml")) {
        $xml = new SimpleXMLElement("<users></users>");
        $xml->asXML("users.xml");
    } else {
        $xml = simplexml_load_file("users.xml");
    }

    if ($action === "signup") {
        foreach ($xml->user as $user) {
            if ($user->username == $username) {
                $message = "Username already exists!";
                break;
            }
        }

        if ($message === "") {
            $newUser = $xml->addChild("user");
            $newUser->addChild("username", $username);
            $newUser->addChild("password", password_hash($password, PASSWORD_DEFAULT));
            $xml->asXML("users.xml");
            $message = "Registration successful! You can now log in.";
        }
    }

    if ($action === "login") {
        foreach ($xml->user as $user) {
            if (
                $user->username == $username &&
                password_verify($password, $user->password)
            ) {
                $_SESSION["username"] = $username;
                header("Location: manage.php");
                exit;
            }
        }
        $message = "Invalid login credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Auth Page</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: url('bgg.png') no-repeat center center / cover;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #ffffff;
    }

    .container {
      background: rgba(0, 0, 0, 0.6);
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: 0 0 25px rgba(0, 255, 255, 0.2);
      width: 360px;
      text-align: center;
      backdrop-filter: blur(10px);
      position: relative;
    }

    h1 {
      color: #ffffff;
      margin-bottom: 20px;
      font-size: 1.8rem;
    }

    .message {
      color: #ff4d4d;
      margin-bottom: 15px;
      font-weight: bold;
    }

    input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: none;
      border-radius: 8px;
      font-size: 14px;
      background-color: rgba(255, 255, 255, 0.1);
      color: #ffffff;
      outline: none;
      backdrop-filter: blur(4px);
      box-sizing: border-box;
    }

    input::placeholder {
      color: #cccccc;
    }

    button {
      width: 100%;
      padding: 12px;
      margin-top: 15px;
      background: linear-gradient(135deg, #00c9ff 0%, #92fe9d 100%);
      color: #000;
      border: none;
      border-radius: 10px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 15px;
      box-sizing: border-box;
    }

    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 255, 255, 0.4);
    }

    .toggle-link {
      margin-top: 20px;
      display: block;
      color: #00c9ff;
      text-decoration: none;
      cursor: pointer;
      font-size: 14px;
    }

    .toggle-link:hover {
      text-decoration: underline;
    }

    .close-btn {
      position: absolute;
      top: 18px;
      right: 22px;
      font-size: 26px;
      color: #ffffff;
      cursor: pointer;
      font-weight: bold;
      transition: color 0.3s ease;
    }

    .close-btn:hover {
      color: #00c9ff;
    }
  </style>
</head>
<body>
  <div class="container">
    <span class="close-btn" onclick="window.location.href='index.html'">&times;</span>
    <h1 id="form-title">Welcome</h1>
    <?php if ($message): ?>
      <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <form method="POST" id="auth-form">
      <input type="hidden" name="action" value="login" id="action-type">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" id="submit-btn">Login</button>
    </form>
    <a class="toggle-link" onclick="toggleForm()">Don't have an account? Sign up</a>
  </div>

  <script>
    const formTitle = document.getElementById("form-title");
    const actionType = document.getElementById("action-type");
    const submitBtn = document.getElementById("submit-btn");
    const toggleLink = document.querySelector(".toggle-link");

    let isLogin = true;

    function toggleForm() {
      isLogin = !isLogin;
      formTitle.innerText = isLogin ? "Welcome Back" : "Create an Account";
      actionType.value = isLogin ? "login" : "signup";
      submitBtn.innerText = isLogin ? "Login" : "Sign Up";
      toggleLink.innerText = isLogin ? "Don't have an account? Sign up" : "Already have an account? Login";
    }
  </script>
</body>
</html>
