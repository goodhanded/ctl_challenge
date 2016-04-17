<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('AppBundle:default:index.html.twig');
    }

    /**
     * @Route("/tracker/{itemName}/{count}/{direction}", name="track", requirements={"count":"\d+","direction":"up|down"})
     * @Method({"GET","POST"})
     */
    public function trackAction($itemName, $count, $direction)
    {

        // Convert downs to a negative count.
        if ($direction == 'down') {
            $count = 0 - $count;
        }

        // Utilize PipelineBundle service to track the item.
        if ($error = $this->get('goodhanded_pipeline.tracker')->track($itemName, $count))
        {
            // Render error page if error exists.
            return $this->render('AppBundle:default:error.html.twig', array(
                'item' => $itemName,
                'error' => $error
            ));
        }

        // No error, so return a success page.
        return $this->render('AppBundle:default:track.html.twig', array(
            'item' => $itemName,
            'count' => $count,
            'direction' => $direction
        ));
    }
}
