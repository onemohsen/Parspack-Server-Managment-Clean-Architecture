<?php

namespace App\Http\Controllers\Api\V1\Server;

use App\Http\Controllers\Controller;
use App\Http\Requests\Servers\CeeateFileRequest;
use Domain\Parspack\Actions\Servers\CreateDirectoryServer;
use Domain\Parspack\Concerns\Interfaces\Server\SshInterface;
use Domain\Parspack\Factories\Servers\DirectoryOrFileFactory;
use Illuminate\Http\Response;
use Infrastructure\Http\Responses\ApiResponse;

class CreateFileController extends Controller
{
    public function __invoke(CeeateFileRequest $request, SshInterface $ssh)
    {
        $fileValueObject = DirectoryOrFileFactory::create($ssh, $request->validated());
        $fileCreatedBefor = CreateDirectoryServer::handle($fileValueObject);

        if ($fileCreatedBefor) {
            return ApiResponse::handle(
                message: 'the file was created before',
                status: Response::HTTP_FORBIDDEN,
            );
        }
        return ApiResponse::handle(
            message: 'the file was created',
            status: Response::HTTP_ACCEPTED,
        );
    }
}
