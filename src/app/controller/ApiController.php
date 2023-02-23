<?php declare(strict_types=1);

namespace app\controller;

use hiperesp\framework\system\router\attributes\Middleware;
use hiperesp\framework\system\router\attributes\Route;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

#[Route(pattern: "/api")]
class ApiController extends Controller {

    #[Middleware]
    public function middleware(Request $request, RequestHandler $handler): Response {
        $response = $handler->handle($request);
        return $response;
    }

    #[Route(method: Route::GET, pattern: "/preview-open-graph")]
    public function getOpenGraphPreview(Request $request, Response $response): Response {
        $url = $request->getQueryParams()["url"];

        $response->getBody()->write(
            \json_encode(
                \app\model\OpenGraph::fromUrl($url)->extract()
            )
        );

        return $response;
    }


}