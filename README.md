# Web Technologies Portfolio – Plantopia E-Commerce Application

This repository contains the implementation of a web-based plant e-commerce application, developed as part of the **Web Technology** module in the undergraduate AI curriculum.

The project was built using **PHP**, **HTML/CSS/JS**, and **JSON** for data persistence, simulating a simple but functional full-stack application without the use of a traditional database system.

> This application was developed collaboratively as a course assignment. All implementation, design, and logic were created from scratch for educational purposes.

---

## Contents

### 🛒 Plantopia – Online Plant Shop

- Multi-page PHP application
- Dynamic product display from JSON
- Shopping cart and wishlist (persistent)
- User registration and login system
- Admin dashboard for managing orders
- JSON-based data storage (no SQL database used)
- Responsive front-end with reusable components

---

## Features Implemented

### User Side
- View all plant products with images and prices
- Add/remove items from the cart and wishlist
- Proceed to checkout and simulate a purchase
- User authentication (login/register)
- Cart state is saved between sessions using JSON

### Admin Side
- View all customer orders
- Update or delete orders from the dashboard
- Simulated admin access (no protected routing)

---

## Technologies Used

- **PHP** (core logic and routing)
- **HTML5/CSS3** (front-end layout and styling)
- **JavaScript** (minor interactivity)
- **JSON files** (persistent data storage)
- **PHP built-in server** (for local development)

---

## How to Run Using PHP's Built-in Server

If you don't want to install a full stack like XAMPP or MAMP, you can use PHP's built-in development server. Here's how:

### Prerequisites
- You must have **PHP installed** on your system.
- To check, run:
    ```
    php -v
    ```

### Steps

1. Open a terminal or command prompt.
2. Navigate to the root folder of this project. For example:
    ```
    cd path/to/plantopia-main
    ```
3. Start the PHP development server:
    ```
    php -S localhost:8000
    ```

4. Open your browser and go to:
    ```
    http://localhost:8000/index.php
    ```

> This will load the homepage of Plantopia. You can now navigate through the site, use the cart, wishlist, admin pages, etc.

### Notes
- Do not close the terminal while testing — the server runs in that window.
- You can stop the server anytime by pressing `CTRL + C`.

## Academic Honesty Policy

This repository documents original work completed as part of the **Web Technology** module at **Technische Hochschule Ingolstadt**.

It is shared for educational transparency and to showcase practical full-stack development skills.

**Do not reuse or submit this content for academic credit.**  
Please uphold your institution’s academic integrity guidelines.
