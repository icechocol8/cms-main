-- Create the database
CREATE DATABASE sample_cms;
USE sample_cms;

-- Create user_accounts table
CREATE TABLE user_accounts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    user_email_address VARCHAR(100) NOT NULL,
    user_display_name VARCHAR(50) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_salt VARCHAR(255) NOT NULL,
    user_date_registered DATETIME DEFAULT NULL
);


-- Create post_types table
CREATE TABLE post_types (
    type_id INT AUTO_INCREMENT PRIMARY KEY,
    type_name VARCHAR(50) NOT NULL UNIQUE
);

-- Create posts table
CREATE TABLE posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    type_id INT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user_accounts(user_id),
    FOREIGN KEY (type_id) REFERENCES post_types(type_id)
);

-- Create comments table
CREATE TABLE comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT,
    user_id INT,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(post_id),
    FOREIGN KEY (user_id) REFERENCES user_accounts(user_id)
);
