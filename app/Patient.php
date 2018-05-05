<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use Notifiable;
    
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['drugs_id', 'users_id', 'given_name', 'surname', 'marital_status', 'gender', 'dob', 'phone', 'other_phone', 'address', 'email', 'created_at', 'updated_at'];

    public function routeNotificationForNexmo()
    {
        return $this->phone;
    }
}
