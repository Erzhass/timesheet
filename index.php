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
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
/* ====== GLOBAL ====== */
body {
    margin: 0;
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #2d3748;
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
    background: #ffffff;
    width: 100%;
    max-width: 420px;
    padding: 50px 40px;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    text-align: center;
    border: 1px solid #e2e8f0;
    transition: box-shadow 0.3s ease;
}

.login-box:hover {
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
}

.login-box h2 {
    margin: 0 0 8px 0;
    font-size: 32px;
    color: #1a202c;
    font-weight: 700;
    letter-spacing: -0.5px;
}

.subtitle {
    margin: 0 0 32px 0;
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
    font-weight: 500;
}

.input {
    width: 100%;
    margin-top: 8px;
    padding: 16px 18px;
    font-size: 16px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    outline: none;
    transition: all 0.2s ease;
    background: #f9fafb;
    color: #1a202c;
}

.input:focus {
    border-color: #4c51bf;
    box-shadow: 0 0 0 3px rgba(76, 81, 191, 0.1);
    background: #ffffff;
}

/* ====== LOGIN BUTTON ====== */
.btn-login {
    width: 100%;
    margin-top: 32px;
    padding: 16px;
    background: #4c51bf;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(76, 81, 191, 0.3);
}

.btn-login:hover {
    background: #434190;
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(76, 81, 191, 0.4);
}

.btn-login:active {
    transform: translateY(0);
}

/* Responsive adjustments */
@media (max-width: 480px) {
    .login-box {
        padding: 40px 30px;
        max-width: 90%;
    }
    .login-box h2 {
        font-size: 28px;
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