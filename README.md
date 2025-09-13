# 3 Motor Inventory System

## Overview

The 3 Motor Inventory System is a centralized inventory management solution designed for Three M Motors with multiple branches. This web-based application allows for efficient tracking, management, and distribution of inventory across different branch locations.

## Features

- **Multi-Branch Inventory Management**: Track inventory across Main Branch and two sub-branches
- **User Authentication**: Secure login system with role-based access control
- **Inventory Overview**: Comprehensive dashboard with inventory statistics
- **Item Distribution**: Transfer items between branches with tracking
- **Category Management**: Organize items by categories
- **Sales Tracking**: Record and analyze sales data
- **Account Management**: Add, edit, and manage user accounts
- **Health Monitoring**: System health check endpoint for monitoring
- **Responsive Design**: Mobile-friendly interface

## System Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Required PHP extensions: PDO, PDO_MySQL, JSON, Session

## Installation

### Local Development Setup

1. Clone the repository to your local machine
2. Set up a local web server environment (XAMPP, WAMP, MAMP, etc.)
3. Import the database schema using the provided SQL file:
   ```
   mysql -u username -p database_name < 3motorinv.sql
   ```
4. Configure the database connection in `classes/db_config.php`
5. Access the application through your web browser

### Docker Setup

1. Make sure Docker is installed on your system
2. Build the Docker image:
   ```
   docker build -t 3motor-inventory .
   ```
3. Run the container:
   ```
   docker run -p 8080:8080 3motor-inventory
   ```
4. Access the application at `http://localhost:8080`

### Railway Deployment

This project is configured for deployment on Railway:

1. Push your code to a Git repository
2. Connect your repository to Railway
3. Railway will automatically detect the Dockerfile and build your application
4. Set up the MySQL database service in Railway
5. Railway will automatically set the `DATABASE_URL` environment variable

## Database Configuration

The application uses a centralized database configuration system that supports both local development and Railway deployment:

- For Railway: Uses the `DATABASE_URL` environment variable automatically set by Railway
- For local development: Configure the connection string in `classes/db_config.php`

The connection string format is:
```
mysql://username:password@hostname:port/database
```

## Project Structure

```
├── assets/              # Static assets (CSS, JS, images)
├── classes/             # PHP class files and business logic
├── modules/             # UI modules for different sections
├── 3motorinv.sql        # Database schema
├── dashboard.php        # Main application dashboard
├── health.php           # System health check endpoint
├── index.php            # Login page
└── Dockerfile           # Docker configuration
```

## Usage

1. Log in using your credentials on the login page
2. Navigate through the sidebar to access different modules:
   - Dashboard: Overview of system statistics
   - Inventory: View and manage inventory for each branch
   - Distribution: Transfer items between branches
   - Categories: Manage item categories
   - Account Management: Manage user accounts
   - Settings: Configure system settings

## Health Monitoring

The system includes a health check endpoint at `/health.php` that provides information about:

- PHP version compatibility
- Required PHP extensions
- Database connectivity
- Directory permissions

This endpoint returns a JSON response with the system's health status, useful for monitoring and troubleshooting.

## Troubleshooting

### Database Connection Issues

- Ensure the database server is running
- Verify the connection credentials in `classes/db_config.php`
- For PDO driver issues, ensure the PHP PDO MySQL extension is enabled

### PHP Errors

- Check PHP error logs for detailed error messages
- Ensure all required PHP extensions are installed and enabled
- Verify file permissions for write operations

## License

© 2024 Three M Motors. All rights reserved.