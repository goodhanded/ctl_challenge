<?php

namespace Goodhanded\TriggerBundle\Actions;

use Symfony\Component\EventDispatcher\Event;

class EvenNumberEmailAction extends EmailAction
{
	public function act(Event $event)
	{
        $message = \Swift_Message::newInstance()
            ->setSubject($event->getItem()->getName() . ' has an even number of items!')
            ->setFrom('keith.a.morris@gmail.com')
            ->setTo('keith.a.morris@gmail.com')
            ->setBody(
                $this->twig->render('GoodhandedTriggerBundle:Mailer:even_number.html.twig', array(
                    'event'=>$event
                )),
                'text/html'
            )
        ;
        $this->mailer->send($message);
	}
}