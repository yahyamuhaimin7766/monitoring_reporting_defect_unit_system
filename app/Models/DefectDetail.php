<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefectDetail extends Model
{
    use HasFactory;
    protected $table = 'defect_details';

    protected $fillable = [
        'defect_id', 'problem', 'analisa', 'action', 'other_action', 'image'
    ];

    public function defect()
    {
        return $this->belongsTo(Defect::class, 'defect_id');
    }
}
