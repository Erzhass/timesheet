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
/* ================= GLOBAL ================= */
body{
    margin:0;
    background:#eef3fa;
    font-family:'Inter',sans-serif;
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
    margin-bottom:25px;
}

#sidebar a{
    display:block;
    background:rgba(255,255,255,0.12);
    padding:10px 14px;
    border-radius:6px;
    color:white;
    text-decoration:none;
    margin-bottom:8px;
    transition:0.2s;
}

#sidebar a:hover{ background:rgba(255,255,255,0.22); }

.logout{ background:#e63946!important; }

/* ================= CONTENT ================= */
#content{
    margin-left:260px;
    padding:30px;
}

#content h1{
    color:#1e3a8a;
    margin-top:0;
    margin-bottom:20px;
}

/* ================= FORM TAMBAH USER ================= */
#uform{
    background:white;
    padding:20px;
    border-radius:12px;
    width:fit-content;
    margin-bottom:25px;
    box-shadow:0 3px 10px rgba(0,0,0,0.08);
}

#uform input, #uform select{
    padding:8px 12px;
    margin-right:10px;
    border-radius:6px;
    border:1px solid #ccc;
}

.button{
    background:#1e40af;
    color:white;
    padding:10px 16px;
    border-radius:8px;
    border:none;
    cursor:pointer;
    font-weight:600;
}

.button:hover{ background:#15348c; }

/* ================= LIST USER ================= */
.user-card{
    background:white;
    padding:18px;
    border-radius:12px;
    margin-bottom:12px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 3px 10px rgba(0,0,0,0.08);
}

.user-info{
    font-size:16px;
    font-weight:600;
}

.user-role{
    font-size:14px;
    opacity:0.7;
}

.btn-small{
    padding:6px 12px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-weight:600;
    margin-left:6px;
}

.btn-delete{
    background:#e63946;
    color:white;
}

.btn-reset{
    background:#1e3a8a;
    color:white;
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

<h1>Tambah / Kelola User</h1>

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
