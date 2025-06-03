CREATE DATABASE IF NOT EXISTS citacontrac;
USE citacontrac;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin', 'user') NOT NULL
);

-- Tambahkan user dummy (password pakai MD5)
INSERT INTO users (username, password, role) VALUES
('admin', MD5('admin123'), 'admin'),
('user1', MD5('user123'), 'user');

CREATE TABLE materi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(255) NOT NULL,
  isi TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
