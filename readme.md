## How to Install this to your local
<ol>
  <li>Download and install <a href="https://getcomposer.org/Composer-Setup.exe" target="_blank"> Composer </a> </li>
  <li>Download and install <a href="https://www.apachefriends.org/download.html" target="_blank">XAMPP Control Panel</a> or <a href="https://laragon.org/" target="_blank">Laragon</a> </li>
  <li>After finishing the installation of Composer and Xampp/Laragon, open command prompt</li>
  <li>Change directory where you want to save the files <i>(Ex. cd C:\Documents\Projects\)</i></li>
  <li>Run this command <code>git clone https://github.com/kontrasenyas/web </code> to download this repository</li>
  <li>In your current directory (Ex. C:\Documents\Projects\), change again your directory to <code>web</code> (Ex. cd web) - this will change your directory to the current working directory or the website. (Ex. C:\Documents\Projects\web)</li>
  <li>Run this command: <code>composer update</code> in your current directory (Ex. C:\Documents\Projects\web)</li>
  <li>Wait until the composer finish the downloading and installing of php dependecies to your computer.</li>
  <li>Go to <code>C:\Documents\Projects\web</code> then copy <code>env.example</code> and save it as <code>.env</code></li>
  <li>Edit the <code>.env</code> suitable for your settings.</li>
  <li>Run <code>php artisan migrate</code></li>
  <li>Run <code>php aritsan db:seed</code></li>
  <li>Now lets run the website, run <code>php artisan serve</code></li>
  <li>Go to your browser and type <code>http://127.0.0.1:8000/</code></li>
</ol>  
  

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
"# web" 
