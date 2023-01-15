<?php

namespace Tripteki\SettingProfile\Console\Commands;

use Tripteki\Helpers\Contracts\AuthModelContract;
use Tripteki\Helpers\Helpers\ProjectHelper;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = "adminer:install:setting:profile";

    /**
     * @var string
     */
    protected $description = "Install the setting profile stack";

    /**
     * @var \Tripteki\Helpers\Helpers\ProjectHelper
     */
    protected $helper;

    /**
     * @param \Tripteki\Helpers\Helpers\ProjectHelper $helper
     * @return void
     */
    public function __construct(ProjectHelper $helper)
    {
        parent::__construct();

        $this->helper = $helper;
    }

    /**
     * @return int
     */
    public function handle()
    {
        $this->call("adminer:install:setting");
        $this->installStack();

        return 0;
    }

    /**
     * @return int|null
     */
    protected function installStack()
    {
        (new Filesystem)->ensureDirectoryExists(base_path("routes/user"));
        (new Filesystem)->ensureDirectoryExists(base_path("routes/admin"));
        (new Filesystem)->ensureDirectoryExists(base_path("routes/user/setting"));
        (new Filesystem)->ensureDirectoryExists(base_path("routes/admin/setting"));
        (new Filesystem)->copy(__DIR__."/../../../stubs/routes/user/setting/profile.php", base_path("routes/user/setting/profile.php"));
        (new Filesystem)->copy(__DIR__."/../../../stubs/routes/admin/setting/profile.php", base_path("routes/admin/setting/profile.php"));
        $this->helper->putRoute("api.php", "user/setting/profile.php");
        $this->helper->putRoute("api.php", "admin/setting/profile.php");
        
        (new Filesystem)->ensureDirectoryExists(app_path("Http/Controllers/Setting/Profile"));
        (new Filesystem)->copyDirectory(__DIR__."/../../../stubs/app/Http/Controllers/Setting/Profile", app_path("Http/Controllers/Setting/Profile"));
        (new Filesystem)->ensureDirectoryExists(app_path("Http/Requests/Settings/Profiles"));
        (new Filesystem)->copyDirectory(__DIR__."/../../../stubs/app/Http/Requests/Settings/Profiles", app_path("Http/Requests/Settings/Profiles"));
        (new Filesystem)->ensureDirectoryExists(app_path("Http/Controllers/Admin/Setting/Profile"));
        (new Filesystem)->copyDirectory(__DIR__."/../../../stubs/app/Http/Controllers/Admin/Setting/Profile", app_path("Http/Controllers/Admin/Setting/Profile"));
        (new Filesystem)->ensureDirectoryExists(app_path("Imports/Settings/Profiles"));
        (new Filesystem)->copyDirectory(__DIR__."/../../../stubs/app/Imports/Settings/Profiles", app_path("Imports/Settings/Profiles"));
        (new Filesystem)->ensureDirectoryExists(app_path("Exports/Settings/Profiles"));
        (new Filesystem)->copyDirectory(__DIR__."/../../../stubs/app/Exports/Settings/Profiles", app_path("Exports/Settings/Profiles"));
        (new Filesystem)->ensureDirectoryExists(app_path("Http/Requests/Admin/Settings/Profiles"));
        (new Filesystem)->copyDirectory(__DIR__."/../../../stubs/app/Http/Requests/Admin/Settings/Profiles", app_path("Http/Requests/Admin/Settings/Profiles"));
        (new Filesystem)->ensureDirectoryExists(app_path("Http/Responses"));

        $this->helper->putTrait($this->helper->classToFile(get_class(app(AuthModelContract::class))), \Tripteki\SettingProfile\Traits\ProfileTrait::class);

        $this->info("Adminer Setting Profile scaffolding installed successfully.");
    }
};
