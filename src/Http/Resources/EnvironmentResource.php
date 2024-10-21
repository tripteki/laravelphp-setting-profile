<?php

namespace Tripteki\SettingProfile\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\JsonResource;
use Tripteki\SettingProfile\Scopes\ProfileStrictScope;
use Illuminate\Support\Str;

class EnvironmentResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            "variable" => Str::replaceFirst(ProfileStrictScope::space(null), "", $this->variable ?? $this->key),
            "value" => $this->value,
        ];
    }
};
