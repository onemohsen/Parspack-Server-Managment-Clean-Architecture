<?php

namespace App\Http\Controllers\Api\V1\Server;

use App\Http\Controllers\Controller;
use App\Http\Resources\Command\ListFileCommandResource;
use Domain\Parspack\Actions\Servers\GetListFilesServer;
use Domain\Parspack\Concerns\Interfaces\Server\SshInterface;
use Domain\Parspack\Factories\Servers\CommandParserFactory;
use Illuminate\Http\Response;
use Infrastructure\Http\Responses\ApiResponse;

class ListFilesController extends Controller
{
    public function __invoke(SshInterface $ssh, CommandParserFactory $commandParserFactory)
    {
        $data = GetListFilesServer::handle($ssh, $commandParserFactory);

        return ApiResponse::handle(
            data: ListFileCommandResource::collection($data),
            message: 'success',
            status: Response::HTTP_OK,
        );
    }
}
