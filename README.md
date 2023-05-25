# ncastell_projecte
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
## INICIA EL PROJECTE PER PRIMERA VEGADA.

<p align="left">
#1 Duplicar el fitxer .env.example i cambiar el nom a .env
<br>
#2 Configurar credencials base de dades
<br>
#3 Fer Composer Install (Nunca composer update)
<br>
#4 Fer npm Install
<br>
#5 Per ficar en funcionament el projecte docker-compose up -d
<br>
#6 Fer la comanda npm run dev
</p>

## INICIA EL PROJECTE PER PRIMERA VEGADA WINDOWS.
<p align="left">
#1 Duplicar el fitxer .env.example i cambiar el nom a .env
<br>
#2 Configurar credencials base de dades
<br>
#3 Fer Composer Install (Nunca composer update)
<br>
#4 Fer npm Install
<br>
#5 Instalar WSL 2 en docker y ubuntu 20.04 en microsoft store
<br>
#6 Per ficar en funcionament el projecte executar en la terminal de ubuntu dins del projecte sail up -d
<br>
#7 Fer la comanda npm run dev
</p>


## Sobre la instal·lació

<p align="left">
<a href="https://www.youtube.com/watch?v=i0LOihS_RDk">Per instal·lar laravel Sail amb docker s'ha utilitzat aquesta guía.</a>
</p>

## Generar LARAVEL KEY en fitxer .env

<p align="left">
Generar LARAVEL KEY PROJECT
<br>
<a href="https://stillat.com/blog/2016/12/07/laravel-artisan-key-command-the-keygenerate-command">Web amb explicació.</a>
<br>
<p>comanda: php artisan key:generate</p>


## Solució Problemes Composer Install

<p align="left">
Versió desactualitzada de composer.
<br>
<a href="https://www.codifica.me/actualizar-composer-a-composer-2-ubuntu/">Actualitzar composer a composer 2 en UBUNTU.</a>
<br>
Curl is missing from your system
<br>
<a href="https://websolutionstuff.com/post/require-ext-curl-is-missing-from-your-system-ubuntu">Afegir php-curl</a>
<br>
Curl is missing from your system
<br>
<a href="https://websolutionstuff.com/post/require-ext-curl-is-missing-from-your-system-ubuntu">Invalid Group id sail</a>
</p>

## Solució Problemes Docker Compose Up

<h1>## ERROR INVALID WWWGROUP ID</h1>
<p align="left">
Afegir aquestes linies al fitxer .env
<br>
WWWGROUP=1000
WWWUSER=1000
<br>
<a href="https://stackoverflow.com/questions/67224488/laravel-sail-wont-build-on-ubuntu-20-04-groupadd-invalid-group-id-sail">Invalid Group id sail</a>
</p>

## Solució Problemes socket 

<h1>## Could not create Unix socket lock file</h1>
<p align="left">
Error response from daemon: driver failed programming external connectivity on endpoint failed: port is already allocated<br>
<br>
<a href="https://dejuniorasenior.com/problema-con-conexion-a-base-de-datos-en-laravel-sail/">Solve problen Unix socket lock file</a>
#       docker system prune -a
1. docker composer down -v
2. php artisan config:cache
</p>


## Solució errors migracions o connection refused en la web

<h1>## ERROR MIGRACIÓ</h1>
<p align="left">
Modificar aquesta linia del fitxer .env
<br>
DB_HOST=127.0.0.1
<br>
</p>

<h1>## ERROR CONNECTION REFUSED</h1>
<p align="left">
Modificar aquesta linia del fitxer .env
<br>
DB_HOST=mysql
<br>
</p>
