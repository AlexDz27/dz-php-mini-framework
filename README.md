# dz-php-mini-framework
Technologies: PHP 7, JS (ES 6), Gulp. MVC pattern, OOP paradigm.

Мини-фреймворк, написанный мной :)

Реалиовано:
- OOP
- MVC pattern
- Автолоадинг по стандарту PSR-4 с помощью Composer
- Работа с Exceptions (наследование от них, создание своего метода)
- Система регистрации и аутентификации с возможностью загрузки аватара
- Работа с библиотекой Respect Validation для валидации форма (загружена с помощью Composer)
- Работа с промисами, fetch (Javascript)


Все файлы PHP для приложения хранятся в папке `app/`.

Вообще, тут собирается и фронтэнд, и бэкэнд. Папка front-dev отвечает за часть разработки, потом командой
`gulp build` файлы из этой папки сжимаются, где надо, и и галп переносит их в папку `public`,
в которой содержатся все файлы, с которыми может взаимодействовать юзер.

Front controller - файл index.php. 
Что-то пытался брать из фреймворка Laravel, что-то из доступного в интернете кода, что-то писал сам с нуля.

Реализован autoloading по PSR-4 с помощью Композера:
[composer.json](https://github.com/AlexDz27/dz-php-mini-framework/blob/master/composer.json)

Сделаны свои Эксепшены. Родительские классы модели и контроллера:
[`BaseModel.php`](https://github.com/AlexDz27/dz-php-mini-framework/blob/master/app/classes/models/BaseModel.php),
[`BaseModel.php`](https://github.com/AlexDz27/dz-php-mini-framework/blob/master/app/classes/controllers/BaseController.php)`.


Есть свои вьюхи в папке views. 


Класс со всеми конфигами - [`Config.php`](https://github.com/AlexDz27/dz-php-mini-framework/blob/master/app/classes/services/Config.php)
