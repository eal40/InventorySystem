# 3 Motor Inventory System

## Database Configuration

This application has been updated to use Railway's database connection. The database connection is now configured using the `DATABASE_URL` environment variable.

### Connection Details

The application will automatically connect to the Railway MySQL database using the following connection string format:

```
mysql://username:password@hostname:port/database
```

The current configuration uses:

```
mysql://root:OaLTJmrPxXgjyJufzHKuLBQrcnkPIDBp@mysql-9ah0.railway.internal:3306/railway
```

### Implementation Details

- A centralized database configuration helper (`classes/db_config.php`) has been created to handle database connections
- All database connection code has been updated to use this helper
- The application will first check for a `DATABASE_URL` environment variable, and if not found, will use the default Railway connection string

### Files Updated

- `classes/function.php` - Main database connection function
- `classes/save_sales.php` - Sales data saving functionality
- `classes/distributionHistory.php` - Distribution history functionality
- Added new file: `classes/db_config.php` - Centralized database configuration helper

## Docker Setup

This project includes a simple Dockerfile for deployment on Railway.

### Docker File

- `Dockerfile` - Configures a PHP CLI environment with PDO MySQL extension installed

### Deployment to Railway

1. Push your code to a Git repository
2. Connect your repository to Railway
3. Railway will automatically detect the Dockerfile and build your application
4. Set up the MySQL database service in Railway
5. Railway will automatically set the `DATABASE_URL` environment variable

## Troubleshooting

If you encounter the "could not find driver" error:

1. The Dockerfile ensures that the PDO MySQL driver is installed
2. For local development without Docker, ensure that the PHP PDO MySQL extension is enabled in your php.ini file