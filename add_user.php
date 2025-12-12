<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') header('Location: index.php');
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Kelola User</title>

<!-- FONT -->
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
    --btn-reset-bg: #1e3a8a; /* Blue reset (or adjust to gold if needed) */
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
    --btn-reset-bg: #1e3a8a; /* Blue reset */
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
#sidebar{
    position:fixed;
    left:0;
    top:0;
    width:240px;
    height:100vh;
    background: var(--sidebar-bg);
    color: var(--text-color);
    padding:20px;
    border-right: 2px solid var(--card-border);
    transition: background 0.3s, color 0.3s;
}

#sidebar h2{
    font-size:20px;
    margin-bottom:25px;
    color: var(--text-color);
}

#sidebar a{
    display:block;
    background: var(--nav-bg);
    padding:10px 14px;
    border-radius:6px;
    color: var(--text-color);
    text-decoration:none;
    margin-bottom:8px;
    transition:0.2s;
    border: 1px solid var(--card-border);
}

#sidebar a:hover{ background: var(--nav-hover-bg); color: var(--nav-hover-text); }

.logout{ background: var(--logout-bg) !important; color: var(--logout-text) !important; }

/* ================= CONTENT ================= */
#content{
    margin-left:260px;
    padding:30px;
    background: var(--bg-color);
    transition: background 0.3s;
}

#content h1{
    color: var(--header-color);
    margin-top:0;
    margin-bottom:20px;
}

/* ================= FORM TAMBAH USER ================= */
#uform{
    background: var(--form-bg);
    padding:20px;
    border-radius:12px;
    width:fit-content;
    margin-bottom:25px;
    box-shadow:0 3px 10px var(--shadow);
    border: 2px solid var(--card-border);
    transition: background 0.3s, box-shadow 0.3s;
}

#uform input, #uform select{
    padding:8px 12px;
    margin-right:10px;
    border-radius:6px;
    border:1px solid var(--input-border);
    background: var(--input-bg);
    color: var(--text-color);
    transition: background 0.3s, color 0.3s, border-color 0.3s;
}

.button{
    background: var(--btn-bg);
    color: var(--btn-text);
    padding:10px 16px;
    border-radius:8px;
    border:none;
    cursor:pointer;
    font-weight:600;
    transition: background 0.3s;
}

.button:hover{ background: var(--btn-hover); }

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

/* ================= LIST USER ================= */
.user-card{
    background: var(--card-bg);
    padding:18px;
    border-radius:12px;
    margin-bottom:12px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 3px 10px var(--shadow);
    border: 1px solid var(--card-border);
    transition: background 0.3s, box-shadow 0.3s;
}

.user-info{
    font-size:16px;
    font-weight:600;
    color: var(--text-color);
}

.user-role{
    font-size:14px;
    opacity:0.7;
    color: var(--text-color);
}

.btn-small{
    padding:6px 12px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-weight:600;
    margin-left:6px;
    transition: background 0.3s;
}

.btn-delete{
    background: var(--btn-delete-bg);
    color: var(--btn-text);
}

.btn-reset{
    background: var(--btn-reset-bg);
    color: var(--btn-text);
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
  <a href="add_user.php">Tambah User</a>
  <a class="logout" href="api/logout.php">Logout</a>
</div>

<!-- CONTENT -->
<div id="content">

<div style="display:flex; justify-content:space-between; align-items:center;">
  <h1>Tambah / Kelola User</h1>
  <button class="theme-toggle" id="theme-toggle">Toggle Mode</button>
</div>

<!-- FORM TAMBAH USER -->
<form id="uform">
    <input name="username" placeholder="Username" required>
    <input name="password" placeholder="Password" required>
    <select name="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>
    <button class="button" type="submit">Tambah</button>
</form>

<!-- LIST USER -->
<div id="list"></div>

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

async function loadUsers(){
  const data = await fetch('db/users.json').then(r=>r.json());
  const list = document.getElementById('list');
  list.innerHTML = '';

  data.forEach(u=>{
    const div = document.createElement('div');
    div.className = 'user-card';

    div.innerHTML = `
      <div>
        <div class="user-info">${u.username}</div>
        <div class="user-role">${u.role}</div>
      </div>

      <div>
        <button class="btn-small btn-delete" onclick="del('${u.username}')">Hapus</button>
        <button class="btn-small btn-reset" onclick="reset('${u.username}')">Reset</button>
      </div>
    `;

    list.appendChild(div);
  });
}

document.getElementById('uform').addEventListener('submit', async e=>{
  e.preventDefault();
  const f = new FormData(e.target);

  const body = {
    action:'add',
    username:f.get('username'),
    password:f.get('password'),
    role:f.get('role')
  };

  await fetch('api/users.php',{
    method:'POST',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify(body)
  });

  loadUsers();
});

async function del(u){
  await fetch('api/users.php',{
    method:'POST',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify({action:'delete',username:u})
  });
  loadUsers();
}

async function reset(u){
  const np = prompt('Password baru untuk '+u);
  if(!np) return;

  await fetch('api/users.php',{
    method:'POST',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify({action:'reset',username:u,newpass:np})
  });

  loadUsers();
}

loadUsers();
</script>

</body>
</html>
