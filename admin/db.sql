CREATE DATABASE devsh;
USE devsh;

-- Table: user_role
CREATE TABLE user_role (
    role_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    level INT NOT NULL,
    role_name VARCHAR(100),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT uq_user_role UNIQUE (level, role_name)
);

-- Table: user_permission
CREATE TABLE user_permission (
    permission_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    permission VARCHAR(100),
    disabled BOOLEAN DEFAULT FALSE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT uq_user_permission UNIQUE (permission)
);

-- Table: user
CREATE TABLE user (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    role_id INT,
    token VARCHAR(255),
    token_expiry DATETIME,
    cart TEXT,
    profile_pic VARCHAR(255),
    banned BOOLEAN DEFAULT FALSE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT uq_user UNIQUE (user_name, email),
    CONSTRAINT fk_user_role FOREIGN KEY (role_id) REFERENCES user_role(role_id)
);

-- Table: category
CREATE TABLE category (
    category_id  INT NOT NULL PRIMARY KEY,
    category_name VARCHAR(150) NOT NULL,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT uq_category UNIQUE (category_name)
);

-- Table: ithem
CREATE TABLE ithem (
    ithem_id  INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ithem_code VARCHAR(255),
    ithem_name VARCHAR(255),
    description TEXT,
    same TEXT,
    brand VARCHAR(100),
    price DECIMAL(10,2),
    stock_quantity INT,
    min_quantity INT,
    warranty INT,
    image_path VARCHAR(255),
    datasheet_url VARCHAR(255),
    rating INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT uq_ithem UNIQUE (ithem_id)
);

-- Table: cart

-- Table: promocode
CREATE TABLE promocode(
    code_id int AUTO_INCREMENT KEY,
    code_name varchar(100),
    valid BOOLEAN DEFAULT TRUE,
    expired_date DATETIME,
    owner INT,
    count INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT uq_promocode UNIQUE (code_name),
    CONSTRAINT fk_user FOREIGN KEY (owner) REFERENCES user_role(user_id)
);

-- Table: checkout
