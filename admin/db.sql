CREATE DATABASE electrosh;
USE electrosh;

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
    email VARCHAR(150) NOT NULL UNIQUE, 
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
    code_id INT AUTO_INCREMENT KEY,
    code_name VARCHAR(100),
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
CREATE TABLE checkout(
    checkout_id INT AUTO_INCREMENT KEY,
    user_id INT,
    ithems TEXT,
    first_name VARCHAR(150),
    last_name VARCHAR(150),
    company_name VARCHAR(255),
    address VARCHAR(255),
    distric VARCHAR(255),
    province VARCHAR(255),
    postcode VARCHAR(255),
    mobile VARCHAR(20),
    email VARCHAR(100),
    note TEXT,
    promocode VARCHAR(20),
    status VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES user_role(user_id),
    CONSTRAINT fk_promocode FOREIGN KEY (promocode) REFERENCES promocode(code_name)
);

-- Insert: user_role | main roles
INSERT INTO `user_role` (`role_id`, `level`, `role_name`, `created_at`, `updated_at`) 
VALUES ('1', '1', 'user', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       ('2', '2', 'shop', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP), 
       ('3', '3', 'super-admin', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       ('4', '4', 'management', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
       ('5', '4', 'owner', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- Insert: user | owner
INSERT INTO `user` (`id`, `user_name`, `email`, `password`, `full_name`, `role_id`, `token`, `token_expiry`, `cart`, `profile_pic`, `banned`, `created_at`, `updated_at`) 
VALUES (NULL, 'electrosh', 'shehan774690541@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Shehan Rajapaksha', '5', NULL, NULL, NULL, NULL, '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);