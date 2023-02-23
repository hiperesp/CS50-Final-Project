<?php declare(strict_types=1);

namespace app\controller;

use app\model\OpenGraph;
use hiperesp\framework\system\router\attributes\Middleware;
use hiperesp\framework\system\router\attributes\Route;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

#[Route(pattern: "")]
class AppController extends Controller {
    
    #[Middleware]
    public function middleware(Request $request, RequestHandler $handler): Response {
        $response = $handler->handle($request);
        return $response;
    }

    #[Route(method: Route::GET, pattern: "/")]
    public function list(Request $request, Response $response): Response {
        
        return $this->view($request)->render($response, 'pages/index.twig', [
        ]);
    }

    #[Route(method: Route::GET, pattern: "/preview")]
    public function preview(Request $request, Response $response): Response {

        $url = @$request->getQueryParams()["url"];
        if($url) {
            $openGraph = OpenGraph::fromUrl($request->getQueryParams()["url"]);
        } else {
            $image = @$request->getQueryParams()["image"];
            $title = @$request->getQueryParams()["title"];
            $description = @$request->getQueryParams()["description"];
            $html = <<<HTML
            <meta property="og:image" content="{$image}">
            <meta property="og:title" content="{$title}">
            <meta property="og:description" content="{$description}">
            HTML;
            $openGraph = OpenGraph::fromHtml($html);
        }

        return $this->view($request)->render($response, 'pages/preview.twig', [
            'data' => $openGraph->extract()->jsonSerialize()
        ]);
    }

}