<?php

namespace Tripteki\SettingProfile\Scopes;

use Tripteki\Setting\Scopes\StrictScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope as IScope;

class ProfileStrictScope implements IScope
{
    /**
     * @var string
     */
    public static $space = "profile";

    /**
     * @param string $content
     * @return string
     */
    public static function space($content)
    {
        return StrictScope::$space.".".static::$space.".".$content;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $space = static::space("%");

        $builder->where("key", "like", $space);
    }
};
