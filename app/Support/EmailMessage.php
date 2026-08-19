<?php

namespace App\Support;

class EmailMessage
{
    /**
     * @param  list<string>  $cc
     * @param  list<string>  $attachments
     */

    public function __construct(
        public string $to,
        public string $subject,
        public string $body,
        public array $cc = [],
        public array $attachments = [],
    ){}
}