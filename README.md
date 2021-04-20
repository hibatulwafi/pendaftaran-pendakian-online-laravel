## About Pendaftaran Pendakian Online

Merupakan aplikasi yang dibangun menggunakan kerangka kerja laravel, digunakan untuk pendaftaran dan penyewaan fasilitas pendakian

## Installasi

- Masuk ke direktori aplikasi dan jalankan composer
	```sh
	$ cd nama-app-kalian
	$ composer install
	```
 - Copy file .env.example menjadi .env
	```sh
	$ cp .env.example .env
	```
- Generate key application
	```sh
	$ php artisan key:generate
	```
- Buat Database
- Edit database name, database username dan database password di file .env
    ```sh
	DB_DATABASE=your_db.
    DB_USERNAME=your_mysql_username.
    DB_PASSWORD=your_mysql_password.
	```
- Jalankan lokal development server
    ```sh
	$ php artisan serve
	```
- Buka di browser http://localhost:8000
- Login
    ```sh
	Username :  admin@admin.com
    Password :  password
	```
# Aplikasi pendaftaran pendakian dan penyewaan fasilitas pendakian menggunakan framework laravel
