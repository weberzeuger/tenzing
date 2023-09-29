<?php
declare(strict_types=1);

namespace ManhattanReview\Tenzing\Core;

use ManhattanReview\Tenzing\Controller\FlashCardController;
use ManhattanReview\Tenzing\Controller\AdminAreaController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestHandler
{
    private AdminAreaController $adminAreaController;
    private FlashCardController $flashCardController;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->adminAreaController = new AdminAreaController();
        $this->flashCardController = new FlashCardController();
    }

    /**
     * Process the request and return the response
     * TEST2
     */
    public function handle(Request $request): Response
    {
        // Extract the path from the request, e.g. "/gre-vocab-fc"
        $pathInfo = $request->getPathInfo();
        $pathInfo = preg_replace('/\/$/', '', $pathInfo);

        // @TODO: validate request

        if ($pathInfo === '/admin') {
            // Admin Area
            $foobar = $this->adminAreaController->example();

        } else {
            // Pass the path to the controller
            $foobar = $this->flashCardController->example($pathInfo);
        }

        // Prepare the response
        $response = new Response();
        $response->headers->set('Content-Type', 'text/plain');

        // Output the data or the keyword "unknown" if no data is availabel
        $response->setContent('Data: ' . ($foobar ?: 'unknown'));

        if ($foobar) {
            // Response status code: 200 OK
            $response->setStatusCode(Response::HTTP_OK);
        } else {
            // Response status code: 404 Not Found
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }
}
