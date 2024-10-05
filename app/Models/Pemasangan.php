<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Scaffolding\Traits\ScaffoldingModel;

class Pemasangan extends Model
{
    use HasFactory, ScaffoldingModel;
    protected $table = 'pemasangans';
    protected $guarded = ['id'];

    public function defects()
    {
        return $this->hasMany(Defect::class, 'pemasangan_id');
    }

    protected $dates = [
        'tanggal'
    ];
}
