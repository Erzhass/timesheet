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
    --form-bg: #1a1a1a; /* Dark form */
    --input-bg: #333333; /* Dark input */
    --input-border: #FFD700; /* Gold border */
    --btn-bg: #FFD700; /* Gold button */
    --btn-text: #000000; /* Black text */
    --btn-hover: #D4AF37; /* Darker gold */
    --shadow: rgba(255,215,0,0.3); /* Gold shadow */
    --header-color: #FFD700; /* Gold header */
    --btn-delete-bg: #FFD700; /* Gold delete */
    --btn-delete-text: #000000; /* Black text */
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
    --form-bg: #ffffff; /* White form */
    --input-bg: #ffffff; /* White input */
    --input-border: #ccc; /* Gray border */
    --btn-bg: #1e40af; /* Blue button */
    --btn-text: #ffffff; /* White text */
    --btn-hover: #15348c; /* Darker blue */
    --shadow: rgba(0,0,0,0.08); /* Subtle shadow */
    --header-color: #1e3a8a; /* Blue header */
    --btn-delete-bg: #e63946; /* Red delete */
    --btn-delete-text: #ffffff; /* White text */
}

/* ================= GLOBAL ================= */
body {
    margin: 0;
    font-family: 'Inter', sans-serif;
    background: var(--bg-color);
    color: var(--text-color);
    transition: background 0.3s, color 0.3s;
}

/* ================= SIDEBAR ================= */
#sidebar {
    position: fixed;
    left: 0;
    top: 0;
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
    line-height: 24px;
    margin-bottom: 25px;
    color: var(--text-color);
}

#sidebar a {
    display: block;
    padding: 10px 14px;
    background: var(--nav-bg);
    margin-bottom: 8px;
    border-radius: 6px;
    text-decoration: none;
    color: var(--text-color);
    transition: 0.2s;
    border: 1px solid var(--card-border);
}

#sidebar a:hover {
    background: var(--nav-hover-bg);
    color: var(--nav-hover-text);
}

.logout {
    background: var(--logout-bg) !important;
    color: var(--logout-text) !important;
}

/* ================= CONTENT ================= */
#content {
    margin-left: 260px;
    padding: 30px;
    background: var(--bg-color);
    transition: background 0.3s;
}

#content h1 {
    margin-top: 0;
    color: var(--header-color);
}

/* ================= FORM CARD ================= */
#frm {
    background: var(--form-bg);
    padding: 20px;
    border-radius: 12px;
    width: fit-content;
    box-shadow: 0 3px 10px var(--shadow);
    margin-bottom: 25px;
    border: 2px solid var(--card-border);
    transition: background 0.3s, box-shadow 0.3s;
}

#frm input {
    padding: 8px 10px;
    margin-right: 10px;
    border-radius: 6px;
    border: 1px solid var(--input-border);
    background: var(--input-bg);
    color: var(--text-color);
    transition: background 0.3s, color 0.3s, border-color 0.3s;
}

.button {
    background: var(--btn-bg);
    color: var(--btn-text);
    border: none;
    padding: 10px 16px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.3s;
}

.button:hover {
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

/* ================= PREVIEW CARD ================= */
.preview-card {
    background: var(--card-bg);
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 3px 10px var(--shadow);
    margin-bottom: 25px;
    border: 2px solid var(--card-border);
    transition: background 0.3s, box-shadow 0.3s;
}

.preview-card h4 {
    margin: 0 0 10px 0;
    color: var(--text-color);
}

/* ================= GROUP HEADER ================= */
.month-header {
    margin-top: 25px;
    font-size: 20px;
    color: var(--header-color);
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
    background: var(--card-bg);
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 3px 10px var(--shadow);
    border-left: 8px solid var(--card-border);
    transition: 0.2s, background 0.3s, box-shadow 0.3s;
    position: relative; /* For delete button positioning */
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
    color: var(--text-color);
}

/* Delete button */
.btn-delete {
    position: absolute;
    right: 12px;
    top: 12px;
    padding: 4px 8px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 12px;
    background: var(--btn-delete-bg);
    color: var(--btn-delete-text);
    transition: background 0.3s;
}

.btn-delete:hover {
    background: var(--btn-hover);
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
  <div style="display:flex; justify-content:space-between; align-items:center;">
    <h1>Timesheet</h1>
    <button class="theme-toggle" id="theme-toggle">Toggle Mode</button>
  </div>

  <!-- FORM TAMBAH -->
  <form id="frm">
    <input name="tanggal" type="date" required>
    <input name="kode" placeholder="Kode" required>
    <input name="jam" type="number" placeholder="Jam" required>
    <input name="kegiatan" placeholder="Kegiatan" required>
    <button type="submit" class="button">Tambah</button>
  </form>

  <!-- PREVIEW AREA -->
  <div id="preview-area"></div>

  <!-- HISTORY -->
  <div id="groups"></div>
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
  data.forEach((i, index) => {
    i.index = index; // Add index for deletion
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

    container.innerHTML += `<h3 class="month-header">${m}/${y}</h3>`;

    const grid = document.createElement('div');
    grid.className = 'ts-grid';

    groups[k].forEach(it=>{
      const warna = getWarna(it.kode);

      const card = document.createElement('div'); 
      card.className = 'ts-card';
      card.style.borderLeft = `6px solid ${warna}`;

      card.innerHTML = `
        <button class="btn-delete" onclick="deleteEntry(${it.index})">Hapus</button>
        <div class="ts-color" style="background:${warna}"></div>
        <div class="ts-title">${it.tanggal}</div>
        Kode: ${it.kode} | Jam: ${it.jam}<br>
        ${it.kegiatan}
      `;

      grid.appendChild(card);
    });

    container.appendChild(grid);
  }
}

async function deleteEntry(index) {
  if (confirm('Apakah Anda yakin ingin menghapus entry ini?')) {
    await fetch('api/timesheet.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'delete', index: index })
    });
    load(); // Reload history
  }
}

// Handle form submit for preview
document.getElementById('frm').addEventListener('submit', e => {
  e.preventDefault();
  const f = new FormData(e.target);

  const previewArea = document.getElementById('preview-area');
  previewArea.innerHTML = '';

  const previewDiv = document.createElement('div');
  previewDiv.className = 'preview-card';
  previewDiv.innerHTML = `
    <h4>Preview Entry:</h4>
    <strong>Tanggal:</strong> ${f.get('tanggal')}<br>
    <strong>Kode:</strong> ${f.get('kode')}<br>
    <strong>Jam:</strong> ${f.get('jam')}<br>
    <strong>Kegiatan:</strong> ${f.get('kegiatan')}<br>
    <button id="confirm-btn" class="button">Konfirmasi Tambah</button>
    <button id="cancel-btn" class="button" style="background: var(--logout-bg); color: var(--logout-text);">Batal</button>
  `;

  previewArea.appendChild(previewDiv);

  document.getElementById('confirm-btn').addEventListener('click', async () => {
    // Send to API
    const body = {
      action: 'add',
      tanggal: f.get('tanggal'),
      kode: f.get('kode'),
      jam: parseInt(f.get('jam')),
      kegiatan: f.get('kegiatan')
    };

    await fetch('api/timesheet.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(body)
    });

    // Reload history
    load();
    // Clear preview
    previewArea.innerHTML = '';
    // Reset form
    e.target.reset();
  });

  document.getElementById('cancel-btn').addEventListener('click', () => {
    previewArea.innerHTML = '';
  });
});

load();
</script>

</body>
</html>
