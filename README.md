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

## Deployment

When deploying to Railway, the `DATABASE_URL` environment variable will be automatically set by the platform. For local development, you can set this environment variable manually or rely on the default connection string provided in the code.