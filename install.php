<?php
    $mysqli = mysqli_connect("localhost", "root", "azerty");

    if (mysqli_connect_errno($mysqli)) {
        echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
    }

    mysqli_query($mysqli, "CREATE DATABASE IF NOT EXISTS minishop");
    mysqli_select_db($mysqli, "minishop");
    $user_creation = "CREATE TABLE `User` (
        `id` INT NOT NULL AUTO_INCREMENT UNIQUE,
        `login` VARCHAR(255) NOT NULL UNIQUE,
        `passwd` VARCHAR(255) NOT NULL,
        `first_name` VARCHAR(255),
        `last_name` VARCHAR(255),
        PRIMARY KEY (`id`)
    )";
    mysqli_query($mysqli, $user_creation);
    $product_creation = "CREATE TABLE `products` (
        `id` INT NOT NULL AUTO_INCREMENT UNIQUE,
        `name` VARCHAR(255) NOT NULL,
        `description` VARCHAR(255) NOT NULL,
        `price` INT NOT NULL,
        PRIMARY KEY (`id`)
    )";
    mysqli_query($mysqli, $product_creation);
    $categories_creation = "CREATE TABLE `categories` (
        `id` INT NOT NULL AUTO_INCREMENT UNIQUE,
        `name` INT NOT NULL,
        PRIMARY KEY (`id`)
    )";
    mysqli_query($mysqli, $categories_creation);
    $category_map_creation = "CREATE TABLE `category_map` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `product_id` INT NOT NULL,
        `category_id` INT NOT NULL,
        PRIMARY KEY (`id`)
    )";
    
    mysqli_query($mysqli, $category_map_creation) or die(mysqli_error($mysqli));
    mysqli_query($mysqli, "ALTER TABLE `category_map` ADD CONSTRAINT `category_map_fk0` FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)") or die(mysqli_error($mysqli));
    mysqli_query($mysqli, "ALTER TABLE `category_map` ADD CONSTRAINT `category_map_fk1` FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`)") or die(mysqli_error($mysqli));
?>