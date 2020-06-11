# Flip Challenge

#### Hi Flip Team 👋
Terima kasih banyak atas kesempatan yang telah diberikan kepada saya untuk bisa menyelesaikan challenge ini. Besar harapan saya untuk bisa berkontribusi bersama Flip Team untuk kebermanfaatan yang lebih luas.

---

### 🖥 Installation

Buka terminal:

```bash
git clone https://github.com/ahmadnurfadilah/flip-challenge.git
cd flip-challenge
```

### ⚙️ Preparation

Sebelum menjalankan aplikasi ini, buat sebuah database baru (MySQL) pada local computer. Kemudian ubah pengaturan database aplikasi ini pada file:

```
core/config.php
```

Sesuaikan nilai pada variabel berikut:

```
$db_host = '....';
$db_username = '....';
$db_password = '....';
$db_database = '....';
```

Jika sudah, buka termina untuk menjalankan migration & seed:

```bash
php core/migration.php
```

### 🕹 Usage

Untuk menjalankan aplikasi, ketikan perintah berikut pada terminal:
```
php -S localhost:8000
```

Silakan buka **http://localhost:8000** pada browser

---

Untuk login, bisa menggunakan salah satu dari 2 akun berikut:
```
Email: user1@gmail.com
Pass: user1
```
```
Email: user2@gmail.com
Pass: user2
```
---
#### Thankyou 😊
Best Regards,
**Ahmad Nurfadilah**