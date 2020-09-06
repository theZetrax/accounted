<?php

namespace Accounted\Mail;

use PHPMailer;

class Message
{
	/** @var PHPMailer */
	protected $mailer;

	public function __construct($mailer)
	{
		$this->mailer = $mailer;
	}

	public function to($address)
	{
		$this->mailer->addAddress($address);
	}
	public function subject($subject)
	{
		$this->mailer->Subject = $subject;
	}
	public function body($body)
	{
		$this->mailer->Body = $body;
	}
}