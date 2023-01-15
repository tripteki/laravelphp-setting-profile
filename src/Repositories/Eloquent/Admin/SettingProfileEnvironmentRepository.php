<?php

namespace Tripteki\SettingProfile\Repositories\Eloquent\Admin;

use Error;
use Exception;
use Illuminate\Support\Facades\DB;
use Tripteki\SettingProfile\Scopes\ProfileStrictScope;
use Tripteki\SettingProfile\Models\Admin\Environment;
use Tripteki\SettingProfile\Http\Resources\EnvironmentResource;
use Tripteki\SettingProfile\Contracts\Repository\Admin\ISettingProfileEnvironmentRepository;
use Tripteki\RequestResponseQuery\QueryBuilder;

class SettingProfileEnvironmentRepository implements ISettingProfileEnvironmentRepository
{
    /**
     * @param array $querystring|[]
     * @return mixed
     */
    public function all($querystring = [])
    {
        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(Environment::class)->
        defaultSort("variable")->
        allowedSorts([ "variable", "value", ])->
        allowedFilters([ "variable", "value", ])->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return EnvironmentResource::collection($content);
    }

    /**
     * @param int|string $identifier
     * @param array $querystring|[]
     * @return mixed
     */
    public function get($identifier, $querystring = [])
    {
        $content = Environment::findOrFail(ProfileStrictScope::space($identifier));

        return new EnvironmentResource($content);
    }

    /**
     * @param int|string $identifier
     * @param array $data
     * @return mixed
     */
    public function update($identifier, $data)
    {
        $content = Environment::findOrFail(ProfileStrictScope::space($identifier));

        DB::beginTransaction();

        try {

            $content->update($data);

            DB::commit();

        } catch (Exception $exception) {

            DB::rollback();
        }

        return new EnvironmentResource($content);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create($data)
    {
        $content = null;

        DB::beginTransaction();

        try {

            if (isset($data["variable"])) $data["variable"] = ProfileStrictScope::space($data["variable"]);

            $content = Environment::create($data);

            DB::commit();

        } catch (Exception $exception) {

            DB::rollback();
        }

        return new EnvironmentResource($content);
    }

    /**
     * @param int|string $identifier
     * @return mixed
     */
    public function delete($identifier)
    {
        $content = Environment::findOrFail(ProfileStrictScope::space($identifier));

        DB::beginTransaction();

        try {

            $content->delete();

            DB::commit();

        } catch (Exception $exception) {

            DB::rollback();
        }

        return new EnvironmentResource($content);
    }
};
