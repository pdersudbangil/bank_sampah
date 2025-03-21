<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = ['reports', 'price', 'trashes', 'total', 'proces'];

    public function report()
    {
        return $this->belongsTo(Report::class, 'reports');
    }

    public function trash()
    {
        return $this->belongsTo(Trash::class, 'id');
    }
}
