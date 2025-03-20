<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reports';
    protected $dates = ['deleted_at'];

    protected $fillable = ['trashes','users','rooms','total'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'rooms');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'report_id');
    }
}
