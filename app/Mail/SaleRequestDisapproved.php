<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaleRequestDisapproved extends Mailable
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
        $actionMessage = 'Sales Request has been disapproved.';
        return $this
            ->subject('Sales Request Rejected/Disapproved')
            ->markdown('mail.sales')->with('project_title',$this->project_title)->with('actionMessage',$actionMessage);
    }
}
