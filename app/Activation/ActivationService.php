<?php

namespace App\Activation;


use App\User;
use App\Mail\UserActivation;
use Illuminate\Mail\Message;
// use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Mail;


class ActivationService
{

    protected $mailer;

    protected $activationRepo;

    protected $resendAfter = 24;

    public function __construct(ActivationRepository $activationRepo)
    {
        // $this->mailer = $mailer;
        $this->activationRepo = $activationRepo;
    }

    public function sendActivationMail($user)
    {

        if ($user->is_verified || !$this->shouldSend($user)) {
            return;
        }

        Mail::to($user->email)->send(new UserActivation($user, $this->activationRepo));

        // $message = sprintf('Activate account <a href="%s">%s</a>', $link, $link);
        //
        // $this->mailer->send($message, function (Message $m) use ($user) {
        //     $m->to($user->email)->subject('Activation mail');
        // });


    }

    public function activateUser($token)
    {
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);

        $user->is_verified = true;

        $user->save();

        $this->activationRepo->deleteActivation($token);

        return $user;

    }

    private function shouldSend($user)
    {
        $activation = $this->activationRepo->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }

}
