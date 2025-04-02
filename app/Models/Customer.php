<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'email', 
        'phone', 
        'assigned_to', 
        'created_by'
    ];


    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignedEmployee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function actions()
    {
        return $this->hasMany(Action::class);
    }
}
