CREATE DATABASE pbwd_6;
USE pbwd_6;


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
);

CREATE TABLE sparepart_motor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_part VARCHAR(100) NOT NULL,
    merk VARCHAR(50) NOT NULL,
    harga INT NOT NULL,
    berat_kg FLOAT NOT NULL,
    kondisi ENUM('baru', 'bekas') NOT NULL
);


select * from users;
select * from sparepart_motor;


-- -- adalah untuk update😹
-- UPDATE users SET role = 'admin' WHERE username = 'pelanggan';
-- DROP TABLE IF EXISTS sparepart_motor;
-- DROP TABLE IF EXISTS users;




