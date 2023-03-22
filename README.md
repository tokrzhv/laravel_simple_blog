# Laravel Project

This is a basic Laravel project that you can use as a starting point for your web application. Follow the instructions below to get started.

## Getting Started

### Prerequisites

Before you can launch this project, you need to have the following software installed on your computer:

- [PHP](https://www.php.net/manual/en/install.php) (8.1 or later)
- [Composer](https://getcomposer.org/download/)
- [Node.js](https://nodejs.org/en/download/) (14 or later)
- [npm](https://www.npmjs.com/get-npm) (comes with Node.js)

### Installing

To install this project, follow these steps:

1. Clone this repository to your local machine.
2. Navigate to the project directory.
3. Run `composer install` to install the PHP dependencies.
4. Run `npm install` to install the Node.js dependencies.
5. Copy the `.env.example` file to `.env` and update the database credentials.
6. Run `php artisan key:generate` to generate an application key.
7. Run `php artisan migrate` to create the database tables.

### Launching

To launch this project, follow these steps:

1. Navigate to the project directory.
2. Run `npm run dev` to compile the frontend assets.
3. In a separate terminal window, run `php artisan serve` to start the Laravel development server.
4. In your web browser, navigate to `http://localhost:8000` to view the application.

## Built With

- [Laravel](https://laravel.com/) - The PHP web framework used
- [Bootstrap](https://getbootstrap.com/) - The CSS framework used
- [SweetAlert](https://sweetalert.js.org/) - The JavaScript library used for displaying alert messages

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## Acknowledgments

- [Laravel Documentation](https://laravel.com/docs) - For their great documentation on how to get started with Laravel.
