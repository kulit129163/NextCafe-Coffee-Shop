# ☕ NextCafe Coffee Shop

A modern e-commerce coffee shop management system built with CodeIgniter 4.

## 📋 Overview

NextCafe is a full-featured coffee shop web application that allows customers to browse products, manage their cart and wishlist, place orders, and track order history. Administrators can manage products, categories, inventory, and view sales analytics through a comprehensive dashboard.

## ✨ Features

### Customer Features
- 🛍️ Product browsing with search, filter, and sort functionality
- 🛒 Shopping cart management
- ❤️ Wishlist functionality
- 📦 Order placement and tracking
- ⭐ Product reviews and ratings
- 👤 User profile management
- 📱 Responsive mobile-friendly design

### Admin Features
- 📊 Analytics dashboard with sales insights
- 🍰 Product and category management
- 📦 Inventory tracking
- 📈 Order management
- 👥 Customer tracking

## 🚀 Getting Started

### Prerequisites
- PHP 8.1 or higher
- MySQL 5.7+ or MariaDB
- Composer
- Web server (Apache/Nginx)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/kulit129163/NextCafe-Coffee-Shop.git
   cd NextCafe-Coffee-Shop
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   ```bash
   cp env .env
   ```
   
   Edit `.env` and configure your database settings:
   ```env
   database.default.hostname = localhost
   database.default.database = nextcafe_ecomms
   database.default.username = your_username
   database.default.password = your_password
   database.default.DBDriver = MySQLi
   ```

4. **Import database**
   ```bash
   mysql -u your_username -p nextcafe_ecomms < nextcafe_ecomms.sql
   ```

5. **Run migrations** (if needed)
   ```bash
   php spark migrate
   ```

6. **Start development server**
   ```bash
   php spark serve
   ```

7. **Access the application**
   - Customer: http://localhost:8080
   - Admin: http://localhost:8080/admin

## 🛠️ Technologies

- **Backend Framework:** CodeIgniter 4
- **Language:** PHP 8.1+
- **Database:** MySQL
- **Frontend:** HTML5, CSS3, JavaScript
- **Styling:** Bootstrap 5, Custom CSS
- **Version Control:** Git

## 📁 Project Structure

```
NextCafe-Coffee-Shop/
├── app/
│   ├── Controllers/     # Application controllers
│   ├── Models/          # Database models
│   ├── Views/           # View templates
│   └── Config/          # Configuration files
├── public/              # Public assets (CSS, JS, images)
├── writable/            # Logs and cache
├── vendor/              # Composer dependencies
└── .env                 # Environment configuration
```

## 🔧 Configuration

### Database Setup
Ensure your `.env` file contains the correct database credentials. You can use the provided `nextcafe_ecomms.sql` file to set up the initial database schema.

### Base URL
Update the base URL in `.env`:
```env
app.baseURL = 'http://localhost:8080'
```

## 📝 Server Requirements

- PHP version 8.1 or higher
- Required PHP extensions:
  - `intl`
  - `mbstring`
  - `json`
  - `mysqlnd` (for MySQL)
  - `libcurl`

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- Built with [CodeIgniter 4](https://codeigniter.com/)
- UI inspired by modern e-commerce design patterns

## 📞 Support

For support, please open an issue in the GitHub repository or contact the development team.

---

**NextCafe Coffee Shop** - Brewed with ❤️ and ☕
