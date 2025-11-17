<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $no_hp = $_POST['no_hp'];
    $tanggal = $_POST['tanggal_daftar'];

    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' OR email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Username atau Email sudah digunakan!');</script>";
    } else {
        $query = "INSERT INTO users (username, email, password, no_hp, tanggal_daftar)
                  VALUES ('$username', '$email', '$password', '$no_hp', '$tanggal')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Galeri Seni</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
        }
        h2 {
            color: #667eea;
            margin-bottom: 8px;
            text-align: center;
        }
        .subtitle {
            color: #999;
            font-size: 14px;
            text-align: center;
            margin-bottom: 24px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 14px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-family: Arial, sans-serif;
            transition: 0.3s;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 8px rgba(102, 126, 234, 0.2);
        }
        button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 12px;
        }
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }
        .links {
            font-size: 14px;
            text-align: center;
            margin-top: 16px;
            color: #666;
        }
        .links a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        .links a:hover {
            text-decoration: underline;
        }
        @media(max-width: 480px) {
            .card {
                padding: 24px;
                margin: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Galeri Seni</h2>
        <p class="subtitle">Buat akun baru</p>
        
        <form method="POST">
            <div>
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            
            <div>
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            
            <div>
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            
            <div>
                <label>Nomor HP</label>
                <input type="number" name="no_hp">
            </div>
            
            <div>
                <label>Tanggal Daftar</label>
                <input type="date" name="tanggal_daftar">
            </div>
            
            <button type="submit" name="register">DAFTAR</button>
        </form>
        
        <p class="links">Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
</body>
</html>
