<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewSaleRequest extends Mailable
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
        $this->project_title = $project_title;
//        dd($this->project_title);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $actionMessage='A new sales request has been created; please review and approve it as soon as possible.';
        return $this
            ->markdown('mail.sales2')->with('project_title',$this->project_title)->with('actionMessage',$actionMessage);
//            ->view('mail.sales');
    }
}
