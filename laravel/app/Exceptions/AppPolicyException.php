<?php

namespace App\Exceptions;

class AppPolicyException extends \Exception 
{
    protected $message_type;

    public function __construct($message, $type='danger')
    {
        parent::__construct($message);
        $this->message_type = $type;
    }

    public function getMessageType()
    {
        return $this->message_type;
    }
}