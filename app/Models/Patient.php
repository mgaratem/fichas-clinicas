<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    public $timestamps = true;
    
    protected $table = 'patients';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 
        'paternal_last_name', 
        'maternal_last_name', 
        'rut', 'gender', 
        'birth_date', 
        'occupation', 
        'address', 
        'city', 
        'email'
    ];

    public function record(){
        return $this
            ->hasOne(Record::class);
    }

    public function getFriendlyName()
    {
        $completeName = implode(" ", array($this->name, $this->paternal_last_name, $this->maternal_last_name));

        return $completeName;
    }

    public function getAge()
    {
        $date = date_create($this->birth_date);
        $now = date_create(date("Y-m-d"));
        $interval = date_diff($now, $date);
        $age = $interval->y;

        return $age;
    }

}
