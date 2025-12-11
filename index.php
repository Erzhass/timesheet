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
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
    background: #000000;
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
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="batik" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse"><rect width="100" height="100" fill="%23000000"/><g fill="%23FFD700" opacity="0.4"><path d="M50 20 Q60 10 70 20 Q80 30 70 40 Q60 50 50 40 Q40 30 50 20 Z"/><path d="M20 50 Q10 60 20 70 Q30 80 40 70 Q50 60 40 50 Q30 40 20 50 Z"/><path d="M80 50 Q90 60 80 70 Q70 80 60 70 Q50 60 60 50 Q70 40 80 50 Z"/><path d="M50 80 Q60 90 70 80 Q80 70 70 60 Q60 50 50 60 Q40 70 50 80 Z"/><circle cx="50" cy="50" r="3" fill="%23FFD700" opacity="0.6"/><path d="M25 25 L75 25 M25 75 L75 75 M50 0 L50 100" stroke="%23FFD700" stroke-width="0.5" opacity="0.3"/></g></pattern></defs><rect width="100%" height="100%" fill="url(%23batik)"/></svg>');
    pointer-events: none;
    opacity: 0.8;
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
    background: rgba(0, 0, 0, 0.9);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    width: 100%;
    max-width: 400px;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5), 0 0 0 2px #FFD700;
    text-align: center;
    border: 1px solid rgba(255, 215, 0, 0.3);
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
    color: #FFD700;
    font-weight: 700;
    font-family: 'Cinzel', serif;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

.subtitle {
    margin-bottom: 30px;
    font-size: 16px;
    color: #D4AF37;
    font-weight: 400;
    font-family: 'Inter', sans-serif;
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
    color: #FFD700;
    font-size: 18px;
    opacity: 0.7;
}

.input {
    width: 100%;
    padding: 15px 15px 15px 45px;
    font-size: 16px;
    border-radius: 12px;
    border: 2px solid #333;
    outline: none;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.05);
    color: #FFD700;
    font-weight: 400;
    font-family: 'Inter', sans-serif;
}

.input:focus {
    border-color: #FFD700;
    box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.2);
    background: rgba(255, 255, 255, 0.1);
}

.input::placeholder {
    color: #B8860B;
}

/* ====== LOGIN BUTTON ====== */
.btn-login {
    width: 100%;
    margin-top: 30px;
    padding: 15px;
    background: linear-gradient(135deg, #000000, #FFD700);
    color: #FFD700;
    border: 2px solid #FFD700;
    border-radius: 12px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    font-family: 'Cinzel', serif;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.5);
    background: linear-gradient(135deg, #FFD700, #000000);
    color: #000000;
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