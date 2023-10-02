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
     */
    public function handle(Request $request): Response
    {
        // Extract the path from the request, e.g. "/gre-vocab-fc"
        $pathInfo = $request->getPathInfo();
        $pathInfoArr = explode("/",trim($pathInfo,"/"));
        //var_dump($pathInfoArr);
        $pathInfo = preg_replace('/\/$/', '', $pathInfo);
        
        // @TODO: validate request
        $content=NULL;
        
        if (isset($pathInfoArr[0]))
          {
          
          switch ($pathInfoArr[0])
            {
            // Admin Area
            case "admin" : $content = $this->adminAreaController->example(); break;
            // GRE Flashcards
            case "gre-vocab-fc" : $content = $this->flashCardController->example($pathInfo); break;
            // SAT Flashcards
            case "sat-vocab-fc" : $content = $this->flashCardController->example($pathInfo); break;
            // Practice Questions
            case "free-practice-questions" : $content = "[FREE PRACTICE QUESTIONS]"; break;
            }
          
          }
        
        // Prepare the response
        $response = new Response();
        
        if ($content)
          {
          
          $response->headers->set('Content-Type', 'text/html');
          
          // Output the data
          $response->setContent($content);
          
          // Response status code: 200 OK
          $response->setStatusCode(Response::HTTP_OK);
          
          }
        else
          {
          
          $response->headers->set('Content-Type', 'text/plain');
          
          $response->setContent('Error: Path or Content not found');
          
          // Response status code: 404 Not Found
          $response->setStatusCode(Response::HTTP_NOT_FOUND);
          
          }

        return $response;
    }
}
