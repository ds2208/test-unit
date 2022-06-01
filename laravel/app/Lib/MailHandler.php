<?php

namespace App\Lib;

use Illuminate\Mail\PendingMail;
use Illuminate\Support\Facades\Mail;


class MailHandler
{
    protected $status = false;
    protected $receiver;
    protected $params = [];


    /**
     * Constructor
     * @param string $mailer = 'log'
     */
    public function __construct($receiver, $params = [])
    {
        $this->receiver = $receiver;
        $this->params = $params;
    }

    //EXECUTE

    /**
     * Function sending mail with params
     * @param Mailable @mailClass
     * @param Array @mailParams
     */
    public function sendMail($mailClass)
    {
        if (!$mailClass) {
            return;
        }
        
        try {
            $mail = $this->createAndPrepareMail();

            if ($mail instanceof PendingMail) {
                $mail->send(new $mailClass($this->params));
                $this->status = true;
            }
        } catch (\Throwable $th) {
            logger('Mail errors: ' . $th->getMessage());
        }
    }

    /**
     * Function return value of status
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * Function return created mail and prepared mail for sending
     * @return Mail
     */
    protected function createAndPrepareMail()
    {
        if ($this->receiver) {
            return Mail::to($this->receiver);
        }
    }
}
