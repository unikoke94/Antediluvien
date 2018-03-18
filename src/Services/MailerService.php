<?php

namespace App\Services;

class MailerService
{
	private $mailer;
	private $twig;

	public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
	{
		$this->mailer = $mailer;
		$this->twig = $twig;
	}

	public function sendMail($form)
	{
		$message = (new \Swift_Message('Demande de contact'))
			->setFrom(array('barriac.thomas@gmail.com' => 'Antédiluvien'))
			->setTo($form['email'])
			->setCharset('UTF-8')
			->setContentType('text/html')
			->setBody($this->twig->render('mail/mail.html.twig', array('contact' => $form)))
		;
		
		$this->mailer->send($message);	


	}
}