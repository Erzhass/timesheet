<?php
session_start();
if(!isset($_SESSION['user'])) header('Location: index.php');
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Dashboard - Timesheet PKL Nganjuk</title>

<!-- FONT -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
/* ================= GLOBAL ================= */
body{
    margin:0;
    background:#000000; /* Changed to black */
    font-family:'Inter',sans-serif;
    color:#FFD700; /* Gold text for contrast */
}

/* ================= SIDEBAR ================= */
.sidebar{
    position:fixed;
    top:0;
    left:0;
    width:240px;
    height:100vh;
    background:#1a1a1a; /* Dark black */
    padding:20px;
    color:#FFD700; /* Gold text */
    border-right: 2px solid #FFD700; /* Gold accent */
}

.logo{
    font-size:22px;
    margin-bottom:25px;
    font-weight:700;
    line-height:1.3;
    color:#FFD700; /* Gold */
}

.nav-item{
    display:block;
    padding:10px 14px;
    border-radius:6px;
    background:#333333; /* Dark gray */
    margin-bottom:10px;
    color:#FFD700; /* Gold */
    text-decoration:none;
    transition:0.2s;
    border: 1px solid #FFD700; /* Gold border */
}

.nav-item:hover{
    background:#FFD700; /* Gold on hover */
    color:#000000; /* Black text on hover */
}

.logout-btn{
    display:block;
    padding:10px 14px;
    border-radius:6px;
    margin-top:20px;
    background:#FFD700; /* Gold */
    color:#000000; /* Black text */
    text-decoration:none;
    border: 1px solid #FFD700;
}

/* ================= CONTENT ================= */
.content{
    margin-left:260px;
    padding:30px;
    background:#000000; /* Black */
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.header h1{
    margin:0;
    color:#FFD700; /* Gold */
    font-size:28px;
}

.btn-export{
    background:#FFD700; /* Gold */
    color:#000000; /* Black text */
    padding:10px 18px;
    border-radius:8px;
    border: 2px solid #FFD700;
    font-weight:600;
    cursor:pointer;
}
.btn-export:hover{
    background:#D4AF37; /* Darker gold */
}

/* ================= CARD FOTO ================= */
.welcome-card{
    background:#1a1a1a; /* Dark black */
    border-radius:12px;
    padding:25px;
    box-shadow:0 4px 12px rgba(255,215,0,0.3); /* Gold shadow */
    max-width:500px;
    text-align:center;
    border: 2px solid #FFD700; /* Gold border */
}

.photo-box{
    width:200px;
    height:200px;
    margin:auto;
    background:#000000; /* Black */
    border-radius:12px;
    display:flex;
    justify-content:center;
    align-items:center;
    font-weight:600;
    color:#FFD700; /* Gold */
    border:3px solid #FFD700; /* Gold border */
    margin-bottom:20px;
}

.thanks-text{
    font-weight:600;
    color:#FFD700; /* Gold */
    line-height:1.4;
}
</style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2 class="logo">Timesheet<br>PKL Nganjuk</h2>

    <a class="nav-item" href="dashboard.php">Dashboard</a>
    <a class="nav-item" href="workorder.php">Work Order</a>
    <a class="nav-item" href="timesheet.php">Timesheet</a>
    <a class="nav-item" href="assets.php">Assets</a>

    <?php if($_SESSION['role']==='admin'){ ?>
        <a class="nav-item" href="add_user.php">Tambah User</a>
    <?php } ?>

    <a class="logout-btn" href="api/logout.php">Logout</a>
</div>

<!-- CONTENT -->
<div class="content">

    <div class="header">
        <h1>Dashboard</h1>
        <form action="api/export.php" method="get">
            <button class="btn-export">Export Excel</button>
        </form>
    </div>

    <div class="welcome-card">
        <div class="photo-box">
             <img src="foto.jpg" alt="Foto" class="photo">
        </div>

        <h3 class="thanks-text">
            Terima kasih kepada MAS IFFAN<br>
            Pembimbing Magang saya di PAL
        </h3>
    </div>

</div>

</body>
</html>