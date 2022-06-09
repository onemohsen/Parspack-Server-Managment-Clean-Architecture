<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\RegisterRequest;
use App\Http\Resources\UserResource;
use Domain\Shared\Actions\Users\RegisterUser;
use Domain\Shared\Factories\UserFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Infrastructure\Http\Responses\ApiResponse;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        $user = RegisterUser::handle(
            UserFactory::create($request->validated())
        );

        return ApiResponse::handle(
            data: UserResource::make($user),
            message: 'register success',
            status: Response::HTTP_ACCEPTED,
        );
    }
}
