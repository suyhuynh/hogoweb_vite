<?php

namespace Modules\Core\Sidebar;

use Modules\User\Contracts\Authentication;

class BaseSidebarExtender
{
    protected $auth;

    public function __construct()
    {
        if (empty(auth()->user())) {
            return redirect()->to('/kadmin/login');
        }

        $this->auth = auth()->user();
    }
}
