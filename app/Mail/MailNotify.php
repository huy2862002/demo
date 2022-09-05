<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $phone_number;
    public $data = [];
    public $total;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $phone_number, $data, $total)
    {
        $this->name = $name;
        $this->phone_number = $phone_number;
        $this->data = $data;
        $this->total = $total;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.send_order')
            ->subject('Đơn Hàng')
            ->with([
                'name' => $this->name,
                'phone_number' => $this->phone_number,
                'data' =>  $this->data,
                'total' =>  $this->total,
            ]);
    }
}
