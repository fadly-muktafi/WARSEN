# Ringkasan Aplikasi Kasir Restoran (Table Service)

## Gambaran Umum
Aplikasi kasir restoran berbasis web dengan konsep table service menggunakan **Laravel 12**, **MySQL**, dan **Tailwind CSS** dengan tampilan modern, minimalis, dan bersih. Aplikasi dirancang dengan pendekatan **Object-Oriented Programming (OOP)** dan menggunakan **stored procedures** untuk operasi database.

---

## Hak Akses Pengguna (Role-Based Access)

| Fitur | Administrator | Waiter | Kasir | Owner |
|-------|--------------|---------|-------|-------|
| Login | ✓ | ✓ | ✓ | ✓ |
| Logout | ✓ | ✓ | ✓ | ✓ |
| Entri Meja | ✓ | - | - | - |
| Entri Barang | ✓ | - | ✓ | - |
| Entri Order | - | ✓ | - | - |
| Entri Transaksi | - | - | ✓ | - |
| Generate Laporan | - | ✓ | - | ✓ |

---

## Struktur Database (PDM)

### **Menu** (Entity)
- `idmenu`: INTEGER (Primary Key)
- `nama_menu`: CHAR/STRING
- `harga`: INTEGER

### **User** (Entity)
- `id_user`: INTEGER (Primary Key)
- `nama_user`: CHAR/STRING

### **Pesanan** (Entity)
- `id_pesanan`: INTEGER (Primary Key)
- `id_pelanggan`: INTEGER (Foreign Key)
- `detail_pesanan`: INTEGER (Foreign Key)
- `jumlah`: INTEGER
- `total`: INTEGER
- `bayar`: INTEGER

### **Transaksi** (Entity)
- `id_transaksi`: INTEGER (Primary Key)
- `id_pesanan`: INTEGER (Foreign Key)
- `total`: INTEGER

### **Pelanggan** (Entity)
- `id_pelanggan`: INTEGER (Primary Key)
- `nama_pelanggan`: CHAR/STRING
- `jumlah_pelanggan`: BOOLEAN
- `nomor_meja`: CHAR/STRING(3)

---

## Alur Kerja Aplikasi

### 1. **Administrator**
- Mengelola data meja (CRUD)
- Mengelola data menu/barang (CRUD)
- Mengelola data user
- Setup konfigurasi sistem

### 2. **Waiter (Pelayan)**
- Login ke sistem
- Menerima pelanggan dan mencatat informasi:
  - Nama pelanggan
  - Jumlah pelanggan
  - Nomor meja
- Melakukan entry order:
  - Memilih menu dari daftar
  - Menentukan jumlah pesanan
  - Sistem otomatis menghitung total
- Generate laporan pesanan
- Meneruskan order ke kasir

### 3. **Kasir**
- Login ke sistem
- Menerima data order dari waiter
- Mengelola data menu/barang (jika diperlukan)
- Melakukan entry transaksi:
  - Melihat detail pesanan
  - Input jumlah pembayaran
  - Sistem menghitung kembalian
  - Generate struk/bukti pembayaran
- Konfirmasi pembayaran

### 4. **Owner**
- Login ke sistem
- Generate dan melihat berbagai laporan:
  - Laporan penjualan harian
  - Laporan penjualan periode tertentu
  - Laporan menu terlaris
  - Laporan pendapatan
- Analisis performa bisnis

---

## Fitur Utama

### ✨ **Desain Modern & User-Friendly**
- Interface bersih dan minimalis dengan Tailwind CSS
- Responsif untuk berbagai perangatan
- Navigasi intuitif sesuai role user
- Form yang mudah dipahami dengan validasi

### 🔒 **Sistem Autentikasi**
- Multi-role login system (4 roles)
- Session management
- Logout functionality
- Access control berdasarkan privilege

### 📊 **Manajemen Data**

**Master Data:**
- Menu/Barang (nama, harga)
- Meja (nomor, status)
- User (nama, role)

**Transaksi Data:**
- Pelanggan (nama, jumlah orang, meja)
- Pesanan (detail menu, jumlah, total)
- Pembayaran (total, bayar, kembalian)

### 🔄 **Alur Proses Bisnis**
1. **Order Flow**: Pelanggan → Waiter input order → Kasir proses pembayaran
2. **Auto Calculation**: Sistem otomatis menghitung subtotal dan total
3. **Payment Processing**: Validasi pembayaran dan perhitungan kembalian
4. **Reporting**: Generate laporan real-time untuk monitoring

### 🗄️ **Database Management**
Menggunakan **Stored Procedures** untuk:
- Insert data (pesanan, transaksi)
- Update data (status meja, status pesanan)
- Delete data (dengan soft delete jika perlu)
- Complex queries (laporan, aggregasi)
- Relasi antar tabel dengan Foreign Key
- Data integrity dan validation

### 📈 **Laporan**
- Laporan pesanan per meja
- Laporan transaksi harian/periodik
- Laporan penjualan per menu
- Export laporan (PDF/Excel)

---

## Teknologi Stack

- **Backend**: Laravel 12 (PHP Framework)
- **Database**: MySQL dengan Stored Procedures
- **Frontend**: Tailwind CSS (Modern, Minimalis)
- **Architecture**: OOP (Object-Oriented Programming)
- **Design Pattern**: MVC (Model-View-Controller)

---

## Keunggulan Aplikasi

✅ Pemisahan role yang jelas untuk keamanan  
✅ Otomasi perhitungan untuk mengurangi error  
✅ Stored procedures untuk performa database optimal  
✅ Interface modern yang mudah digunakan  
✅ Laporan komprehensif untuk decision making  
✅ Scalable dan maintainable code structure  

---

## Flow Detail per Role

### **Administrator Flow**
1. Login ke sistem
2. Akses dashboard admin
3. Kelola data meja (tambah/edit/hapus)
4. Kelola data menu (tambah/edit/hapus)
5. Kelola data user (tambah/edit/hapus/set role)
6. Logout

### **Waiter Flow**
1. Login ke sistem
2. Lihat daftar meja tersedia
3. Pilih meja untuk order baru
4. Input data pelanggan
5. Pilih menu dan jumlah pesanan
6. Review order dan total
7. Submit order ke kasir
8. Generate laporan pesanan (opsional)
9. Logout

### **Kasir Flow**
1. Login ke sistem
2. Lihat daftar order yang masuk
3. Pilih order untuk diproses
4. Verifikasi detail pesanan
5. Input jumlah pembayaran
6. Sistem hitung kembalian
7. Generate dan print struk
8. Selesaikan transaksi
9. Logout

### **Owner Flow**
1. Login ke sistem
2. Akses dashboard owner
3. Pilih jenis laporan:
   - Laporan harian
   - Laporan periode
   - Laporan per menu
   - Laporan pendapatan
4. Set filter dan parameter
5. Generate laporan
6. Export laporan (PDF/Excel)
7. Analisis data
8. Logout

---

## Fitur Tambahan (Nice to Have)

- 🔔 **Notifikasi Real-time**: Notifikasi untuk order baru ke kasir
- 📱 **Responsive Design**: Optimal di mobile, tablet, dan desktop
- 🖨️ **Print Struk**: Langsung print struk pembayaran
- 📧 **Email Receipt**: Kirim struk via email (opsional)
- 🎨 **Theme Customization**: Dark/Light mode
- 📊 **Dashboard Analytics**: Grafik penjualan dan statistik
- 🔍 **Search & Filter**: Pencarian cepat untuk menu dan transaksi
- 💾 **Backup Data**: Automated database backup
- 🌐 **Multi-language**: Support Bahasa Indonesia dan English

---

### **Server Requirements**
- PHP >= 8.2
- MySQL >= 8.0
- Composer
- Node.js & NPM (untuk compile Tailwind)

*Dokumen ini dibuat sebagai panduan pengembangan Aplikasi Kasir Restoran dengan teknologi Laravel 12, MySQL, dan Tailwind CSS.*