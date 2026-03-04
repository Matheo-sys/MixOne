<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HiddenConversation extends Model
{
    protected $fillable = ['user_id', 'contact_id'];
}
