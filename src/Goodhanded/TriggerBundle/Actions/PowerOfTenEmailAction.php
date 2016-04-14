<?php

namespace Goodhanded\TriggerBundle\Actions;

use Symfony\Component\EventDispatcher\Event;

class PowerOfTenEmailAction extends EmailAction
{
	public function act(Event $event)
	{
        $message = \Swift_Message::newInstance()
            ->setSubject($event->getItem()->getName() . ' reached a power of 10!')
            ->setFrom('keith.a.morris@gmail.com')
            ->setTo('keith.a.morris@gmail.com')
            ->setBody(
                $this->twig->render('GoodhandedTriggerBundle:Mailer:power_of_ten.html.twig', array(
                    'event'=>$event
                )),
                'text/html'
            )
        ;
        $this->mailer->send($message);
	}
}