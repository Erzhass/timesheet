<?php
session_start();
if(!isset($_SESSION['user'])) header('Location: index.php');
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Assets</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
/* ================= GLOBAL ================= */
body{
    margin:0;
    font-family:'Inter',sans-serif;
    background:#eef3fa;
}

/* ================= SIDEBAR ================= */
#sidebar{
    position:fixed;
    left:0;
    top:0;
    width:240px;
    height:100vh;
    background:#1e40af;
    color:white;
    padding:20px;
}

#sidebar h2{
    font-size:20px;
    line-height:24px;
    margin-bottom:25px;
}

#sidebar a{
    display:block;
    padding:10px 14px;
    background:rgba(255,255,255,0.12);
    margin-bottom:8px;
    border-radius:6px;
    text-decoration:none;
    color:white;
    transition:0.2s;
}

#sidebar a:hover{
    background:rgba(255,255,255,0.22);
}

.logout{
    background:#e63946!important;
}

/* ================= CONTENT ================= */
#content{
    margin-left:260px;
    padding:30px;
}

#content h1{
    color:#1e3a8a;
    margin-top:0;
}

/* ================= FORM CARD ================= */
#afrm{
    background:white;
    padding:18px;
    border-radius:12px;
    width:fit-content;
    box-shadow:0 3px 10px rgba(0,0,0,0.08);
    margin-bottom:25px;
}

#afrm input{
    padding:8px 10px;
    margin-right:10px;
    border-radius:6px;
    border:1px solid #ccc;
}

.button{
    background:#1e40af;
    color:white;
    border:none;
    padding:10px 16px;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
}

.button:hover{
    background:#15348c;
}

/* ================= TABLE ================= */
table{
    width:100%;
    border-collapse:separate;
    border-spacing:0 8px;
}

thead th{
    background:#1e3a8a;
    color:white;
    padding:12px;
    font-weight:600;
}

tbody tr{
    background:white;
    box-shadow:0 2px 6px rgba(0,0,0,0.06);
}

tbody td{
    padding:12px;
    border-bottom:1px solid #e5e7eb;
}

tbody tr:hover{
    background:#f0f4ff;
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

  <h1>Assets</h1>

  <!-- FORM TAMBAH -->
  <form id="afrm">
    <input name="tanggal" type="date" required>
    <input name="nama" placeholder="Nama" required>
    <input name="alokasi" placeholder="Alokasi" required>
    <input name="keterangan" placeholder="Keterangan">
    <button type="submit" class="button">Tambah</button>
  </form>

  <!-- TABEL ASSET -->
  <table>
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Nama</th>
        <th>Alokasi</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody id="atable"></tbody>
  </table>

</div>

<script>
async function loadAssets(){
  const data = await fetch('db/assets.json').then(r=>r.json());
  const tbody = document.getElementById('atable');
  tbody.innerHTML = '';

  data.forEach(a=>{
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>${a.tanggal}</td>
      <td>${a.nama}</td>
      <td>${a.alokasi}</td>
      <td>${a.keterangan}</td>
    `;
    tbody.appendChild(tr);
  });
}

document.getElementById('afrm').addEventListener('submit', async e=>{
  e.preventDefault();
  const f = new FormData(e.target);

  const body = {
    tanggal: f.get('tanggal'),
    nama: f.get('nama'),
    alokasi: f.get('alokasi'),
    keterangan: f.get('keterangan')
  };

  await fetch('api/assets.php',{
    method:'POST',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify(body)
  });

  loadAssets();
});

loadAssets();
</script>

</body>
</html>
