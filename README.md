<h1 align="center">Setting-Profile</h1>

This package provides is an implementation of setting profile in repository pattern for Lumen and Laravel.

Getting Started
---

Installation :

```
$ composer require tripteki/laravelphp-setting-profile
```

How to use it :

- Put `Tripteki\SettingProfile\Providers\SettingProfileServiceProvider` to service provider configuration list.

- Put `Tripteki\SettingProfile\Traits\ProfileTrait` to auth's provider model.

- Migrate.

```
$ php artisan migrate
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

Author
---

- Trip Teknologi ([@tripteki](https://linkedin.com/company/tripteki))
- Hasby Maulana ([@hsbmaulana](https://linkedin.com/in/hsbmaulana))
