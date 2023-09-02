# Laravel 9 Assessment Test
A Simple Laravel 9 Assessment Application Template For Your Development Needs.

## How to Install This Project

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

After all the installation progress, Migrate and make database.
```bash
php artisan migrate
```

After make the database, Seed a Sample Data.
```bash
php artisan sample-data:seed
```

Last Step, make storage link.
```bash
php artisan storage:link
```

It will generate login credentials, below:
```bash
Email: user@admin.com
Password: password
```

## System That Used On this Project
| PHP Version      | ^8.0.2 |
|------------------|--------|
| Database         | MySQL  |   
| Laravel Version  | 9      |

## Credits
- [Wirandra Alaya](https://github.com/dayCod)
- [See All Contributors](https://github.com/dayCod/kui-kuiz/contributors)

## Contributing
Don't hesitate to contribute to the project by adapting or adding features, Bug Reports or Pull Request are welcome.

## License
This project is released under the [MIT](http://opensource.org/licenses/MIT) license.



