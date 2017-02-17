<?php

namespace blog;

use Illuminate\Database\Eloquent\Model;

class SocialProvider extends Model
{
    protected $fillable = ['providerID','provider'];


    function user()
    {
        return $this->belongsTo(User::class);
    }
}
