<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProjectDesignDisapproved extends Mailable
{
    public $project_title;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($project_title)
    {
        $this->project_title=$project_title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $actionMessage = 'Project Design Uploaded. Please check the design as soon as possible.';
        return $this
            ->subject('Project Design Uploaded')
            ->markdown('mail.sales')
            ->with('project_title',$this->project_title)->with('actionMessage',$actionMessage);
    }
}
