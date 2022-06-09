<?php

namespace App\Http\Controllers\Api\V1\Server;

use App\Http\Controllers\Controller;
use App\Http\Resources\Command\ListDirectoryCommandResource;
use Domain\Parspack\Actions\Servers\GetListDirectoriesServer;
use Domain\Parspack\Concerns\Interfaces\Server\SshInterface;
use Domain\Parspack\Factories\Servers\CommandParserFactory;
use Illuminate\Http\Response;
use Infrastructure\Http\Responses\ApiResponse;

class ListDirectoriesController extends Controller
{
    public function __invoke(SshInterface $ssh, CommandParserFactory $commandParserFactory)
    {
        $data = GetListDirectoriesServer::handle($ssh, $commandParserFactory);

        return ApiResponse::handle(
            data: ListDirectoryCommandResource::collection($data),
            message: 'success',
            status: Response::HTTP_OK,
        );
    }
}
