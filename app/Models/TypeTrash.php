<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTrash extends Model
{
    use HasFactory;

    protected $table = 'type_trashes';

    protected $fillable = ['type_of_trash'];

    public function trashes()
    {
        return $this->hasMany(Trash::class, 'id');
    }
}
