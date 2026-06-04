DROP DATABASE perpustakaan_dbmodul6;

CREATE DATABASE perpustakaan_dbmodul6;
USE perpustakaan_dbmodul6;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    PASSWORD VARCHAR(255) NOT NULL,
    ROLE ENUM('admin','user') DEFAULT 'user'
);

CREATE TABLE buku (
    id_buku INT AUTO_INCREMENT PRIMARY KEY,
    judul_buku VARCHAR(100),
    penulis VARCHAR(100),
    penerbit VARCHAR(100),
    tahun_terbit YEAR,
    stok INT
);
