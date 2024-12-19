# project-pemrograman-web-b-pro-nak

## Anggota Kelompok Pronak
Nama | NPM | Bagian
--- | --- | ---|
Alfarisy Nafaro Gymnastiar | 140810230020 | Front-end
Hamud Abdul Aziz | 140810230042 | Front-end
Arya Muhammad Rafi Raharjo | 140810230072 |Back-end 

## Deskripsi Aplikasi
Aplikasi ini dirancang untuk mempermudah pembelian biasanya dilakukan secara tradisional (mengantri),
kini bisa lebih cepat hanya dengan membeli lewat aplikasi.

## Tujuan
Mempermudah langkah transaksi dengan membeli lewat aplikasi, tetapi tetap harus mengambil produk yang dibeli di tempat

## Target Pengguna
Pembeli yang lebih suka datang ke mall dengan waktu yang cukup terbatas, jadi cukup mengambil barang yang sudah dibeli

## Mockup 

## Skema Database

### User
No  | Nama      | Tipe Data   | Primary | Foreign |
--- | ---       | ---         | ---     | ---     |
1   | id        | varchar(255) | Yes     | No      |
1   | username  | varchar(255) | No      | No      |
2   | email     | varchar(255) | No      | No      | 
3   | password  | varchar(255) | No      | No      | 
4   | full_name | varchar(50) | No      | No      | 
5   | level     | int | No      | No      |

### Barang

No  | Nama        | Tipe Data   | Primary | Foreign |
--- | ---         | ---         | ---     | ---     |
1   | id          | varchar(50) | Yes     | No      |
2   | Name        | varchar(50) | No      | No      |
3   | price       | int         | No      | No      |
4   | desc        | varchar(50) | No      | No      | 
5   | category_id | varchar(50) | No      | Yes     |
6   | stock       | int         | No      | no      |

### Kategori

No  | Nama        | Tipe Data   | Primary | Foreign |
--- | ---         | ---         | ---     | ---     |
1   | id          | varchar(50) | Yes     | No      |
2   | desc        | varchar(50) | No      | No      | 
3   | Sex         | int(3)      | No      | No      | 
4   | Jenis       | varchar(50) | No      | No      | 

### Pemesanan

No  | Nama        | Tipe Data   | Primary | Foreign |
--- | ---         | ---         | ---     | ---     |
1   | id          | varchar(50) | Yes     | No      |
1   | pembeli_id  | varchar(50) | No      | YES     |
2   | barang_id   | varchar(50) | No      | YES     |
3   | quantity    | int         | No      | No      |
4   | price       | int         | No      | No      |
5   | status      | varchar(50) | No      | No      |

###  PEMBAYARAN

No  | Nama           | Tipe Data   | Primary | Foreign |
--- | ---            | ---         | ---     | ---     |
1   | id             | varchar(50) | Yes     | No      |
1   | order_id       | varchar(50) | No      | YES     |
2   | method         | varchar(50) | No      | YES     |
3   | status         | int         | No      | No      |
4   | jumlah         | int         | No      | No      |
5   | transaction_id | varchar(50) | No      | No      |
6   | payment_date   | varchar(50) | No      | No      |
 

### ERD DRAW IO
https://shorturl.at/8fTup