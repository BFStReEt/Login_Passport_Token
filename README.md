<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<h1> Phiên bản laravel đang sử dụng <br><b>Laravel Framework 11.35.1<b><br></h1>
Tạo cơ sở dữ liệu tên login_passport<br>
<hr style="border: 0; height: 0.5px; background: #000;">


<b><br>Composer create-project laravel/laravel login-passport
<hr style="border: 0; height: 0.5px; background: #000;">

<b><br>php artisan install:api --passport
<hr style="border: 0; height: 0.5px; background: #000;">


<b><br>composer require laravel/passport
<hr style="border: 0; height: 0.5px; background: #000;">


<b><br>php artisan migrate
<hr style="border: 0; height: 0.5px; background: #000;">


<b><br>php artisan passport:install
<hr style="border: 0; height: 0.5px; background: #000;">


<h3>App/Models/User.php
<p align="center">
  <img src="img/1.png" alt="Mô tả hình ảnh" width="700">
</p>
<hr style="border: 0; height: 0.5px; background: #000;">


<h3>Config/auth.php
<p align="center">
  <img src="img/2.png" alt="Mô tả hình ảnh" width="700">
</p>
<hr style="border: 0; height: 0.5px; background: #000;">


<h3>app/Providers/AuthServiceProvides.php
<p align="center">
  <img src="img/3.png" alt="Mô tả hình ảnh" width="700">
</p>
<hr style="border: 0; height: 0.5px; background: #000;">


<h3>app/Http/Controller/AuthController.php
<p align="center">
  <img src="img/4.png" alt="Mô tả hình ảnh" width="700">
</p>
<hr style="border: 0; height: 0.5px; background: #000;">


<h3>Login
<p align="center">
  <img src="img/5.png" alt="Mô tả hình ảnh" width="700">
</p>
<hr style="border: 0; height: 0.5px; background: #000;">


<p align="center">
  <img src="img/6.png" alt="Mô tả hình ảnh" width="700">
</p>
<hr style="border: 0; height: 0.5px; background: #000;">


<h3>Register
<p align="center">
  <img src="img/7.png" alt="Mô tả hình ảnh" width="700">
</p>
<hr style="border: 0; height: 0.5px; background: #000;">


<h3>routes/api.php
<p align="center">
  <img src="img/8.png" alt="Mô tả hình ảnh" width="700">
</p>

Để kiểm tra cần có 2 thuộc tính này trong POSTMAN
Content-Type: application/json
Accept: application/json

{
    "username": "testuser01",
    "email": "testuser01@example.com",
    "password": "password123",
    "full_name": "Test User",    
    "address": "123 Main Street",
    "phone": "1234567890"
}
php .\artisan optimize:clear
Mẫu test trên postman