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
/* GLOBAL */
body {
    margin: 0;
    background: #eef3fa;
    font-family: 'Inter', sans-serif;
}

/* SIDEBAR */
#sidebar {
    position: fixed;
    width: 240px;
    height: 100vh;
    background: #1e40af;
    color: white;
    padding: 20px;
}

#sidebar h2 {
    font-size: 20px;
    margin-bottom: 25px;
}

#sidebar a {
    display: block;
    padding: 10px 14px;
    border-radius: 6px;
    margin-bottom: 8px;
    text-decoration: none;
    color: white;
    background: rgba(255,255,255,0.12);
}
#sidebar a:hover { background: rgba(255,255,255,0.22); }

.logout { background:#e63946 !important; }

/* CONTENT */
#content {
    margin-left:260px;
    padding:30px;
}
#content h1 {
    margin: 0;
    color: #1e3a8a;
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
    background:white;
    position:relative;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
    transition:.2s;
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
}
.menu-box {
    display:none;
    position:absolute;
    top:40px; right:10px;
    background:white;
    box-shadow:0 2px 8px rgba(0,0,0,0.15);
    border-radius:8px;
    padding:8px;
    z-index:50;
}
.menu-box button{
    width:100%;
    background:none;
    border:none;
    padding:8px;
    text-align:left;
    cursor:pointer;
}
.menu-box button:hover{ background:#eaf1ff; }

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
    background:white;
    border-radius:10px;
    padding:20px;
    box-shadow:0 4px 14px rgba(0,0,0,0.2);
}

.modal-input {
    width:100%;
    padding:10px;
    margin-bottom:12px;
    border-radius:8px;
    border:1px solid #bbb;
}

.modal-btn {
    background:#1e40af;
    color:white;
    border:none;
    padding:10px 16px;
    border-radius:8px;
    cursor:pointer;
}
.modal-btn:hover{ background:#16338d; }

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
  <h1>Work Order</h1>
  <div class="wo-grid" id="cards"></div>
</div>

<!-- MODAL FOR EDIT -->
<div id="modal-bg">
    <div id="modal-box">
        <h3>Edit Work Order</h3>
        <input type="hidden" id="edit-kode">
        <label>Nama Work Order</label>
        <input class="modal-input" id="edit-nama">

        <label>Batas Jam</label>
        <input class="modal-input" id="edit-batas" type="number">

        <button class="modal-btn" onclick="saveEdit()">Simpan</button>
    </div>
</div>

<script>
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

            <h3>${t.nama}</h3>
            <p><b>Kode:</b> ${t.kode}</p>
            <p><b>Batas Jam:</b> ${t.batas_jam}</p>
            <p><b>Terpakai:</b> ${t.terpakai}</p>
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
