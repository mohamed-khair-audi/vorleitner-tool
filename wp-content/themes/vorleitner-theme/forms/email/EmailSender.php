<?php
defined('ABSPATH') || exit;

class EmailSender
{
    public function send(array $dfEmailData): bool
    {
        $dfHeaders = ['Content-Type: text/html; charset=UTF-8'];

        return wp_mail(
            $dfEmailData['recipients'],
            $dfEmailData['subject'],
            $dfEmailData['body'],
            $dfHeaders,
            $dfEmailData['attachments']
        );
    }
}
