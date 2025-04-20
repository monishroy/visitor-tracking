# Visitor Tracking Package for Laravel

The `monishroy/visitor-tracking` package provides a simple way to track and analyze visitor data in your Laravel application, including total visitors, unique visitors, top visited pages, countries, operating systems, and devices.

## Installation

1. **Install the Package**

   Require the package via Composer:

   ```bash
   composer require monishroy/visitor-tracking
   ```

2. **Run Database Migrations**

   After installing the package, run the migrations to set up the necessary database tables:

   ```bash
   php artisan migrate
   ```

## Usage

The package provides a `Visitor` facade to access visitor tracking data. You can use the following methods to retrieve analytics:

```php
use Monishroy\VisitorTracking\Facades\Visitor;

Visitor::totalVisitors(),     // Returns the total number of visitors
Visitor::uniqueVisitors(),    // Returns the count of unique visitors
Visitor::topVisitedPages(),   // Returns the most visited pages
Visitor::countries(),         // Returns visitor countries
Visitor::os(),                // Returns operating systems used by visitors
Visitor::devices()            // Returns devices used by visitors

```

### Example Output

Running the above code will dump the visitor data, which might look like this (example):

```php
[
    "totalVisitors" => 1000,
    "uniqueVisitors" => 750,
    "topVisitedPages" => [
        "/home" => 500,
        "/about" => 300,
        "/contact" => 200
    ],
    "countries" => [
        "USA" => 400,
        "India" => 300,
        "Bangladesh" => 100
    ],
    "os" => [
        "Windows" => 600,
        "MacOS" => 300,
        "Linux" => 100
    ],
    "devices" => [
        "Desktop" => 700,
        "Mobile" => 250,
        "Tablet" => 50
    ]
]
```

## Requirements

- PHP >= 7.4
- Laravel >= 5.0

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).

## Support

For issues or feature requests, please open an issue on the [GitHub repository](https://github.com/monishroy/visitor-tracking).