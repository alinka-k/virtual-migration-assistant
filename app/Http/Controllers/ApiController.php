<?php

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Swagger Api",
 *     version="1.0.0",
 *     @OA\Contact(
 *          email="alexeymarkov.x7@gmail.com"
 *     )
 * )
 * @OA\Schemes(format="http")
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 * ),
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_PROD_HOST,
 *      description="Production Server"
 *  )
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_DEV_HOST,
 *      description="Development Server"
 *  )
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Local Server"
 *  )
 * @OA\Tag(name="auth")
 * @OA\Tag(name="profile")
 * @OA\Tag(name="evaluate")
 * @OA\Tag(name="virtual-profile")
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
