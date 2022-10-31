<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attentance extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'session_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id', 'attentances');
    }

    public function session() {
        return $this->belongsTo(Session::class, 'session_id', 'id', 'attentances');
    }
}
