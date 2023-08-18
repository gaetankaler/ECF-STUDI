<?php

namespace App\Notification;

use App\Entity\Contact;
use Twig\Environment;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;


class ContactNotification
{



    private MailerInterface $mailer;
    private Environment $renderer;

    public function __construct(MailerInterface $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact)
    {
        $email = (new Email())
            ->from("noreply@garage.com")
            ->to("contact@garage.com")
            ->replyTo($contact->getEmail())
            ->subject("Garage : " . $contact->getVoiture()->getTitle())
            ->html($this->renderer->render("emails/contact.html.twig", [
                "contact" => $contact
            ]));

        $this->mailer->send($email);
    }
}