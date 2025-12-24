<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'number',
        'number_report',
        'number_file',
        'type_reserved',
        'description',
        'name_of_whos_reserved',
        'date_receipt',
        'notes',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
