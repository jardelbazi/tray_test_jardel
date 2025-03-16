<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\UserRegistrationEmail;
use Illuminate\Support\Facades\Mail;

class SendUserRegistrationEmail
{
    public function handle(UserCreated $event): void
    {
        Mail::to($event->user->email)->queue(new UserRegistrationEmail($event->user));
    }
}
