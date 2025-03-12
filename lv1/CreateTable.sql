CREATE DATABASE radovi CHARACTER SET utf8 COLLATE utf8_general_ci;
USE radovi;
CREATE TABLE diplomski_radovi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    naziv_rada VARCHAR(255) NOT NULL,
    tekst_rada TEXT,
    link_rada VARCHAR(255) NOT NULL,
    oib_tvrtke VARCHAR(11) NOT NULL
);