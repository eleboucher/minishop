<?php
    $mysqli = mysqli_connect("localhost", "root", "azerty");

    if (mysqli_connect_errno($mysqli)) {
        echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
    }
    mysqli_query($mysqli, "DROP DATABASE IF EXISTS minishop");
    mysqli_query($mysqli, "CREATE DATABASE minishop");
    mysqli_select_db($mysqli, "minishop");
    $user_creation = "CREATE TABLE `user` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `login` VARCHAR(255) NOT NULL UNIQUE,
        `passwd` VARCHAR(255) NOT NULL,
        `first_name` VARCHAR(255),
        `last_name` VARCHAR(255),
        PRIMARY KEY (`id`)
    )";
    mysqli_query($mysqli, $user_creation);
    $product_creation = "CREATE TABLE `product` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255) NOT NULL,
        `description` VARCHAR(1024) NOT NULL,
        `img` VARCHAR(1024) DEFAULT 'img/default.png', 
        `price` INT,
        `stock` INT,
        PRIMARY KEY (`id`)
    )";
    mysqli_query($mysqli, $product_creation) ;
    $categories_creation = "CREATE TABLE `category` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255) NOT NULL,
        PRIMARY KEY (`id`)
    )";
    mysqli_query($mysqli, $categories_creation);
    $category_map_creation = "CREATE TABLE `category_map` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `product_id` INT NOT NULL,
        `category_id` INT NOT NULL,
        PRIMARY KEY (`id`)
    )";

    mysqli_query($mysqli, $category_map_creation);

    $order_creation = "CREATE TABLE `order` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `customer_id` INT NOT NULL,
        PRIMARY KEY (`id`)
    )";
    mysqli_query($mysqli, $order_creation);

    $order_item_creation = "CREATE TABLE `order_item` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `order_id` INT NOT NULL,
        `product_id` INT NOT NULL,
        `quantity` INT NOT NULL,
        PRIMARY KEY (`id`)
    )";
    mysqli_query($mysqli, $order_item_creation);

    mysqli_query($mysqli, "ALTER TABLE `category_map` ADD CONSTRAINT `category_map_fk0` FOREIGN KEY (`product_id`) REFERENCES `product`(`id`)");
    mysqli_query($mysqli, "ALTER TABLE `category_map` ADD CONSTRAINT `category_map_fk1` FOREIGN KEY (`category_id`) REFERENCES `category`(`id`)");
    mysqli_query($mysqli, "ALTER TABLE `order` ADD CONSTRAINT `order_fk0` FOREIGN KEY (`user_id`) REFERENCES `user`(`id`)");
    mysqli_query($mysqli, "ALTER TABLE `order_item` ADD CONSTRAINT `order_item_fk0` FOREIGN KEY (`order_id`) REFERENCES `order`(`id`)");
    mysqli_query($mysqli, "ALTER TABLE `order_item` ADD CONSTRAINT `order_item_fk1` FOREIGN KEY (`product_id`) REFERENCES `product`(`id`)");

    mysqli_query($mysqli, "INSERT INTO products (name, description, img, price, stock) VALUES ('McLaren MP4/3', 'best cars much wow', 'img/default.png', 10000, 4)"); 
    mysqli_query($mysqli, "INSERT INTO products (name, description, img, price, stock) VALUES ('McLaren MP4/4', 'best cars much wow', 'img/default.png', 10000, 4)");
    mysqli_query($mysqli, "INSERT INTO products (name, description, img, price, stock) VALUES ('McLaren MP4/5, 'best cars much wow', 'img/default.png', 10000, 4)");
    mysqli_query($mysqli, "INSERT INTO products (name, description, img, price, stock) VALUES ('McLaren MP4/6', 'best cars much wow', 'img/default.png', 10000, 4)");
    mysqli_query($mysqli, "INSERT INTO products (name, description, img, price, stock) VALUES ('McLaren MP4/7A', 'best cars much wow', 'img/default.png', 10000, 4)");
    mysqli_query($mysqli, "INSERT INTO products (name, description, img, price, stock) VALUES ('McLaren MP4/8', 'best cars much wow', 'img/default.png', 10000, 4)");
    mysqli_query($mysqli, "INSERT INTO products (name, description, img, price, stock) VALUES ('McLaren MP4/8', 'best cars much wow', 'img/default.png', 10000, 4)");

    mysqli_query($mysqli, "INSERT INTO User (login, passwd, first_name, last_name) VALUES ('admin', '" . hash('whirlpool', 'admin') . "', 'admin', 'admin')");
    mysqli_query($mysqli, "INSERT INTO User (login, passwd, first_name, last_name) VALUES ('test', '" . hash('whirlpool', 'test') . "', 'test', 'test')");
    mysqli_close($mysqli);
?>