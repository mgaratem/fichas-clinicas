<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mehradsadeghi\FilterQueryString\FilterQueryString;


class Record extends Model
{
    use HasFactory;
    use FilterQueryString;

    public $timestamps = true;
    
    protected $table = 'records';
    protected $primaryKey = 'id';

    protected $fillable = [
        'anamnesis',
        'patient_id', 
        'professional_id'
    ];

    protected $filters = ['sort', 'greater', 'greater_or_equal'];

    public function patient()
    {
        return $this
            ->belongsTo(Patient::class);
    }

    public function professional()
    {
        return $this
            ->belongsToMany(User::class);
    }
}
