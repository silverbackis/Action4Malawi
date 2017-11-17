<?php

namespace App\Utils;

class MailerUtils
{
    /**
     * @param string|null $subject
     * @param string|null $replyTo
     * @param string|null $htmlBody
     * @return \Swift_Message
     */
    public static function createSwiftMessage(string $subject = null, string $replyTo = null, string $htmlBody = null): \Swift_Message
    {
        return (new \Swift_Message($subject))
            ->setFrom(['website@action4malawi.com' => 'Action 4 Malawi'])
            ->setTo('ahw@action4malawi.com')
            ->setReplyTo($replyTo)
            ->setBody(
                $htmlBody,
                'text/html'
            )
        ;
    }
}