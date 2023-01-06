<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\RFQ;

class rfq_mail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * The RFQ instance.
     *
     * @var \App\Models\RFQ
     */
    public $rfq;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RFQ $rfq)
    {
        $this->rfq=$rfq;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from($this->rfq->_user->email, $this->rfq->_user->company)->subject($this->rfq->subject)
            ->view('emails.rfq_mail')->attach(env('APP_URL').$this->rfq->pdf_link);
        if($this->rfq->attachments!=''){
            $attachments=explode('||',$this->rfq->attachments);
            foreach ($attachments as $attachment){
                $this->attach(str_replace('WEBURL',env('APP_URL'),$attachment));
            }
        }

        return $this;
    }
}
