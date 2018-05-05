<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ozekimessageout extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender', 'receiver','msg', 'senttime', 'receivedtime', 'reference', 'status','msgtype','operator', 'errormsg'
    ];

    protected $table = 'ozekimessageout';

    public $timestamps = false;
}
