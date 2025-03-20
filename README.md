# Glofox-Like System Setup Guide

## Prerequisites
- Install [XAMPP](https://www.apachefriends.org/) or any local server with PHP and MySQL support.
- Install [Composer](https://getcomposer.org/download/).

## Installation Steps

### 1. Setup Database
Execute the following SQL commands in MySQL to create the necessary tables:

```sql
CREATE DATABASE glofox;
USE glofox;

CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    capacity INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_id INT NOT NULL,
    member_name VARCHAR(255) NOT NULL,
    booking_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE
);
```

### 2. Install Dependencies
Navigate to the project root directory and run:

```sh
composer install
```
### 3. Running the API
Go to file path: glofox\config\database.php and update the username and passowrd of the MySQL DB.

### 4. Running the API
Start your XAMPP server and access the API using Postman or a browser:

- **Create a Class**
  - **URL:** `http://localhost/glofox/classes`
  - **Method:** `POST`
  - **Payload:**
    ```json
    {
      "name": "Yoga Class",
      "start_date": "2025-04-01",
      "end_date": "2025-04-30"
    }
    ```
  - **Response:**
    ```json
    {
      "success": "Class created successfully.",
      "class_id": 1
    }
    ```

- **Create a Booking**
  - **URL:** `http://localhost/glofox/bookings`
  - **Method:** `POST`
  - **Payload:**
    ```json
    {
      "class_id": 1,
      "member_name": "John Doe",
      "booking_date": "2025-04-02"
    }
    ```
  - **Response:**
    ```json
    {
      "success": "Booking created successfully."
    }
    ```

### 4. Running Unit Tests
Run the following commands to execute test cases:

```sh
php vendor/bin/phpunit --bootstrap ./config/database.php tests/ClassTest.php
php vendor/bin/phpunit --bootstrap ./config/database.php tests/BookingTest.php
```

