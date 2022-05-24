<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    /**
     * @return Response
     */
    #[Route('/api/test', name: 'api_test', methods: ['GET'])]
    public function testAction(): Response
    {
        return new Response('Test string');
    }

}