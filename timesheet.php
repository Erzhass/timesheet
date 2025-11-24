<?php
session_start();
if(!isset($_SESSION['user'])) header('Location: index.php');
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Timesheet</title>

<!-- Font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
/* ================= GLOBAL ================= */
body {
    margin: 0;
    font-family: 'Inter', sans-serif;
    background: #eef3fa;
}

/* ================= SIDEBAR ================= */
#sidebar {
    position: fixed;
    left: 0;
    top: 0;
    width: 240px;
    height: 100vh;
    background: #1e40af;
    color: white;
    padding: 20px;
}

#sidebar h2 {
    font-size: 20px;
    line-height: 24px;
    margin-bottom: 25px;
}

#sidebar a {
    display: block;
    padding: 10px 14px;
    background: rgba(255,255,255,0.12);
    margin-bottom: 8px;
    border-radius: 6px;
    text-decoration: none;
    color: white;
    transition: 0.2s;
}

#sidebar a:hover {
    background: rgba(255,255,255,0.22);
}

.logout {
    background: #e63946 !important;
}

/* ================= CONTENT ================= */
#content {
    margin-left: 260px;
    padding: 30px;
}

#content h1 {
    margin-top: 0;
    color: #1e3a8a;
}

/* ================= FORM CARD ================= */
#frm {
    background: white;
    padding: 20px;
    border-radius: 12px;
    width: fit-content;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    margin-bottom: 25px;
}

#frm input {
    padding: 8px 10px;
    margin-right: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

.button {
    background: #1e40af;
    color: white;
    border: none;
    padding: 10px 16px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
}

.button:hover {
    background: #15348c;
}

/* ================= GROUP HEADER ================= */
.month-header {
    margin-top: 25px;
    font-size: 20px;
    color: #1e3a8a;
    font-weight: 700;
}

/* ================= TIMESHEET CARDS ================= */
.ts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 18px;
    margin-top: 10px;
}

.ts-card {
    background: white;
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.06);
    border-left: 8px solid #1e40af;
    transition: 0.2s;
}

.ts-card:hover {
    transform: translateY(-3px);
}

.ts-color {
    width: 100%;
    height: 6px;
    border-radius: 6px;
    margin-bottom: 10px;
}

.ts-title {
    font-weight: 700;
    margin-bottom: 4px;
}
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
  <h1>Timesheet</h1>

  <!-- FORM TAMBAH -->
  <form id="frm">
    <input name="tanggal" type="date" required>
    <input name="kode" placeholder="Kode" required>
    <input name="jam" type="number" placeholder="Jam" required>
    <input name="kegiatan" placeholder="Kegiatan" required>
    <button type="submit" class="button">Tambah</button>
  </form>

  <div id="groups"></div>
</div>

<script>
let woData = [];

async function loadLookup(){
  woData = await fetch("db/tasks.json").then(r=>r.json());
}

function getWarna(kode){
  const f = woData.find(a => a.kode == kode);
  return f ? f.warna : "#1e40af";
}

async function load(){
  await loadLookup();
  const data = await fetch('db/timesheet.json').then(r=>r.json());

  const groups = {};
  data.forEach(i=>{
    const d = new Date(i.tanggal);
    const key = d.getFullYear()+'-'+(d.getMonth()+1);
    groups[key] = groups[key] || [];
    groups[key].push(i);
  });

  const container = document.getElementById('groups');
  container.innerHTML='';

  for(const k in groups){
    const parts = k.split('-'); 
    const y = parts[0], m = parts[1];

    container.innerHTML += `<h3 style="margin-top:25px">${m}/${y}</h3>`;

    groups[k].forEach(it=>{
      const warna = getWarna(it.kode);

      const card=document.createElement('div'); 
      card.className='card';
      card.style.borderLeft = `6px solid ${warna}`;

      card.innerHTML = `
        <b>${it.tanggal}</b><br>
        Kode: ${it.kode} | Jam: ${it.jam}<br>
        ${it.kegiatan}
      `;

      container.appendChild(card);
    });
  }
}
    </script>

</body>
</html>
