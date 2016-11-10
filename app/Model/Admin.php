<?php

namespace App\Model;

use App\User;


class Admin extends User
{	

    protected $table = 'sys_user';
    public $primaryKey = 'user_id';


}
