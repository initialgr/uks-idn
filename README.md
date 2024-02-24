# UKS IDN Jonggol

![alt text](https://github.com/initialgr/uks-idn/blob/main/public/template/assets/img/dashboard.png)
![alt text](https://github.com/initialgr/uks-idn/blob/main/public/template/assets/img/pemeriksaan.png)

Ini adalah projek KKP dari Mahasiswa STIKOM CKI Jakarta, cabang IDN Jonggol
Dibuat berdasarkan data yang dibutuhkan di UKS IDN Jonggol

# Instalasi

-   git clone https://github.com/initialgr/uks-idn.git
-   composer install

# Konfigurasi Tema dan Database

1. Copy paste .env-example menjadi .env
2. Buat database baru di phpmyadmin atau adminer atau di mysqlnya dengan nama uks-idn
4. php artisan migrate
5. php artisan db:seed --class=AdministratorSeeder

# Login

Admin : id = admin, pw = apaajabolehdong

# Copyright

 <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
 </div>
