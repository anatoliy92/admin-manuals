# admin-manuals

### Информация

Справочный модуль заточенный для CMS IRsite.

### Установка

```
$ composer require avl/admin-manuals
```
Или в секцию **require** добавить строчку **"avl/admin-manuals": "^1.0"**

```json
{
    "require": {
        "avl/admin-manuals": "^1.0"
    }
}
```
### Настройка

Для публикации файла настроек необходимо выполнить команду:

```
$ php artisan vendor:publish --provider="Avl\AdminManuals\AdminManualsServiceProvider" --force
```
