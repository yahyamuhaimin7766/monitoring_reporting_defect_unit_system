<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Scaffolding\Traits\ScaffoldingModel;


class Repair extends Model
{
    use HasFactory,  ScaffoldingModel;

    protected $table = 'repairs';
    protected $guarded = ['id'];


    public function defect()
    {
        return $this->belongsTo(Defect::class, 'defect_id');
    }
}
