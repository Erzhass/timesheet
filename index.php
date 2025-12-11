<?php
session_start();
if(isset($_SESSION['user'])) header('Location: dashboard.php');
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Timesheet PKL Nganjuk - Login</title>

<!-- FONT -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
/* ====== GLOBAL ====== */
body {
    margin: 0;
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* ====== LOGIN CONTAINER ====== */
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    padding: 20px;
}

/* ====== LOGIN BOX ====== */
.login-box {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    width: 100%;
    max-width: 400px;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.login-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
}

.login-box h2 {
    margin: 0;
    font-size: 28px;
    color: #2d3748;
    font-weight: 700;
    letter-spacing: -0.5px;
}

.subtitle {
    margin-top: 8px;
    font-size: 16px;
    color: #718096;
    font-weight: 400;
}

/* ====== INPUT ====== */
label {
    display: block;
    text-align: left;
    margin-top: 24px;
    font-size: 14px;
    color: #4a5568;
    font-weight: 600;
}

.input {
    width: 100%;
    margin-top: 8px;
    padding: 14px 16px;
    font-size: 16px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    outline: none;
    transition: all 0.3s ease;
    background: #f7fafc;
}

.input:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    background: #ffffff;
}

/* ====== LOGIN BUTTON ====== */
.btn-login {
    width: 100%;
    margin-top: 32px;
    padding: 14px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-login:hover {
    background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
}

.btn-login:active {
    transform: translateY(0);
}

/* Responsive adjustments */
@media (max-width: 480px) {
    .login-box {
        padding: 30px 20px;
        max-width: 90%;
    }
    .login-box h2 {
        font-size: 24px;
    }
}
</style>

</head>

<body>

<div class="login-container">
  <div class="login-box">
      <h2>Timesheet PKL Nganjuk</h2>
      <p class="subtitle">Silakan masuk ke akun Anda</p>

      <form method="POST" action="api/login.php">
          <label>Username</label>
          <input class="input" name="username" required>

          <label>Password</label>
          <input class="input" type="password" name="password" required>

          <button class="btn-login" type="submit">Masuk</button>
      </form>
  </div>
</div>

</body>
</html>
