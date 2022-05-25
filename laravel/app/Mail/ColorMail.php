<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ColorMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    protected $namespace;
    public $subject;
    // protected $attachedFiles;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->data = $params['data'] ?? [];
        $this->namespace = $params['namespace'] ?? 'API.mails.';
        $this->subject = $params['subject'] ?? __("Color Info");
        // $this->attachedFiles = collect(Storage::disk('files')->allFiles('documents'))->toArray();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $build = $this
            ->from('danilo.strahinovic@gmail.com', "Test")
            ->view($this->namespace . 'color_mail', [
                'data' => $this->data ?? [],
            ])->subject($this->subject);
        
        // foreach ($this->attachedFiles as $file) {
        //     $build->attach(public_path() . '/storage/files/' . $file);
        // }
        return $build;
    }
}
