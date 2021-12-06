<?php

namespace App\Models;

use Laravel\Passport\Client as BaseClient;

class Client extends BaseClient
{
    /**
     * Определите, должен ли клиент пропускать запрос авторизации.
     *
     * @return bool
     */
    public function skipsAuthorization()
    {
        return $this->firstParty();
    }
}
