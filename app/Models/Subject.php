<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['code', 'name'];

    public function admissions()
    {
        return $this->hasMany(Admission::class, 'subject_id');
    }
}