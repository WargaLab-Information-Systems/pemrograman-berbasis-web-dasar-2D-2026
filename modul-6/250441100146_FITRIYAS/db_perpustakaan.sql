CREATE DATABASE IF NOT EXISTS db_perpustakaan;
USE db_perpustakaan;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    PASSWORD VARCHAR(255) NOT NULL,
    ROLE ENUM('admin','user') DEFAULT 'user'
);

CREATE TABLE buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(100) NOT NULL,
    penulis VARCHAR(100) NOT NULL,
    penerbit VARCHAR(100) NOT NULL,
    tahun_terbit INT NOT NULL,
    stok INT NOT NULL
);

CREATE TABLE peminjaman (
    id_peminjaman INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_buku INT,
    tanggal_pinjam DATE,
    STATUS VARCHAR(50),

    FOREIGN KEY (id_user) REFERENCES users(id),
    FOREIGN KEY (id_buku) REFERENCES buku(id)
);

UPDATE users
SET ROLE='admin'
WHERE username='raya';

SELECT * FROM users;










