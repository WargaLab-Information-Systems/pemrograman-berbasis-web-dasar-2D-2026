CREATE DATABASE cafe_db;
USE cafe_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user') DEFAULT 'user'
);

CREATE TABLE menu (
    id_menu INT AUTO_INCREMENT PRIMARY KEY,
    nama_menu VARCHAR(100) NOT NULL,
    kategori VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    deskripsi TEXT NOT NULL,
    stok INT NOT NULL
);

CREATE TABLE pesanan (
    id_pesanan INT AUTO_INCREMENT PRIMARY KEY,
    nama_pemesan VARCHAR(100) NOT NULL,
    menu_pesan VARCHAR(100) NOT NULL,
    jumlah INT NOT NULL,
    total_harga INT NOT NULL,
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);