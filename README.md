
# BudgetQu

Dalam perkembangan dunia digital yang sangat pesat, pengelolaan keuangan pribadi dan bisnis menggunakan teknologi semakin menjadi sebuah kebutuhan. Aplikasi catatan keuangan berbasis website “Budget-Qu” menjadi salah satu solusi permasalahan tersebut, dengan aksesibilitas fitur-fitur yang sangat mudah, aplikasi ini akan sangat diminati oleh pengguna. 
Oleh sebab itu dibuatlah aplikasi pencatatan keuangan “Budget-Qu” berbasis website yang dapat membantu pengguna untuk memanajemen pemasukan dan pengeluaran dengan efektif dan efisien. Pengembangan aplikasi ini menyediakan fitur-fitur yang memudahkan pengguna untuk menginputkan data pemasukan dan pengeluaran secara online. Selain itu aplikasi ini dapat diakses oleh siapa saja dengan fitur-fitur yang mudah dipahami dan mudah dijalankan. Oleh sebab itu, aplikasi ini diharapkan mampu memudahkan pengguna dalam melakukan pengorganisasian terhadap pencatatan keuangannya.


## Persyaratan 📋

Untuk menjalankan proyek ini dengan benar, Anda perlu menginstal teknologi-teknologi berikut di komputer Anda.
* PHP ^8.1
* Composer 2
* MySQL

## Cara Menginstall 🔧

1. Download file zip dari repository ini lalu extract file tersebut

2. Jalankan Apache dan MySQL dalam XAMPP atau server lainnya

3. Buka terminal / cmd / powershell dalam projek ini dan jalankan perintah :
```bash
composer install
```

4. Jalankan perintah “cp .env.example .env” di terminal dan simpan file .env yang telah dibuat. Kemudian dalam file .env ubah nama database di bagian “DB_DATABASE” menjadi `budget_app`. Atau Anda dapat menggunakan nama database yang lain.
```bash
cp .env.example .env
```

5. Jalankan perintah "php artisan migrate"
```bash
php artisan migrate
```

6. Jika belum membuat database, akan muncul pertanyaan “The database 'budget_app' does not exist on the 'mysql' connection.  Would you like to create it? (yes/no)” kemudian ketik `yes`.

7. Generate APP_KEY dengan perintah :
```bash
php artisan key:generate
```

8. Selanjutnya, jalankan proyek laravel dengan peirntah :
```bash
php artisan serve
```

9. Kemudian akan muncul url untuk menjalankan website, buka url tersebut di browser

10. Setelah website berhasil dijalankan di browser, fitur-fitur yang tersedia sudah bisa dijalankan

## Dibangun dengan 🛠️

- [PHP 8.1](https://www.php.net/releases/8.1/es.php)
- [Laravel 10](https://laravel.com/docs/10.x)
- [Composer 2.6.5](https://getcomposer.org/)
- [MySQL 8.2.0](https://dev.mysql.com/downloads/mysql/)



