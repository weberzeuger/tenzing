# Tenzing Prototype

## Summary

This prototype demonstrates the following techniques:

- How to use [Composer](https://getcomposer.org) as a dependency manager.
- How to use an `.env` file to store all configuration in a central place (e.g. the DB access credentials).
- How to use [Doctrine DBAL](https://www.doctrine-project.org) as a database abstration layer (DBAL).
- How to use a single entry point for all requests to the application.
- How to use a request/response handler that follows the [PSR-7 standard](https://www.php-fig.org/psr/psr-7/).

## Code Repository

All code is stored in a code repository at GitHub: <https://github.com/schams-net/tenzing>

## Package Dependencies

The following packages are defined as "requirements" (dependencies) in the `composer.json` file.

### PHP dotenv

This library lets us read and process `.env` files, so we don't store any sensitive data in the PHP code.
See <https://github.com/vlucas/phpdotenv> for details.

### Doctrine DBAL

A database abstration layer that makes us independent from the database engine and contains built-in protection against SQL injections.
See <https://www.doctrine-project.org/projects/doctrine-dbal/en/current/index.html> for details.

### HttpFoundation Component

Following the PSR-7 standard, this library features a request/response handler. It lets us easily access data from the incoming request (URL path, parameters, HTTP headers, etc.) and generate responses.
See <https://symfony.com/doc/current/components/http_foundation.html> for details.

## Deployment

You can "clone" the Git repository to your local machine or on the server:

```console
git clone https://github.com/schams-net/tenzing
```

After that, change into the new directory `tenzing/` and execute the following Composer command to install all dependencies:

```console
composer install
```

The file `public/index.php` is the single entry point (all requests are routed to this file, see `.htaccess` for Apache web servers).
The data stored in the database controls what the application should do if a request comes in, for example, to `/gre-vocab-fc`.
