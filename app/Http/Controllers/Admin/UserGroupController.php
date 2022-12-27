<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\UserGroups\IUserGroups;

class UserGroupController extends Controller
{
    private IUserGroups $groups;

    public function __construct(IUserGroups $groups)
    {
        $this->groups = $groups;
    }

    public function index()
    {
        $values = $this->groups->index();
        return view('admin.pages.userManagement.userGroups', compact('values'));
    }

}
