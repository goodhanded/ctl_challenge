<?php

namespace Goodhanded\TriggerBundle\Actions;

use Symfony\Component\EventDispatcher\Event;

class OutOfInventoryEmailAction extends EmailAction
{
	public function act(Event $event)
	{
        $message = \Swift_Message::newInstance()
            ->setSubject('Out of ' . $event->getItem()->getName() . ' Inventory')
            ->setFrom('keith.a.morris@gmail.com')
            ->setTo('keith.a.morris@gmail.com')
            ->setBody(
                $this->twig->render('GoodhandedTriggerBundle:Mailer:out_of_inventory.html.twig', array(
                    'event'=>$event
                )),
                'text/html'
            )
        ;
        $this->mailer->send($message);
	}
}