<div align="center">
  <img src="./public/frontend/img/logo.png" width="100" alt="Lara-Ecommerce Logo"/>
</div>

# Lara-Ecommerce

Selamat datang di **Lara-Ecommerce**, platform e-commerce inovatif yang dirancang untuk memenuhi kebutuhan toko online modern. Dibangun menggunakan **Laravel 11**, **Laravel Filament 3**, dan **Laravel Livewire 3**, Lara-Ecommerce menawarkan solusi yang andal dan fleksibel bagi bisnis Anda.

Proyek ini tidak hanya dirancang untuk memberikan kemudahan manajemen, tetapi juga memanfaatkan teknologi terkini untuk menciptakan pengalaman pengelolaan yang interaktif, cepat, dan responsif.

---

## Apa itu Lara-Ecommerce?

**Lara-Ecommerce** adalah sistem manajemen toko online yang lengkap, memungkinkan pengelolaan produk, pesanan, dan konten situs dengan cara yang mudah dan intuitif. Integrasi antara **Laravel Filament** untuk antarmuka admin yang elegan, dan **Laravel Livewire** untuk interaksi real-time tanpa JavaScript yang kompleks, membuat Lara-Ecommerce menjadi platform yang efisien dan ramah pengguna.

Proyek ini sangat cocok bagi para pemilik bisnis yang ingin mengelola toko online secara efisien, tanpa harus khawatir dengan aspek teknis pengembangan aplikasi. Dengan Lara-Ecommerce, Anda bisa fokus pada pertumbuhan bisnis, sementara sistem mengurus pengelolaan backend.

---

## Fitur Unggulan

Lara-Ecommerce dilengkapi dengan berbagai fitur unggulan yang dirancang untuk mempermudah pengelolaan toko online. Berikut beberapa fitur utama yang ditawarkan:

### 1. Manajemen Inventory Barang

Pantau dan kelola stok barang Anda secara real-time. Dengan fitur ini, Anda dapat menambah, mengedit, dan menghapus produk dengan mudah, serta melacak jumlah stok secara akurat. Pengaturan kategori produk, variasi, dan harga juga dapat dilakukan melalui antarmuka yang sederhana dan ramah pengguna.

### 2. Role & Permission Management

Sistem ini menawarkan manajemen peran dan izin pengguna yang fleksibel. Dengan **Laravel Permission**, Anda dapat mengatur hak akses pengguna sesuai dengan peran mereka, seperti **Admin**, **Manager**, atau **Customer Support**. Fitur ini memastikan bahwa hanya pengguna yang berwenang yang dapat mengakses fitur-fitur tertentu di dalam sistem.

### 3. Content Management System (CMS)

Dengan CMS bawaan, Anda dapat mengelola halaman statis, banner promosi, dan konten situs lainnya dengan mudah. Fitur ini memungkinkan Anda untuk memperbarui konten tanpa memerlukan keahlian coding, sehingga Anda dapat mengelola situs web secara independen.

---

## Teknologi yang Digunakan

-   **Laravel 11**: Framework PHP yang kuat dan modern, dikenal karena kemudahan penggunaan dan skalabilitasnya.
-   **Laravel Filament 3**: Admin panel yang minimalis namun fungsional, memberikan kemudahan dalam mengelola data dan fitur.
-   **Laravel Livewire 3**: Alat yang memungkinkan pengembangan antarmuka real-time tanpa JavaScript, menjadikan aplikasi lebih responsif dan interaktif.

---

## Instalasi & Konfigurasi

Berikut adalah langkah-langkah untuk memulai proyek **Lara-Ecommerce**. Pastikan Anda sudah memiliki **PHP 8.2**, **Composer**, dan database seperti **MySQL** sebelum melanjutkan.

1. Clone repositori ini:

    ```bash
    git clone https://github.com/jauharimtikhan/lara-ecomerce.git
    ```

2. Masuk ke direktori proyek:

    ```bash
    cd lara-ecommerce
    ```

3. Install dependencies menggunakan Composer:

    ```bash
    composer install
    ```

4. Salin file `.env.example` menjadi `.env` dan atur konfigurasi database:

    ```bash
    cp .env.example .env
    ```

5. Generate kunci aplikasi:

    ```bash
    php artisan key:generate
    ```

6. Jalankan migrasi database untuk membuat tabel yang dibutuhkan:

    ```bash
    php artisan migrate
    ```

7. Jalankan server lokal:
    ```bash
    php artisan serve
    ```

---

## Kontribusi

Kami sangat menghargai setiap bentuk kontribusi dari komunitas. Jika Anda ingin menambahkan fitur baru, memperbaiki bug, atau mengusulkan peningkatan, silakan buat pull request atau buka isu di halaman [Issues](https://github.com/jauharimtikhan/lara-ecommerce/issues).

Kontribusi Anda sangat berarti dalam meningkatkan kualitas dan fungsionalitas proyek ini.

---

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE), yang berarti Anda bebas untuk menggunakannya dalam proyek pribadi maupun komersial selama mematuhi ketentuan lisensi.

---

Terima kasih telah memilih **Lara-Ecommerce** sebagai solusi toko online Anda. Kami berharap proyek ini dapat membantu Anda dalam membangun bisnis online yang sukses dan terus berkembang.
