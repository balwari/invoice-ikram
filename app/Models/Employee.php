<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\State;
use App\Models\Designation;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "employees";

}
