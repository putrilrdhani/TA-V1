<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use Myth\Auth\Config\Auth as AuthConfig;

class Auth extends AuthConfig
{

    // isi class Auth
    /**
     * --------------------------------------------------------------------
     * Require Confirmation Registration via Email
     * --------------------------------------------------------------------
     *
     * When enabled, every registered user will receive an email message
     * with an activation link to confirm the account.
     *
     * @var string|null Name of the ActivatorInterface class
     */
    public $requireActivation = null;
}
