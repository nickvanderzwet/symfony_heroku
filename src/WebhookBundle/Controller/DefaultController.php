<?php

namespace WebhookBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $response = [];
        $data = $this->getContentAsArray($request);
        $result = $data->get('result');

        switch ($result['action']) {
            case 'webhook' :
                $response = $this->getDistanceBetweenCities($result);
                break;
        }

        return new JsonResponse($response);
    }

    protected function getContentAsArray(Request $request)
    {
        $content = $request->getContent();

        if (empty($content)) {
            throw new BadRequestHttpException('Content is empty');
        }

        //if(!Validation::isValidJsonString($content)){
        //    throw new BadRequestHttpException("Content is not a valid json");
        //}

        return new ArrayCollection(json_decode($content, true));
    }

    protected function getDistanceBetweenCities($result)
    {
        $city1 = $result['parameters']['geo-city1'];
        $city2 = $result['parameters']['geo-city2'];

        $data = [
            'speech' => 'Test from '.$city1.' to '.$city2,
            'displayText' => 'Test from'.$city1.' to '.$city2,
            'source' => 'serene-beach-72762',
        ];

        return $data;
    }
}
