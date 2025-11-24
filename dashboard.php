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
    background:#eef3fa;
    font-family:'Inter',sans-serif;
}

/* ================= SIDEBAR ================= */
.sidebar{
    position:fixed;
    top:0;
    left:0;
    width:240px;
    height:100vh;
    background:#1e40af;
    padding:20px;
    color:white;
}

.logo{
    font-size:22px;
    margin-bottom:25px;
    font-weight:700;
    line-height:1.3;
}

.nav-item{
    display:block;
    padding:10px 14px;
    border-radius:6px;
    background:rgba(255,255,255,0.10);
    margin-bottom:10px;
    color:white;
    text-decoration:none;
    transition:0.2s;
}

.nav-item:hover{
    background:rgba(255,255,255,0.20);
}

.logout-btn{
    display:block;
    padding:10px 14px;
    border-radius:6px;
    margin-top:20px;
    background:#e63946;
    color:white;
    text-decoration:none;
}

/* ================= CONTENT ================= */
.content{
    margin-left:260px;
    padding:30px;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.header h1{
    margin:0;
    color:#1e3a8a;
    font-size:28px;
}

.btn-export{
    background:#1e40af;
    color:white;
    padding:10px 18px;
    border-radius:8px;
    border:none;
    font-weight:600;
    cursor:pointer;
}
.btn-export:hover{
    background:#15348c;
}

/* ================= CARD FOTO ================= */
.welcome-card{
    background:white;
    border-radius:12px;
    padding:25px;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
    max-width:500px;
    text-align:center;
}

.photo-box{
    width:200px;
    height:200px;
    margin:auto;
    background:white;
    border-radius:12px;
    display:flex;
    justify-content:center;
    align-items:center;
    font-weight:600;
    color:#1e3a8a;
    border:3px solid #1e40af;
    margin-bottom:20px;
}

.thanks-text{
    font-weight:600;
    color:#1e3a8a;
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
