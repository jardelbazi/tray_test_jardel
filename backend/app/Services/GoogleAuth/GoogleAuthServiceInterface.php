<?php

namespace App\Services\GoogleAuth;

use App\DTOs\GoogleUser\GoogleUserDTO;

/**
 * Interface GoogleAuthServiceInterface
 *
 * Interface que define os métodos necessários para a autenticação com o Google.
 * Implementada pelo serviço de autenticação do Google para fornecer a URL de autenticação
 * e recuperar os dados do usuário autenticado a partir de um código de autorização.
 *
 * @package App\Services\GoogleAuth
 */
interface GoogleAuthServiceInterface
{
    /**
     * Recupera a URL de autenticação do Google.
     *
     * Gera a URL que redireciona o usuário para a página de login e autorização do Google.
     *
     * @return string A URL de autenticação.
     */
    public function getAuthUrl(): string;

    /**
     * Recupera os dados do usuário do Google utilizando o código de autorização.
     *
     * Após o redirecionamento do usuário e a troca do código de autorização, este método
     * é utilizado para buscar as informações do usuário no Google.
     *
     * @param string $code O código de autorização fornecido pelo Google após o login do usuário.
     * @return GoogleUserDTO O DTO contendo os dados do usuário autenticado.
     */
    public function fetchGoogleUser(string $code): GoogleUserDTO;
}
