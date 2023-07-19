# Laravel 9 Assessment Test
A Simple Laravel 9 Assessment Application Template For Your Development Needs.

## Installation

Clone the project.
```bash
git clone https://github.com/dayCod/kui-kuiz.git
```

Open the project folder then, Install the Composer and Recognize the Composer Application Vendor.
```bash
composer install && composer dump-autoload
```

Copy the environment example file then, Generate the application key.
```bash
cp .env.example .env && php artisan key:generate
```

After all the installation progress, Migrate the Database and Sample Data.
```bash
php artisan migrate:fresh && php artisan sample-data:seed
```

It will generate login credentials, below:
```bash
Email: user@admin.com
Password: password
```

## System That Used On this Project
| PHP Version      | ^8.0.2 |
| Database         | MySQL  |   
| Laravel Version  | 9      |

## Contributing
Don't hesitate to contribute to the project by adapting or adding features, Bug Reports or Pull Request are welcome.

## License
This project is released under the [MIT](http://opensource.org/licenses/MIT) license.



