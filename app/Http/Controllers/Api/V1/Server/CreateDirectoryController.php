<?php

namespace App\Http\Controllers\Api\V1\Server;

use App\Http\Controllers\Controller;
use App\Http\Requests\Servers\CeeateDirectoryRequest;
use Domain\Parspack\Actions\Servers\CreateDirectoryServer;
use Domain\Parspack\Concerns\Interfaces\Server\SshInterface;
use Domain\Parspack\Factories\Servers\DirectoryOrFileFactory;
use Illuminate\Http\Response;
use Infrastructure\Http\Responses\ApiResponse;

class CreateDirectoryController extends Controller
{
    public function __invoke(CeeateDirectoryRequest $request, SshInterface $ssh)
    {
        $directoryValueObject = DirectoryOrFileFactory::create($ssh, $request->validated());
        $directoryCreatedBefor = CreateDirectoryServer::handle($directoryValueObject);


        if ($directoryCreatedBefor) {
            return ApiResponse::handle(
                message: 'the directory was created before',
                status: Response::HTTP_FORBIDDEN,
            );
        }

        return ApiResponse::handle(
            message: 'the directory was created',
            status: Response::HTTP_ACCEPTED,
        );
    }
}
