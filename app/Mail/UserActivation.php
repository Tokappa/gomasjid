<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


use App\User;
use App\Activation\ActivationRepository;


class UserActivation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, ActivationRepository $activationRepo)
    {
        $this->user = $user;
        $this->activationRepo = $activationRepo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $token      = $this->activationRepo->createActivation($this->user);
        $link       = route('user.activate', $token);
        return $this->subject(__('mail.registration.subject_user_activation'))
            ->view('emails.user_activation')
            ->with(['activation_url' => $link, 'user' => $this->user]);
    }
}
