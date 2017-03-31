<?php

namespace WebhookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $data = [
            'speech' => 'Test from serene-beach-72762',
            'displayText' => 'Test from serene-beach-72762',
            'source' => 'serene-beach-72762',
        ];
        return new JsonResponse($data);
    }
}
