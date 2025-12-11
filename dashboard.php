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
/* ================= CSS VARIABLES FOR THEMES ================= */
:root {
    --bg-color: #000000; /* Dark background */
    --sidebar-bg: #1a1a1a; /* Dark sidebar */
    --text-color: #FFD700; /* Gold text */
    --nav-bg: #333333; /* Dark nav */
    --nav-hover-bg: #FFD700; /* Gold hover */
    --nav-hover-text: #000000; /* Black text on hover */
    --logout-bg: #FFD700; /* Gold logout */
    --logout-text: #000000; /* Black text */
    --card-bg: #1a1a1a; /* Dark card */
    --card-border: #FFD700; /* Gold border */
    --photo-bg: #000000; /* Black photo box */
    --photo-border: #FFD700; /* Gold border */
    --btn-bg: #FFD700; /* Gold button */
    --btn-text: #000000; /* Black text */
    --btn-hover: #D4AF37; /* Darker gold */
    --shadow: rgba(255,215,0,0.3); /* Gold shadow */
}

/* Light mode overrides */
body.light-mode {
    --bg-color: #f8f9fa; /* Light gray background */
    --sidebar-bg: #ffffff; /* White sidebar */
    --text-color: #1e3a8a; /* Dark blue text */
    --nav-bg: #e9ecef; /* Light gray nav */
    --nav-hover-bg: #1e40af; /* Blue hover */
    --nav-hover-text: #ffffff; /* White text on hover */
    --logout-bg: #e63946; /* Red logout */
    --logout-text: #ffffff; /* White text */
    --card-bg: #ffffff; /* White card */
    --card-border: #1e40af; /* Blue border */
    --photo-bg: #f8f9fa; /* Light photo box */
    --photo-border: #1e40af; /* Blue border */
    --btn-bg: #1e40af; /* Blue button */
    --btn-text: #ffffff; /* White text */
    --btn-hover: #15348c; /* Darker blue */
    --shadow: rgba(0,0,0,0.08); /* Subtle shadow */
}

/* ================= GLOBAL ================= */
body{
    margin:0;
    background: var(--bg-color);
    font-family:'Inter',sans-serif;
    color: var(--text-color);
    transition: background 0.3s, color 0.3s;
}

/* ================= SIDEBAR ================= */
.sidebar{
    position:fixed;
    top:0;
    left:0;
    width:240px;
    height:100vh;
    background: var(--sidebar-bg);
    padding:20px;
    color: var(--text-color);
    border-right: 2px solid var(--card-border);
    transition: background 0.3s, color 0.3s;
}

.logo{
    font-size:22px;
    margin-bottom:25px;
    font-weight:700;
    line-height:1.3;
    color: var(--text-color);
}

.nav-item{
    display:block;
    padding:10px 14px;
    border-radius:6px;
    background: var(--nav-bg);
    margin-bottom:10px;
    color: var(--text-color);
    text-decoration:none;
    transition:0.2s;
    border: 1px solid var(--card-border);
}

.nav-item:hover{
    background: var(--nav-hover-bg);
    color: var(--nav-hover-text);
}

.logout-btn{
    display:block;
    padding:10px 14px;
    border-radius:6px;
    margin-top:20px;
    background: var(--logout-bg);
    color: var(--logout-text);
    text-decoration:none;
    border: 1px solid var(--logout-bg);
}

/* ================= CONTENT ================= */
.content{
    margin-left:260px;
    padding:30px;
    background: var(--bg-color);
    transition: background 0.3s;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.header h1{
    margin:0;
    color: var(--text-color);
    font-size:28px;
}

.btn-export{
    background: var(--btn-bg);
    color: var(--btn-text);
    padding:10px 18px;
    border-radius:8px;
    border: 2px solid var(--btn-bg);
    font-weight:600;
    cursor:pointer;
    transition: background 0.3s;
}
.btn-export:hover{
    background: var(--btn-hover);
}

/* Toggle button */
.theme-toggle{
    background: var(--btn-bg);
    color: var(--btn-text);
    padding:10px 18px;
    border-radius:8px;
    border: 2px solid var(--btn-bg);
    font-weight:600;
    cursor:pointer;
    margin-left:10px;
    transition: background 0.3s;
}
.theme-toggle:hover{
    background: var(--btn-hover);
}

/* ================= CARD FOTO ================= */
.welcome-card{
    background: var(--card-bg);
    border-radius:12px;
    padding:25px;
    box-shadow:0 4px 12px var(--shadow);
    max-width:500px;
    text-align:center;
    border: 2px solid var(--card-border);
    transition: background 0.3s, box-shadow 0.3s;
}

.photo-box{
    width:200px;
    height:200px;
    margin:auto;
    background: var(--photo-bg);
    border-radius:12px;
    display:flex;
    justify-content:center;
    align-items:center;
    font-weight:600;
    color: var(--text-color);
    border:3px solid var(--photo-border);
    margin-bottom:20px;
    transition: background 0.3s, border-color 0.3s;
}

.thanks-text{
    font-weight:600;
    color: var(--text-color);
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
        <div>
            <button class="theme-toggle" id="theme-toggle">Toggle Mode</button>
            <form action="api/export.php" method="get" style="display:inline;">
                <button class="btn-export">Export Excel</button>
            </form>
        </div>
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

<script>
// JavaScript for theme toggle
const toggleButton = document.getElementById('theme-toggle');
const body = document.body;

// Load saved theme from localStorage
const savedTheme = localStorage.getItem('theme');
if (savedTheme) {
    body.classList.add(savedTheme);
    updateButtonText();
}

// Toggle theme on button click
toggleButton.addEventListener('click', () => {
    body.classList.toggle('light-mode');
    const currentTheme = body.classList.contains('light-mode') ? 'light-mode' : '';
    localStorage.setItem('theme', currentTheme);
    updateButtonText();
});

// Update button text based on current theme
function updateButtonText() {
    if (body.classList.contains('light-mode')) {
        toggleButton.textContent = 'Dark Mode';
    } else {
        toggleButton.textContent = 'Light Mode';
    }
}

// Initial button text
updateButtonText();
</script>

</body>
</html>
