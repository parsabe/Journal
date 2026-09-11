<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsStudent extends Model
{
    use HasFactory;

    protected $table = 'cs_students';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'downloaded_cert',
        'downloaded_zip',
    ];

    public function feedbacks()
    {
        return $this->hasMany(CsFeedback::class, 'cs_student_id');
    }

    public function getNameAttribute()
    {
        return trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? '')) ?: 'Campus Specialist';
    }
}
