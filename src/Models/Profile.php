<?php

namespace Tripteki\SettingProfile\Models;

use Tripteki\SettingProfile\Scopes\ProfileStrictScope;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    const CREATED_AT = null;
    const UPDATED_AT = "updated_at";

    /**
     * @var string
     */
    protected $table = "settings";

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $keyType = "string";

    /**
     * @var string
     */
    protected $primaryKey = "key";

    /**
     * @var array
     */
    protected $fillable = [ "key", "value", ];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ProfileStrictScope());
    }
};
