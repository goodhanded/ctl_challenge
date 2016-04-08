<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PipelineController extends Controller
{
    /**
     * @Route("/tracker/{item}/{count}/{direction}", name="track", requirements={"count":"\d+","direction":"up|down"})
     * @Method({"GET","POST"})
     */
    public function trackAction($item, $count, $direction)
    {
        return $this->render('AppBundle:Pipeline:track.html.twig', array(
            'item' => $item,
            'count' => $count,
            'direction' => $direction
        ));
    }

}
