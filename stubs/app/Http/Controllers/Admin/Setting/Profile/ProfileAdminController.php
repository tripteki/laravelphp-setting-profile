<?php

namespace App\Http\Controllers\Admin\Setting\Profile;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Tripteki\SettingProfile\Contracts\Repository\Admin\ISettingProfileEnvironmentRepository;
use App\Http\Requests\Admin\Settings\Profiles\ProfileShowValidation;
use App\Http\Requests\Admin\Settings\Profiles\ProfileStoreValidation;
use App\Http\Requests\Admin\Settings\Profiles\ProfileUpdateValidation;
use App\Http\Requests\Admin\Settings\Profiles\ProfileDestroyValidation;
use Tripteki\Helpers\Http\Controllers\Controller;

class ProfileAdminController extends Controller
{
    /**
     * @var \Tripteki\SettingProfile\Contracts\Repository\Admin\ISettingProfileEnvironmentRepository
     */
    protected $profileAdminRepository;

    /**
     * @param \Tripteki\SettingProfile\Contracts\Repository\Admin\ISettingProfileEnvironmentRepository $profileAdminRepository
     * @return void
     */
    public function __construct(ISettingProfileEnvironmentRepository $profileAdminRepository)
    {
        $this->profileAdminRepository = $profileAdminRepository;
    }

    /**
     * @OA\Get(
     *      path="/admin/profiles",
     *      tags={"Admin Profile"},
     *      summary="Index",
     *      @OA\Parameter(
     *          required=false,
     *          in="query",
     *          name="limit",
     *          description="Profile's Pagination Limit."
     *      ),
     *      @OA\Parameter(
     *          required=false,
     *          in="query",
     *          name="current_page",
     *          description="Profile's Pagination Current Page."
     *      ),
     *      @OA\Parameter(
     *          required=false,
     *          in="query",
     *          name="order",
     *          description="Profile's Pagination Order."
     *      ),
     *      @OA\Parameter(
     *          required=false,
     *          in="query",
     *          name="filter[]",
     *          description="Profile's Pagination Filter."
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success."
     *      )
     * )
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $data = [];
        $statecode = 200;

        $data = $this->profileAdminRepository->all();

        return iresponse($data->resource, $statecode);
    }

    /**
     * @OA\Get(
     *      path="/admin/profiles/{variable}",
     *      tags={"Admin Profile"},
     *      summary="Show",
     *      @OA\Parameter(
     *          required=true,
     *          in="path",
     *          name="variable",
     *          description="Profile's Variable."
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success."
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found."
     *      )
     * )
     *
     * @param \App\Http\Requests\Admin\Settings\Profiles\ProfileShowValidation $request
     * @param string $variable
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ProfileShowValidation $request, $variable)
    {
        $form = $request->validated();
        $data = [];
        $statecode = 200;

        $data = $this->profileAdminRepository->get($variable);

        return iresponse($data, $statecode);
    }

    /**
     * @OA\Post(
     *      path="/admin/profiles",
     *      tags={"Admin Profile"},
     *      summary="Store",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="variable",
     *                      type="string",
     *                      description="Profile's Variable."
     *                  ),
     *                  @OA\Property(
     *                      property="value",
     *                      type="string",
     *                      description="Profile's Value."
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Created."
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity."
     *      )
     * )
     *
     * @param \App\Http\Requests\Admin\Settings\Profiles\ProfileStoreValidation $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProfileStoreValidation $request)
    {
        $form = $request->validated();
        $data = [];
        $statecode = 202;

        $data = $this->profileAdminRepository->create($form);

        if ($data) {

            $statecode = 201;
        }

        return iresponse($data, $statecode);
    }

    /**
     * @OA\Put(
     *      path="/admin/profiles/{variable}",
     *      tags={"Admin Profile"},
     *      summary="Update",
     *      @OA\Parameter(
     *          required=true,
     *          in="path",
     *          name="variable",
     *          description="Profile's Variable."
     *      ),
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="value",
     *                      type="string",
     *                      description="Profile's Value."
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Created."
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity."
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found."
     *      )
     * )
     *
     * @param \App\Http\Requests\Admin\Settings\Profiles\ProfileUpdateValidation $request
     * @param string $variable
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProfileUpdateValidation $request, $variable)
    {
        $form = $request->validated();
        $data = [];
        $statecode = 202;

        $data = $this->profileAdminRepository->update($variable, [ "value" => $form["value"], ]);

        if ($data) {

            $statecode = 201;
        }

        return iresponse($data, $statecode);
    }

    /**
     * @OA\Delete(
     *      path="/admin/profiles/{variable}",
     *      tags={"Admin Profile"},
     *      summary="Destroy",
     *      @OA\Parameter(
     *          required=true,
     *          in="path",
     *          name="variable",
     *          description="Profile's Variable."
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success."
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity."
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found."
     *      )
     * )
     *
     * @param \App\Http\Requests\Admin\Settings\Profiles\ProfileDestroyValidation $request
     * @param string $variable
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ProfileDestroyValidation $request, $variable)
    {
        $form = $request->validated();
        $data = [];
        $statecode = 202;

        $data = $this->profileAdminRepository->delete($variable);

        if ($data) {

            $statecode = 200;
        }

        return iresponse($data, $statecode);
    }
};
