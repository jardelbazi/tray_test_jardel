<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\UserRegistrationEmail;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendUserRegistrationEmail
 *
 * Ouvinte responsável por enviar um e-mail de registro para o usuário recém-criado.
 * Escuta o evento `UserCreated` e dispara o envio de um e-mail de confirmação de registro.
 *
 * @package App\Listeners
 */
class SendUserRegistrationEmail
{
    /**
     * Manipula o evento `UserCreated` e envia um e-mail de registro ao usuário.
     *
     * Este método é chamado quando o evento `UserCreated` é disparado. Ele utiliza o serviço de e-mail
     * para enviar uma mensagem de confirmação de registro ao usuário recém-criado, colocando-a na fila.
     *
     * @param UserCreated $event O evento disparado que contém os dados do usuário recém-criado.
     * @return void
     */
    public function handle(UserCreated $event): void
    {
        Mail::to($event->user->email)->queue(new UserRegistrationEmail($event->user));
    }
}
