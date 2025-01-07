<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gatepass extends Model
{
    use HasFactory;

    protected $fillable = [
        'jobcard',
        'gatepass_no',
        'customer_name',
        'lastname',
        'email',
        'mobile',
        'vehicle_name',
        'veh_type',
        'chassis',
        'kms',
        'out_date',
    ];
}
