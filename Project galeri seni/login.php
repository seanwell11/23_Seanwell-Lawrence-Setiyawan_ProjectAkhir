<?php
include 'koneksi.php';
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            header("location: home.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Login - ArtVista</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        :root{--accent:#667eea}
        body{
            margin:0;
            height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            font-family:Arial,Helvetica,sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color:#222;
        }
        .card{
            width:320px;
            background:#fff;
            border-radius:10px;
            padding:22px;
            box-shadow:0 10px 30px rgba(0,0,0,0.12);
            text-align:center;
        }
        h2{margin:0 0 12px 0; color:var(--accent)}
        .alert{
            background:#fee;
            color:#c33;
            padding:10px;
            border-radius:6px;
            margin-bottom:12px;
            font-size:13px;
            border:1px solid #fcc;
        }
        form{display:flex;flex-direction:column;gap:10px;margin-top:8px}
        input[type="text"], input[type="password"]{
            padding:10px;
            border:1px solid #ddd;
            border-radius:6px;
            font-size:14px;
            width:100%;
            box-sizing:border-box;
        }
        button{
            background:var(--accent);
            color:#fff;
            border:0;
            padding:10px;
            border-radius:6px;
            font-weight:700;
            cursor:pointer;
        }
        button:hover{
            background:#5568d3;
        }
        .links{font-size:13px;margin-top:8px}
        .links a{color:var(--accent); text-decoration:none; font-weight:600}
        @media(max-width:380px){ .card{width:92%; padding:16px} }
    </style>
</head>
<body>
    <div class="card" role="main" aria-label="Form login">
        <h2>ArtVista</h2>
        <p style="margin:0 0 12px 0;color:#666;font-size:14px">Silakan masuk untuk mengelola karya</p>
        
        <?php if (isset($error)): ?>
            <div class="alert"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" novalidate>
            <input type="text" name="username" placeholder="Username" required autofocus>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Masuk</button>
        </form>
        <div class="links">
            <p style="margin:10px 0 0 0">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
            <p style="margin:6px 0 0 0"><a href="index.php">Kembali ke halaman publik</a></p>
        </div>
    </div>
</body>
</html>

