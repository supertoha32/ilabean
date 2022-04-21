<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'from_id',
        'to_id',
        'item_id',
        'body',
        'seen',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
