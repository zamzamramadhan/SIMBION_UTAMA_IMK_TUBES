# PRD – Aplikasi Pengajuan Pembimbing

## 1. Overview Sistem

### Nama Aplikasi
**Aplikasi Pengajuan Pembimbing**

### Deskripsi Singkat
Aplikasi ini digunakan untuk mengelola proses pengajuan dosen pembimbing oleh mahasiswa, pengaturan kuota dosen, monitoring bimbingan, serta pelaporan oleh Admin/Ka.Prodi secara terpusat, transparan, dan terkontrol.

### Tujuan Utama
- Menghindari overload dosen pembimbing
- Mempermudah mahasiswa mengajukan pembimbing
- Memberikan kontrol penuh kepada Admin/Ka.Prodi
- Menyediakan data & laporan akademik yang akurat

---

## 2. Target Pengguna & Role

### 2.1 Mahasiswa
**Hak akses:**
- Register akun
- Login & logout
- Mengajukan dosen pembimbing
- Melihat status pengajuan
- Melihat dosen pembimbing yang disetujui

### 2.2 Admin (termasuk Ka.Prodi)
**Hak akses:**
- Login & logout
- Manajemen dosen
- Manajemen mahasiswa
- Approval kuota dosen
- Approval / penolakan pengajuan pembimbing
- Monitoring kuota
- Laporan & statistik
- Pengaturan sistem

> [!IMPORTANT]
> **Tidak ada self-register untuk Admin & Dosen**. Semua akun Admin & Dosen dibuat & dikelola oleh Admin.

---

## 3. Modul Autentikasi & Otorisasi

### 3.1 Login
- **Aktor**: Mahasiswa, Admin
- **Fitur**:
  - Login menggunakan email/NIM + password
  - Validasi role user
  - Redirect sesuai role
  - Proteksi route berbasis role

### 3.2 Register (Mahasiswa Only)
- **Aktor**: Mahasiswa
- **Fitur**:
  - Form register:
    - NIM
    - Nama
    - Email
    - Password
    - Angkatan
  - Validasi:
    - NIM unik
    - Email unik
  - Status awal: aktif

### 3.3 Logout
- **Aktor**: Semua role
- **Fitur**:
  - Logout manual
  - Session/token dihapus

---

## 4. Modul Dashboard Admin

### 4.1 Statistik Cepat
- Total dosen (aktif / non-aktif)
- Total mahasiswa
- Total pengajuan pembimbing pending
- Total bimbingan aktif

### 4.2 Aktivitas Terbaru
- Pengajuan kuota dosen terbaru
- Pengajuan pembimbing terbaru
- Perubahan status terbaru

### 4.3 Quick Actions
- Approve pengajuan kuota
- Lihat pengajuan mendesak
- Generate laporan cepat

---

## 5. Modul Manajemen Dosen (Admin)

### 5.1 Daftar Dosen
- **Data**: Nama, NIDN, Email, Status (aktif/non-aktif), Skills/kompetensi, Kuota (max/terpakai/sisa).
- **Action**: Edit data, Non-aktifkan dosen.

### 5.2 Tambah Dosen
- **Form**: Nama, NIDN, Email, Password (auto-generate/manual), Skills awal, Kuota default.

### 5.3 Update Skills Dosen
- Kategori keahlian
- Level: Pemula / Menengah / Ahli

---

## 6. Modul Manajemen Mahasiswa (Admin)

### 6.1 Daftar Mahasiswa
- **Data**: NIM, Nama, Angkatan, Status, Dosen pembimbing (jika ada), Status pengajuan.
- **Action**: Edit data, Reset password.

### 6.2 Import Data Mahasiswa
- Upload Excel
- Validasi data
- Mass registration

---

## 7. Modul Pengajuan Kuota Dosen

### 7.1 Daftar Pengajuan Kuota
- **Kolom**: Status | Dosen | Kuota Diajukan | Alasan | Tanggal | Action
- **Status**: Pending, Approved, Rejected
- **Action**: Approve, Reject, View detail

### 7.2 Detail Pengajuan
- Alasan dosen
- Riwayat kuota sebelumnya
- Catatan approval admin

### 7.3 Riwayat Approval
- Filter by: tanggal, dosen, status

---

## 8. Modul Monitoring Kuota

### 8.1 Dashboard Visual
- Pie Chart: utilisasi per dosen
- Bar Chart: kuota terpakai vs sisa
- Progress bar per dosen

### 8.2 Tabel Monitoring
- **Kolom**: Dosen | Skills | Kuota Disetujui | Terpakai | Sisa | Utilization | Status
- **Filter**: Fakultas, Keahlian
- **Sort**: Utilization tertinggi / terendah

### 8.3 Alert System
- 80% → Warning
- 100% → Danger
- Notifikasi ke Admin/Ka.Prodi

---

## 9. Modul Pengajuan Pembimbing

### 9.1 Pengajuan oleh Mahasiswa
- **Fitur**:
  - Pilih dosen pembimbing
  - Upload proposal
  - Submit pengajuan
  - Melihat status pengajuan

### 9.2 Daftar Pengajuan (Admin)
- **Kolom**: Status | Mahasiswa | Dosen | Proposal | Tanggal | Action
- **Action**: View detail, Force approve, Cancel

### 9.3 Konflik Management
- **Deteksi**:
  - Mahasiswa mengajukan >1 dosen
  - Dosen overload kuota

---

## 10. Modul Laporan & Statistik

### 10.1 Laporan Periodik
- Bimbingan per semester
- Distribusi mahasiswa per dosen
- Tren pengajuan per bulan

### 10.2 Export Data
- PDF (laporan formal)
- Excel
- CSV

### 10.3 Analytics
- Dosen paling diminati
- Skills paling dicari
- Rata-rata waktu approval

---

## 11. Modul Pengaturan Sistem

### 11.1 Pengaturan Umum
- Kuota default dosen
- Masa aktif pengajuan
- Pengaturan notifikasi

### 11.2 Manajemen Periode
- Open / close periode
- Deadline pengajuan
- Reset data per semester

### 11.3 Backup & Log
- Backup database
- Restore data
- Log aktivitas sistem

---

## 12. Non-Functional Requirements
- Role-based access control
- Data consistency & validation
- Audit trail untuk approval
- Responsive UI
- Secure authentication (hash password, token/session)

---

## 13. Asumsi Teknis
- **Backend**: Laravel
- **Frontend**: Vue / React
- **Database**: MySQL
- **Auth**: Laravel Sanctum / Session
- **Chart**: ChartJS / Recharts

---

## 14. Status Implementasi (To Be Filled)
- [ ] Auth mahasiswa
- [ ] Dashboard admin
- [ ] Manajemen dosen
- [ ] Pengajuan pembimbing
- [ ] Monitoring kuota
- [ ] Laporan