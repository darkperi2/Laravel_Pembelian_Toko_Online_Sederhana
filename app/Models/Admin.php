<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    // table name is 'admin' as migration defines it
    protected $table = 'admin';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // NOTE:
    // Karena masih prototipe jadi tidak memiliki hash dipassword.

}
