<?php
declare(strict_types=1);

namespace ManhattanReview\Tenzing\Core;

use Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;

class Bootstrap
{
    /**
     * Constructor
     */
    public function __construct(string $baseDirectory)
    {
        // Load environment variables from the .env file
        $dotenv = Dotenv::createImmutable($baseDirectory);
        $dotenv->safeLoad();
    }

    /**
     * Run the application
     */
    public function run()
    {
        // Create a Symfony HTTP Foundation Request from the incoming HTTP request
        $request = Request::createFromGlobals();

        // Create an instance of the request handler
        $handler = new RequestHandler();

        // Process the request and get the response
        $response = $handler->handle($request);

        // Send the response headers and body to the client
        $response->send();
    }
}
