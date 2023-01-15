<?php

namespace Tripteki\SettingProfile\Repositories\Eloquent;

use Error;
use Exception;
use Illuminate\Support\Facades\DB;
use Tripteki\Setting\Models\Setting;
use Tripteki\SettingProfile\Models\Admin\Environment;
use Tripteki\SettingProfile\Http\Resources\EnvironmentResource;
use Tripteki\Repository\AbstractRepository;
use Tripteki\SettingProfile\Events\Profiling;
use Tripteki\SettingProfile\Events\Profiled;
use Tripteki\Setting\Contracts\Repository\ISettingRepository;
use Tripteki\SettingProfile\Contracts\Repository\Admin\ISettingProfileEnvironmentRepository;
use Tripteki\SettingProfile\Contracts\Repository\ISettingProfileRepository;

class SettingProfileRepository extends AbstractRepository implements ISettingProfileRepository
{
    /**
     * @var \Tripteki\Setting\Contracts\Repository\ISettingRepository
     */
    protected $setting;

    /**
     * @var \Tripteki\SettingProfile\Contracts\Repository\Admin\ISettingProfileEnvironmentRepository
     */
    protected $environment;

    /**
     * @param \Tripteki\Setting\Contracts\Repository\ISettingRepository $setting
     * @param \Tripteki\SettingProfile\Contracts\Repository\Admin\ISettingProfileEnvironmentRepository $environment
     * @return void
     */
    public function __construct(ISettingRepository $setting, ISettingProfileEnvironmentRepository $environment)
    {
        $this->setting = $setting;
        $this->environment = $environment;
    }

    /**
     * @return void
     */
    public function __destruct()
    {}

    /**
     * @param array $querystring|[]
     * @return mixed
     */
    public function all($querystring = [])
    {
        $user = $this->user; $content = null;

        $environment = Environment::whereNotIn("variable", $user->hasManyThrough(Environment::class, Setting::class, foreignKeyName($user), "variable", "id", "key")->pluck("variable"));
        $setting = $user->profile()->select("key AS variable", "value")->getQuery();

        $content = $setting->union($environment)->get();

        return EnvironmentResource::collection($content);
    }

    /**
     * @param int|string|null $identifier
     * @param string $data
     * @return mixed
     */
    public function update($identifier, $data)
    {
        $this->setting->setUser($this->getUser());

        $content = $this->setting->setup($this->environment->get($identifier)->variable, $data);

        event(new Profiled($content));

        return new EnvironmentResource($content);
    }
};
