<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $fillable = [
        'fullname',
        'gender',
        'email',
        'is_active',
        'deleted_at',
    ];

    public function softDeleteWithTimezone()
    {
        $this->update([
            'deleted_at' => now()->timezone('GMT+8'),
            'is_active' => 0,
        ]);
    }
}
