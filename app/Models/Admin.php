<?php

namespace App\Models;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use phpDocumentor\Reflection\Types\True_;

class Admin extends Authenticatable
{
    protected $table   = 'admins';
    protected $guarded = [];
    public $timestamps = true ;
}
