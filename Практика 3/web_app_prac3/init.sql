
CREATE DATABASE IF NOT EXISTS mydb;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'example';
GRANT SELECT,UPDATE,INSERT ON mydb.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE mydb;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE INDEX idx_product_name ON products (name);

INSERT INTO products (name, description, price) VALUES
    ('Tovar 1', 'Tovar description 1', 300.15),
    ('Tovar 2', 'Tovar description 2', 221.67),
    ('Tovar 3', 'Tovar description 3', 45.79);
