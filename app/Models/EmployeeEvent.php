<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_employee_id',
        'event_event_id',
        'employee_event_status'
    ];

    protected $primaryKey = 'employee_event_id';

    /**
     * Get the Employee associated with the EmployeEevent
     */
    public function employee(){
        return $this->hasOne(Employee::class, 'employee_id', 'employee_employee_id');
    }

    /**
     * Get the Event associated with the EmployeEevent
     */
    public function event(){
        return $this->hasOne(Event::class, 'event_id', 'event_event_id');
    }
}
