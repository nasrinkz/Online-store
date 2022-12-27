<?php

namespace App\Repositories\UserGroups;

use App\Models\UserGroup;

class UserGroups implements IUserGroups
{

    function index()
    {
        $values = UserGroup::get();
        return $values;
    }
}
