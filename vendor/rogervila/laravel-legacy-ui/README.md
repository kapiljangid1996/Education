# Legacy UI Presets with Auth scaffolding for Laravel 8

<a href="https://packagist.org/packages/rogervila/laravel-legacy-ui"><img src="https://img.shields.io/packagist/dt/rogervila/laravel-legacy-ui" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/rogervila/laravel-legacy-ui"><img src="https://img.shields.io/packagist/v/rogervila/laravel-legacy-ui" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/rogervila/laravel-legacy-ui"><img src="https://img.shields.io/packagist/l/rogervila/laravel-legacy-ui" alt="License"></a>

## Introduction

### This project brings old Auth scaffolding to Laravel 8 for projects that cannot migrate to [Jetstream](https://github.com/laravel/jetstream)

> NOTE: Laravel released [laravel/breeze](https://github.com/laravel/breeze), a new scaffolding package that could fit on projects that cannot migrate to Jetstram. I recommend trying it before using this fork.

While Laravel does not dictate which JavaScript or CSS pre-processors you use, it does provide a basic starting point using [Bootstrap](https://getbootstrap.com/), [React](https://reactjs.org/), and / or [Vue](https://vuejs.org/) that will be helpful for many applications. By default, Laravel uses [NPM](https://www.npmjs.org/) to install both of these frontend packages.

**We are not accepting new presets.**

## Official Documentation

While Laravel does not dictate which JavaScript or CSS pre-processors you use, it does provide a basic starting point using [Bootstrap](https://getbootstrap.com/), [React](https://reactjs.org/), and / or [Vue](https://vuejs.org/) that will be helpful for many applications. By default, Laravel uses [NPM](https://www.npmjs.org) to install both of these frontend packages.

The Bootstrap and Vue scaffolding provided by Laravel is located in the `rogervila/laravel-legacy-ui` Composer package, which may be installed using Composer:

    composer require rogervila/laravel-legacy-ui

Once the `rogervila/laravel-legacy-ui` package has been installed, you may install the frontend scaffolding using the `ui` Artisan command:

    // Generate basic scaffolding...
    php artisan ui bootstrap
    php artisan ui vue
    php artisan ui react

    // Generate login / registration scaffolding...
    php artisan ui bootstrap --auth
    php artisan ui vue --auth
    php artisan ui react --auth

Bootstrap scaffolding requires a modification for `webpack.mix.js` file:

    mix.js('resources/js/app.js', 'public/js')
        .sass('resources/sass/app.scss', 'public/css');

The rest of documentation can be found on the [Laravel website](https://laravel.com/docs/7.x/frontend#introduction).

## Contributing

Thank you for considering contributing to UI! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

Please review [our security policy](https://github.com/rogervila/laravel-legacy-ui/security/policy) on how to report security vulnerabilities.

## License

Laravel UI is open-sourced software licensed under the [MIT license](LICENSE.md).
