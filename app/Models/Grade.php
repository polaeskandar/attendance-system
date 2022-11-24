<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = ['title'];

    public function sessions() {
        return $this->hasMany(Session::class, 'grade_id', 'id');
    }

    public function users() {
        return $this->hasMany(User::class, 'grade_id', 'id');
    }
}
