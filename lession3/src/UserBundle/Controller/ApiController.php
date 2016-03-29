<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api")
 */
class ApiController extends Controller
{
    /**
     * @Route("/hello", name="api_hello")
     */
    public function helloAction()
    {
        $response = new JsonResponse();
        $response->setData(array(
            'say' => 'Hello Api Authentication'
        ));

        return $response;
    }
}
