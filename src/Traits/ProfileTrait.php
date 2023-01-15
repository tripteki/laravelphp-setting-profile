<?php

namespace Tripteki\SettingProfile\Traits;

use Tripteki\SettingProfile\Models\Profile;
use Tripteki\SettingProfile\Models\Admin\Environment;
use Illuminate\Support\Str;

trait ProfileTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function profile()
    {
        return $this->hasMany(Profile::class)->whereIn("key", Environment::pluck("variable"));
    }
};
