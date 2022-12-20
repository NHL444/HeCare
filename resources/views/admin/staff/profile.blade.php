<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đổi Mật Khẩu</title>
    <link rel="stylesheet" href="/css/stylelogin.css">
    <link rel="stylesheet" href="/admin/assets/css/style.css">
</head>
<body>
    
    <div class="body"></div>
    <div class="grad"></div>
    <div class="header">
        <div>HeCare<span>Website</span></div>
    </div>
    <br>
    <form id="admin-login" action="{{route('admin.changepass')}}" method="POST">
        @csrf
        <div class="login">
                <input type="password" placeholder="Mật khẩu hiện tại" name="current_password"><br>
                @error('current_password')
                    <span style="color: red;">{{$message}}</span>
                @enderror
                <input type="password" placeholder="Mật khẩu mới" name="new_password"><br>
                @error('new_password')
                    <span style="color: red;">{{$message}}</span>
                 @enderror  
                <input type="password" placeholder="Xác nhận mật khẩu mới" name="new_password_confirmation"><br>                 
                <input type="submit" value="Xác Nhận"><br><br>
                <a href="{{route('admin.homepage')}}" class="btn btn-primary">Quay Lại</a>
                
        </div>
    </form>
</body>
</html>