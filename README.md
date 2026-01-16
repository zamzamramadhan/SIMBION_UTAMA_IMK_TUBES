# Aplikasi Pengajuan Pembimbing (SIMBION)

Aplikasi ini digunakan untuk mengelola proses pengajuan dosen pembimbing oleh mahasiswa, pengaturan kuota dosen, monitoring bimbingan, serta pelaporan oleh Admin/Ka.Prodi secara terpusat, transparan, dan terkontrol.

## 🚀 Fitur Utama

- **Mahasiswa**: Registrasi, Login, Pengajuan Dosen Pembimbing, Monitoring Status.
- **Dosen**: Login, Melihat Mahasiswa Bimbingan, Cek Kuota.
- **Admin / Ka.Prodi**:
  - Manajemen User (Dosen, Mahasiswa).
  - Approval Kuota Dosen.
  - Approval Pengajuan Pembimbing.
  - Monitoring Kuota & Statistik.
  - Laporan.

## 🛠️ Teknologi yang Digunakan

- **Backend**: [Laravel](https://laravel.com) 11.x
- **Frontend**: [Blade](https://laravel.com/docs/blade), [Tailwind CSS](https://tailwindcss.com), [Alpine.js](https://alpinejs.dev)
- **Database**: MySQL
- **Build Tool**: [Vite](https://vitejs.dev)

## 📋 Persyaratan Sistem

Pastikan Anda telah menginstal:
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

## 💻 Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di komputer lokal Anda:

1. **Clone Repository**
   ```bash
   git clone https://github.com/username/Aplikasi-Pengajuan-Pembimbing.git
   cd Aplikasi-Pengajuan-Pembimbing-antigravity
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup Environment**
   Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Pastikan Anda membuat database baru di MySQL (misal: `simbion_db`) dan atur `DB_DATABASE` di file `.env`.*

4. **Migrasi Database & Seeding**
   Jalankan migrasi untuk membuat tabel dan mengisi data dummy (akun default).
   ```bash
   php artisan migrate --seed
   ```

5. **Jalankan Aplikasi**
   Buka dua terminal terpisah untuk menjalankan server Laravel dan Vite.
   
   *Terminal 1:*
   ```bash
   php artisan serve
   ```
   
   *Terminal 2:*
   ```bash
   npm run dev
   ```

   Akses aplikasi di: `http://localhost:8000`

## 🔑 Akun Default (Dummy)

Gunakan akun berikut untuk login dan mencoba fitur aplikasi:

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@mail.com` | `password` |
| **Dosen** | `dosen@mail.com` | `password` |
| **Kaprodi** | `kaprodi@mail.com` | `password` |
| **Mahasiswa** | `mahasiswa@mail.com` | `password` |

## 🤝 Kontribusi

Aplikasi ini dikembangkan untuk memenuhi tugas besar mata kuliah IMK/Pemrograman Web. Jika ingin berkontribusi, silakan buat _Pull Request_.

## 📄 Lisensi

[MIT License](https://opensource.org/licenses/MIT).
