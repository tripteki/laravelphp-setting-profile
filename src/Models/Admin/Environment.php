<?php

namespace Tripteki\SettingProfile\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Environment extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

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
    protected $primaryKey = "variable";

    /**
     * @var array
     */
    protected $fillable = [ "variable", "value", ];

    /**
     * @var array
     */
    protected $hidden = [];
};
