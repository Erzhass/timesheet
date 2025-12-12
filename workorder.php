<?php
session_start();
if(!isset($_SESSION['user'])) header('Location: index.php');
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Work Order</title>

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
    --modal-bg: #1a1a1a; /* Dark modal */
    --modal-border: #FFD700; /* Gold border */
    --input-bg: #333333; /* Dark input */
    --input-border: #FFD700; /* Gold border */
    --btn-bg: #FFD700; /* Gold button */
    --btn-text: #000000; /* Black text */
    --btn-hover: #D4AF37; /* Darker gold */
    --shadow: rgba(255,215,0,0.3); /* Gold shadow */
    --header-color: #FFD700; /* Gold header */
    --menu-bg: #1a1a1a; /* Dark menu */
    --menu-hover: #FFD700; /* Gold hover */
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
    --modal-bg: #ffffff; /* White modal */
    --modal-border: #1e40af; /* Blue border */
    --input-bg: #ffffff; /* White input */
    --input-border: #ccc; /* Gray border */
    --btn-bg: #1e40af; /* Blue button */
    --btn-text: #ffffff; /* White text */
    --btn-hover: #15348c; /* Darker blue */
    --shadow: rgba(0,0,0,0.08); /* Subtle shadow */
    --header-color: #1e3a8a; /* Blue header */
    --menu-bg: #ffffff; /* White menu */
    --menu-hover: #eaf1ff; /* Light blue hover */
}

/* GLOBAL */
body {
    margin: 0;
    background: var(--bg-color);
    font-family: 'Inter', sans-serif;
    color: var(--text-color);
    transition: background 0.3s, color 0.3s;
}

/* SIDEBAR */
#sidebar {
    position: fixed;
    width: 240px;
    height: 100vh;
    background: var(--sidebar-bg);
    color: var(--text-color);
    padding: 20px;
    border-right: 2px solid var(--card-border);
    transition: background 0.3s, color 0.3s;
}

#sidebar h2 {
    font-size: 20px;
    margin-bottom: 25px;
    color: var(--text-color);
}

#sidebar a {
    display: block;
    padding: 10px 14px;
    border-radius: 6px;
    margin-bottom: 8px;
    text-decoration: none;
    color: var(--text-color);
    background: var(--nav-bg);
    border: 1px solid var(--card-border);
    transition: 0.2s;
}
#sidebar a:hover { background: var(--nav-hover-bg); color: var(--nav-hover-text); }

.logout { background: var(--logout-bg) !important; color: var(--logout-text) !important; }

/* CONTENT */
#content {
    margin-left:260px;
    padding:30px;
    background: var(--bg-color);
    transition: background 0.3s;
}
#content h1 {
    margin: 0;
    color: var(--header-color);
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

/* CARD GRID */
.wo-grid {
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(260px,1fr));
    gap:20px;
    margin-top:20px;
}

/* CARD */
.wo-card {
    border-radius:12px;
    padding:18px;
    background: var(--card-bg);
    position:relative;
    box-shadow:0 4px 12px var(--shadow);
    border: 1px solid var(--card-border);
    transition:.2s, background 0.3s, box-shadow 0.3s;
}
.wo-card:hover { transform:translateY(-3px); }

.wo-color {
    height:12px;
    width:100%;
    border-radius:6px;
    margin-bottom:10px;
}

/* TITIK TIGA */
.wo-menu {
    position:absolute;
    right:12px; top:12px;
    cursor:pointer;
    font-size:20px;
    color: var(--text-color);
}
.menu-box {
    display:none;
    position:absolute;
    top:40px; right:10px;
    background: var(--menu-bg);
    box-shadow:0 2px 8px var(--shadow);
    border-radius:8px;
    padding:8px;
    z-index:50;
    border: 1px solid var(--card-border);
}
.menu-box button{
    width:100%;
    background:none;
    border:none;
    padding:8px;
    text-align:left;
    cursor:pointer;
    color: var(--text-color);
    transition: background 0.3s;
}
.menu-box button:hover{ background: var(--menu-hover); }

/* MODAL */
#modal-bg {
    display:none;
    position:fixed;
    top:0; left:0;
    width:100%; height:100%;
    background:rgba(0,0,0,0.4);
    justify-content:center;
    align-items:center;
    z-index:999;
}

#modal-box {
    width:360px;
    background: var(--modal-bg);
    border-radius:10px;
    padding:20px;
    box-shadow:0 4px 14px var(--shadow);
    border: 2px solid var(--modal-border);
    transition: background 0.3s, box-shadow 0.3s;
}

.modal-input {
    width:100%;
    padding:10px;
    margin-bottom:12px;
    border-radius:8px;
    border:1px solid var(--input-border);
    background: var(--input-bg);
    color: var(--text-color);
    transition: background 0.3s, color 0.3s, border-color 0.3s;
}

.modal-btn {
    background: var(--btn-bg);
    color: var(--btn-text);
    border:none;
    padding:10px 16px;
    border-radius:8px;
    cursor:pointer;
    transition: background 0.3s;
}
.modal-btn:hover{ background: var(--btn-hover); }

</style>
</head>

<body>

<!-- SIDEBAR -->
<div id="sidebar">
  <h2>Timesheet PKL<br>Nganjuk</h2>
  <a href="dashboard.php">Dashboard</a>
  <a href="workorder.php">Work Order</a>
  <a href="timesheet.php">Timesheet</a>
  <a href="assets.php">Assets</a>
  <?php if($_SESSION['role']==='admin'){ echo '<a href="add_user.php">Tambah User</a>'; } ?>
  <a class="logout" href="api/logout.php">Logout</a>
</div>

<!-- CONTENT -->
<div id="content">
  <div style="display:flex; justify-content:space-between; align-items:center;">
    <h1>Work Order</h1>
    <button class="theme-toggle" id="theme-toggle">Toggle Mode</button>
  </div>
  <div class="wo-grid" id="cards"></div>
</div>

<!-- MODAL FOR EDIT -->
<div id="modal-bg">
    <div id="modal-box">
        <h3 style="color: var(--text-color);">Edit Work Order</h3>
        <input type="hidden" id="edit-kode">
        <label style="color: var(--text-color);">Nama Work Order</label>
        <input class="modal-input" id="edit-nama">

        <label style="color: var(--text-color);">Batas Jam</label>
        <input class="modal-input" id="edit-batas" type="number">

        <button class="modal-btn" onclick="saveEdit()">Simpan</button>
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

/* LOAD CARD */
async function load(){
    const data = await fetch("db/tasks.json").then(r=>r.json());
    const wrap = document.getElementById("cards");
    wrap.innerHTML="";

    data.forEach(t=>{
        let card = document.createElement("div");
        card.className = "wo-card";

        card.innerHTML = `
            <div class="wo-color" style="background:${t.warna}"></div>

            <div class="wo-menu" onclick="toggleMenu(${t.kode})">⋮</div>

            <div class="menu-box" id="menu${t.kode}">
                <button onclick="openModal(${t.kode}, '${t.nama}', ${t.batas_jam})">Edit</button>
            </div>

            <h3 style="color: var(--text-color);">${t.nama}</h3>
            <p style="color: var(--text-color);"><b>Kode:</b> ${t.kode}</p>
            <p style="color: var(--text-color);"><b>Batas Jam:</b> ${t.batas_jam}</p>
            <p style="color: var(--text-color);"><b>Terpakai:</b> ${t.terpakai}</p>
        `;

        wrap.appendChild(card);
    });
}

/* MENU TITIK TIGA */
function toggleMenu(k){
    document.querySelectorAll(".menu-box").forEach(m=>m.style.display="none");
    let box = document.getElementById("menu"+k);
    box.style.display = box.style.display === "block" ? "none" : "block";
}

/* OPEN MODAL */
function openModal(k, nama, batas){
    document.getElementById("edit-kode").value = k;
    document.getElementById("edit-nama").value = nama;
    document.getElementById("edit-batas").value = batas;

    document.getElementById("modal-bg").style.display = "flex";
}

/* SAVE EDIT */
async function saveEdit(){
    let kode = document.getElementById("edit-kode").value;
    let nama = document.getElementById("edit-nama").value;
    let batas = document.getElementById("edit-batas").value;

    await fetch("api/tasks.php", {
        method:"POST",
        headers:{ "Content-Type": "application/json" },
        body:JSON.stringify({
            kode: Number(kode),
            nama: nama,
            batas_jam: Number(batas)
        })
    });

    document.getElementById("modal-bg").style.display="none";
    load();
}

load();
</script>

</body>
</html>
