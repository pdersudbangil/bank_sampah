<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trash extends Model
{
    use HasFactory;

    protected $table = 'trashes';

    protected $fillable = ['name','type_of_trash','price','unit'];

    public function typeTrash()
    {
        return $this->belongsTo(TypeTrash::class, 'type_of_trash');
    }
}
