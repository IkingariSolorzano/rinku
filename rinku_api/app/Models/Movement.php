<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $fillable = [
        'employee_id', 'mes', 'cantidad_entregas'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
