# Sistem Informasi Keasramaan Institut Teknologi Del

> Proyek ini merupakan persyaratan untuk menyelesaikan mata kuliah Proyek Akhir III.

## Informasi Proyek
<div style="text-align: justify">

- Proyek ini dibangun dengan tujuan mempermudah administrasi berasrama mahasiswa di Institut Teknologi Del dengan fokus utama pada perpindahan asrama oleh mahasiswa. 

- Proyek ini dibangun oleh empat orang mahasiswa semester VI yang tergabung dalam Kelompok 02 PA III yaitu:
    - Ares Pardosi
    - Jerikho Silaban
    - Edwin Hutagalung
    - Denny Sinaga

- Proyek ini dibangun dengan menggunakan Laravel 8 dan Tailwind CSS (v3.0)
</div>

![This is an image](https://i.ibb.co/S5YYg27/Homepage.png)

Untuk melihat hasil kerja kami silakan lihat [disini.](https://keasramaandel.dennysinaga.com/)

## Instalasi

1. Clone Repository
```bash 
1. git clone https://github.com/denny036/Proyek-Akhir-III.git
2. cd sistem-informasi-keasramaan
3. composer install
4. npm install
4. cp .env.example .env
```
2. Buka ```.env``` lalu ubah baris berikut sesuai dengan databasemu yang ingin dipakai.
```bash 
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

3. Instalasi website
```bash 
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
```
 
4. Jalankan website
```bash 
php artisan serve
```

### Author
[Denny Sinaga](https://github.com/denny036)

* Facebook: [Denny Abraham Sinaga](https://facebook.com/dennyasIDN)
* LinkedIn: [Denny Abraham Sinaga](https://linkedin.com/in/dennyabrahamsinaga)

### Kontribusi
Kami dengan senang hati menerima kontribusi, issues, dan feature requests. 

