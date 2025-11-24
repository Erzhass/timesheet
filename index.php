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
    background: #e8eef7;
}

/* ====== LOGIN CONTAINER ====== */
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    padding: 15px;
}

/* ====== LOGIN BOX ====== */
.login-box {
    background: white;
    width: 100%;
    max-width: 360px;
    padding: 35px;
    border-radius: 14px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.12);
    text-align: center;
}

.login-box h2 {
    margin: 0;
    font-size: 24px;
    color: #1e40af;
    font-weight: 700;
}

.subtitle {
    margin-top: 5px;
    font-size: 14px;
    color: #5f6b82;
}

/* ====== INPUT ====== */
label {
    display: block;
    text-align: left;
    margin-top: 18px;
    font-size: 14px;
    color: #374151;
}

.input {
    width: 100%;
    margin-top: 6px;
    padding: 11px 12px;
    font-size: 14px;
    border-radius: 8px;
    border: 1px solid #cbd5e1;
    outline: none;
    transition: .2s;
}

.input:focus {
    border-color: #1e40af;
    box-shadow: 0 0 0 2px #93c5fd;
}

/* ====== LOGIN BUTTON ====== */
.btn-login {
    width: 100%;
    margin-top: 25px;
    padding: 12px;
    background: #1e40af;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 15px;
    font-weight: 600;
    transition: .2s;
}

.btn-login:hover {
    background: #15348c;
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
