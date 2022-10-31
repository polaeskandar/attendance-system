<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'grade_id'];

    public function grade() {
        return $this->belongsTo(Grade::class, 'grade_id', 'id', 'sessions');
    }

    public function attentances() {
        return $this->hasMany(Attentance::class, 'session_id', 'id');
    }
}
