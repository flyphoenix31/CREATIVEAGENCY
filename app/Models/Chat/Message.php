<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['from_user', 'to_user', 'message', 'file', 'is_read'];


    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function touser()
    {
        return $this->belongsTo(\App\Models\User::class, 'to_user');
    }

    public function ScopemyChat($query)
    {
        return $query->where('from_user', \Auth::id());
    }

    public function last_messages() {
        return $this->hasMany(Message::class, 'conversation_id', 'id')->latest()->limit(2);
    }




}
