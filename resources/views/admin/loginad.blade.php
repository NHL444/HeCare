<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="/css/stylelogin.css">
</head>
<body>
    
    <div class="body"></div>
    <div class="grad"></div>
    <div class="header">
        <div>HeCare<span>Website</span></div>
    </div>
    <br>
    <form id="admin-login" action="/admin/loginad" method="POST">
        @csrf
        <div class="login">
                <input type="text" placeholder="Email Đăng Nhập" name="email"><br>
                <input type="password" placeholder="Mật Khẩu" name="password"><br>               
                <input type="submit" value="Đăng Nhập"><br>
                
        </div>
    </form>
</body>
</html>