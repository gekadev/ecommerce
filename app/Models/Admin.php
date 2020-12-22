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



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function scopeIsExist($query ,$id)
    {
        return $query->where(['deleted' => 1, 'id' => $id])->orderBy('id', 'DESC');
    }
    public function getActive()
    {
        return  $this->status == 1 ? 'مفعل':'غ.مفعل';

    }
}


