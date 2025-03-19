<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $fillable = ['trashes','users','rooms','total'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'rooms');
    }
}
