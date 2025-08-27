# 🛠️ Theor - E-commerce Hardware Store

[![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-10.4+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3+-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![Font Awesome](https://img.shields.io/badge/Font_Awesome-6.0+-339AF0?style=for-the-badge&logo=fontawesome&logoColor=white)](https://fontawesome.com/)
[![License](https://img.shields.io/badge/License-Proprietary-red.svg)](LICENSE)

> A complete e-commerce platform for hardware and tools retail. Features user authentication, product management, shopping cart functionality, and admin panel. **This project is part of my professional portfolio to demonstrate my development skills and practices.**

## 📋 Table of Contents

- [✨ Features](#-features)
- [🛠️ Technologies](#️-technologies)
- [📦 Installation](#-installation)
- [🎮 Usage](#-usage)
- [🏗️ Project Structure](#️-project-structure)
- [🔧 Database Schema](#-database-schema)
- [🧪 Testing](#-testing)
- [📄 License](#-license)

## ✨ Features

### 🎯 Core Functionality
- 🔐 **User Authentication System** - Secure login/registration with role-based access
- 🛍️ **Product Catalog** - Browse hardware tools with images and pricing
- 🛒 **Shopping Cart** - Add products with tax calculation (4% VAT)
- 👤 **User Management** - Admin can manage user accounts
- 📦 **Product Management** - CRUD operations for inventory
- 🔍 **Search Functionality** - Find products by name or category
- 📱 **Responsive Design** - Mobile-friendly Bootstrap interface

### 🎨 User Experience
- 🎨 **Modern UI/UX** - Clean Bootstrap 5 design with Font Awesome icons
- 📊 **Admin Dashboard** - Comprehensive product and user management
- 💰 **Price Calculation** - Automatic tax computation and total calculation
- 🖼️ **Image Management** - Product images with proper storage structure
- ⚡ **Fast Performance** - Optimized database queries and efficient PHP code

## 🛠️ Technologies

### Backend
| Technology | Version | Purpose |
|------------|---------|---------|
| [PHP](https://www.php.net/) | 8.0+ | Server-side scripting and application logic |
| [MySQL](https://www.mysql.com/) | 10.4+ | Relational database management |
| [MariaDB](https://mariadb.org/) | 10.4+ | Database server (MySQL compatible) |

### Frontend
| Technology | Version | Purpose |
|------------|---------|---------|
| [Bootstrap](https://getbootstrap.com/) | 5.3+ | CSS framework for responsive design |
| [Font Awesome](https://fontawesome.com/) | 6.0+ | Icon library for UI elements |
| [HTML5](https://developer.mozilla.org/en-US/docs/Web/HTML) | Latest | Markup language |
| [CSS3](https://developer.mozilla.org/en-US/docs/Web/CSS) | Latest | Styling and layout |

### Development Tools
- **XAMPP/WAMP** - Local development environment
- **phpMyAdmin** - Database management interface
- **Git** - Version control system

## 📦 Installation

### Prerequisites
- PHP 8.0 or higher
- MySQL/MariaDB 10.4 or higher
- Web server (Apache/Nginx)
- XAMPP, WAMP, or similar local development environment

### Quick Start

1. **Clone the repository**
   ```bash
   git clone [url-del-repositorio]
   cd theor
   ```

2. **Set up the database**
   ```bash
   # Import the database schema
   mysql -u root -p < theor.sql
   ```

3. **Configure database connection**
   ```php
   // Edit config.php with your database credentials
   define('server', 'localhost');
   define('usuario', 'your_username');
   define('clave', 'your_password');
   define('nombre', 'theor');
   ```

4. **Start the development server**
   ```bash
   # If using XAMPP/WAMP, start Apache and MySQL services
   # Place project in htdocs/www directory
   ```

5. **Access the application**
   - Main Store: `http://localhost/theor/`
   - Admin Panel: `http://localhost/theor/indexAdmin.php`

## 🎮 Usage

### Getting Started
1. **Browse Products** - Visit the homepage to see available hardware tools
2. **Register/Login** - Create an account or sign in to make purchases
3. **Add to Cart** - Click "Comprar" on any product to add to shopping cart
4. **Complete Purchase** - Review cart with tax calculation and confirm order

### Admin Features

#### Product Management
```php
// Add new product
// Navigate to: indexAdmin.php > "Agregar producto"
// Fill in: marca, nombre, precio, cantidad, imagen

// Edit existing product
// Navigate to: indexAdmin.php > Click "Editar" on product row
// Modify: any product details and save changes
```

#### User Management
```php
// Access user management
// Navigate to: indexAdmin.php > "Gestionar Usuarios"
// Actions: View all users, edit user details, manage permissions
```

### Key Features Usage

#### Product Search
```php
// Search functionality in admin panel
// Use search bar to find products by name or brand
// Results display in real-time table format
```

#### Shopping Cart
```php
// Add product to cart
// Navigate to product detail page
// Click "Comprar" button
// View cart with tax calculation (4% VAT)
```

## 🏗️ Project Structure

```
theor/
├── 📁 css/                    # Bootstrap CSS files
│   ├── bootstrap.css
│   ├── bootstrap.min.css
│   └── ... (Bootstrap components)
├── 📁 js/                     # Bootstrap JavaScript files
│   ├── bootstrap.bundle.js
│   ├── bootstrap.min.js
│   └── ... (Bootstrap components)
├── 📁 img/                    # Image assets
│   ├── 🖼️ banner.gif         # Site banner
│   ├── 🖼️ logo.png           # Company logo
│   ├── 🖼️ icono.png          # Favicon
│   └── 📁 productos/         # Product images
│       ├── bosch-lijadora.png
│       ├── dewalt-cierracircular.png
│       └── ... (product images)
├── 🔧 config.php             # Database configuration
├── 🔌 conexion.php           # Database connection handler
├── 📊 consultas.php          # Database queries and business logic
├── 🏠 index.php              # Main store homepage
├── 👤 indexCliente.php       # Customer dashboard
├── 🛒 indexClienteCompra.php # Shopping cart page
├── 🔐 indexAdmin.php         # Admin dashboard
├── ➕ nuevo.php              # Add new product form
├── ✏️ editar.php             # Edit product form
├── 👥 editarUsuario.php      # Edit user form
├── ⚠️ error.php              # Error handling page
└── 🗄️ theor.sql             # Database schema and sample data
```

## 🔧 Database Schema

### Tables Structure

#### `login` Table
```sql
CREATE TABLE login (
  id INT PRIMARY KEY AUTO_INCREMENT,
  usuario VARCHAR(25) NOT NULL,
  correo VARCHAR(50) NOT NULL,
  clave VARCHAR(25) NOT NULL,
  admin INT NOT NULL
);
```

#### `productos` Table
```sql
CREATE TABLE productos (
  codigo INT PRIMARY KEY AUTO_INCREMENT,
  marca VARCHAR(255) NOT NULL,
  fechaAlta DATE DEFAULT CURRENT_TIMESTAMP,
  nombre VARCHAR(255) NOT NULL,
  precio FLOAT NOT NULL,
  cantidad INT NOT NULL,
  estado INT NOT NULL,
  imagen VARCHAR(255) NOT NULL
);
```

### Sample Data
- **Users**: Admin and regular user accounts
- **Products**: Hardware tools from brands like Bosch, DeWalt, Makita, Stanley
- **Categories**: Power tools, hand tools, measuring instruments

## 🧪 Testing

### Manual Testing Checklist
- ✅ User registration and login
- ✅ Product browsing and search
- ✅ Shopping cart functionality
- ✅ Admin product management
- ✅ User management
- ✅ Responsive design on mobile devices
- ✅ Database operations (CRUD)

### Test Scenarios
```bash
# Test user authentication
1. Register new user account
2. Login with valid credentials
3. Verify role-based access (admin vs regular user)

# Test product management
1. Add new product as admin
2. Edit existing product details
3. Verify product display on store frontend

# Test shopping functionality
1. Add products to cart
2. Verify tax calculation (4% VAT)
3. Complete purchase process
```

## 📄 License

This project is proprietary software. All rights reserved. This code is made publicly available solely for portfolio demonstration purposes. See the [LICENSE](LICENSE) file for full terms and restrictions.

---

<div align="center">
  <p>
    <a href="#️-theor---e-commerce-hardware-store">Back to top</a>
  </p>
</div>
