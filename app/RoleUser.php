<?php

namespace App;

use App\User;
use App\Role;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    public $fillable = [
        'user_id',
        'role_id'
    ];

    public $timestamps = false;
    protected $table = 'role_user';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }
 }
