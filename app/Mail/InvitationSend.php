<?php

namespace App\Mail;

use App\Invitation;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class InvitationSend
 *
 * @package App\Mail
 */
class InvitationSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    public $user;
    public $invitation;

    /**
     * InvitationSend constructor.
     *
     * @param User       $user
     * @param Invitation $invitation
     */
    public function __construct(User $user, Invitation $invitation)
    {
        $this->user       = $user;
        $this->invitation = $invitation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.invitation');
    }
}
