<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table =  'review';
    protected $primaryKey = 'id_review';

    protected $fillable = [
        'bintang',
        'review',
        'id_user'
    ];

    public function User(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
