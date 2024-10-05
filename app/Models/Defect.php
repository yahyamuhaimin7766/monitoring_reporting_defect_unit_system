<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Scaffolding\Traits\ScaffoldingModel;


class Defect extends Model
{
    use HasFactory,  ScaffoldingModel;

    protected $table = 'defect';
    protected $guarded = ['id'];


    public function details()
    {
        return $this->hasMany(DefectDetail::class, 'defect_id');
    }

    public function pemasangan()
    {
        return $this->belongsTo(Pemasangan::class, 'pemasangan_id');
    }
}
