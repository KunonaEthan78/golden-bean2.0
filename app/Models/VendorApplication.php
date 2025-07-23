<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class VendorApplication extends Model
{
    protected $fillable = [
        'user_id', 'role', 'financial_score', 'reputation', 'regulatory_proof'
    ];
}
