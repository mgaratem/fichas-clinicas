<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public $timestamps = true;
    
    protected $table = 'appointments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'evolution',
        'consultation_date',
        'record_id'
    ];

    public function record()
    {
        return $this
            ->belongsTo(Record::class);
    }
}
