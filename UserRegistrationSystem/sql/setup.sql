CREATE DATABASE KullaniciSistemi;

USE KullaniciSistemi;

CREATE TABLE kullanicilar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kullanici_adi VARCHAR(255) NOT NULL,
    dogum_tarihi DATE NOT NULL,
    nickname VARCHAR(255) NOT NULL
);
