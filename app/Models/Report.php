<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected  $fillable = [
        'title',
        'report_link',

        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
