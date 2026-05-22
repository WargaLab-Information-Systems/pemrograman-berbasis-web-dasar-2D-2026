CREATE DATABASE IF NOT EXISTS db_mahasiswa;
USE db_mahasiswa;

CREATE TABLE IF NOT EXISTS users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    username   VARCHAR(50)  NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    role       ENUM('admin','user') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS mahasiswa (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nim        VARCHAR(20)  NOT NULL UNIQUE,
    nama       VARCHAR(100) NOT NULL,
    jurusan    VARCHAR(100) NOT NULL,
    semester   TINYINT      NOT NULL DEFAULT 1,
    ipk        DECIMAL(3,2) NOT NULL DEFAULT 0.00,
    status     ENUM('aktif','cuti','lulus','dropout') NOT NULL DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO users (username, password, role) VALUES
('admin',     '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('mahasiswa', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');

INSERT INTO mahasiswa (nim, nama, jurusan, semester, ipk, status) VALUES
('2021001', 'Andi Pratama',   'Teknik Informatika',    6, 3.75, 'aktif'),
('2021002', 'Budi Santoso',   'Sistem Informasi',      4, 3.50, 'aktif'),
('2021003', 'Citra Dewi',     'Teknik Elektro',        8, 3.90, 'lulus'),
('2022001', 'Deni Wahyu',     'Teknik Informatika',    4, 2.80, 'aktif'),
('2022002', 'Eka Putri',      'Manajemen Informatika', 2, 3.20, 'aktif');