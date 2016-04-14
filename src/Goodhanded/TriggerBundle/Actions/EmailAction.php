<?php

namespace Goodhanded\TriggerBundle\Actions;

abstract class EmailAction implements ActionInterface
{
    protected $twig;
    protected $mailer;

    public function setTwig($twig)
    {
        $this->twig = $twig;
    }

    public function setMailer($mailer)
    {
    	$this->mailer = $mailer;
    }
}
