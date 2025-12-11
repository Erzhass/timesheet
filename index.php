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

<!-- ICONS (untuk ikon pada input) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
/* ====== GLOBAL ====== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    position: relative;
}

body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="50" cy="50" r="1" fill="%23ffffff" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    pointer-events: none;
}

/* ====== LOGIN CONTAINER ====== */
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100vh;
    padding: 20px;
    position: relative;
    z-index: 1;
}

/* ====== LOGIN BOX ====== */
.login-box {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    width: 100%;
    max-width: 400px;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.2);
    animation: fadeInUp 0.8s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.login-box h2 {
    margin-bottom: 10px;
    font-size: 28px;
    color: #2d3748;
    font-weight: 700;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.subtitle {
    margin-bottom: 30px;
    font-size: 16px;
    color: #718096;
    font-weight: 400;
}

/* ====== INPUT ====== */
.input-group {
    position: relative;
    margin-bottom: 20px;
}

.input-group i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #a0aec0;
    font-size: 18px;
}

.input {
    width: 100%;
    padding: 15px 15px 15px 45px;
    font-size: 16px;
    border-radius: 12px;
    border: 2px solid #e2e8f0;
    outline: none;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.8);
    font-weight: 400;
}

.input:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    background: rgba(255, 255, 255, 1);
}

.input::placeholder {
    color: #cbd5e0;
}

/* ====== LOGIN BUTTON ====== */
.btn-login {
    width: 100%;
    margin-top: 30px;
    padding: 15px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
}

.btn-login:active {
    transform: translateY(0);
}

/* ====== RESPONSIVE ====== */
@media (max-width: 480px) {
    .login-box {
        padding: 30px 20px;
        max-width: 90%;
    }
    
    .login-box h2 {
        font-size: 24px;
    }
    
    .subtitle {
        font-size: 14px;
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
          <div class="input-group">
              <i class="fas fa-user"></i>
              <input class="input" name="username" placeholder="Username" required>
          </div>

          <div class="input-group">
              <i class="fas fa-lock"></i>
              <input class="input" type="password" name="password" placeholder="Password" required>
          </div>

          <button class="btn-login" type="submit">Masuk</button>
      </form>
  </div>
</div>

</body>
</html>
