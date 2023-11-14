<h1 align="center">Setting Profile</h1>

This package provides implementation of setting profile in repository pattern for Lumen and Laravel besides REST API starterpack of admin management with no intervention to codebase and keep clean.

Getting Started
---

Installation :

```
composer require tripteki/laravelphp-setting-profile
```

How to use it :

- Put `Tripteki\SettingProfile\Providers\SettingProfileServiceProvider` to service provider configuration list.

- Put `Tripteki\SettingProfile\Providers\SettingProfileServiceProvider::ignoreMigrations()` into `register` provider, then publish migrations file into your project's directory with running (optionally) :

```
php artisan vendor:publish --tag=tripteki-laravelphp-setting-profile-migrations
```

- Migrate.

```
php artisan migrate
```

- Publish tests file into your project's directory with running (optionally) :

```
php artisan vendor:publish --tag=tripteki-laravelphp-setting-profile-tests
```

- Sample :

```php
use Tripteki\SettingProfile\Contracts\Repository\Admin\ISettingProfileEnvironmentRepository;
use Tripteki\SettingProfile\Contracts\Repository\ISettingProfileRepository;

$environmentRepository = app(ISettingProfileEnvironmentRepository::class);

// $environmentRepository->create([ "variable" => "photo", "value" => "...", ]); //
// $environmentRepository->create([ "variable" => "frame", "value" => "...", ]); //
// $environmentRepository->create([ "variable" => "background", "value" => "...", ]); //
// $environmentRepository->create([ "variable" => "headerground", "value" => "...", ]); //
// $environmentRepository->create([ "variable" => "theme", "value" => "...", ]); //
// $environmentRepository->create([ "variable" => "logo", "value" => "...", ]); //
// $environmentRepository->create([ "variable" => "font", "value" => "...", ]); //
// $environmentRepository->delete("font"); //
// $environmentRepository->update("font", [ "value" => "...", ]); //
// $environmentRepository->get("font"); //
// $environmentRepository->all(); //

$repository = app(ISettingProfileRepository::class);
// $repository->setUser(...); //
// $repository->getUser(); //

// $repository->update("photo", "..."); //
// $repository->update("frame", "..."); //
// $repository->update("background", "..."); //
// $repository->update("headerground", "..."); //
// $repository->update("theme", "light"); //
// $repository->update("theme", "dark"); //
// $repository->update("logo", "..."); //
// $repository->update("font", "..."); //
// $repository->all(); //
```

- Generate swagger files into your project's directory with putting this into your annotation configuration (optionally) :

```
base_path("app/Http/Controllers/SettingProfile")
```

```
base_path("app/Http/Controllers/Admin/SettingProfile")
```

Usage
---

`php artisan adminer:install:setting:profile`

Author
---

- Trip Teknologi ([@tripteki](https://linkedin.com/company/tripteki))
- Hasby Maulana ([@hsbmaulana](https://linkedin.com/in/hsbmaulana))
