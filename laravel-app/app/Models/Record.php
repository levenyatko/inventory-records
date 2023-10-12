<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Record extends Model
{
    use HasFactory;

    protected $perPage = 10;

    protected $fillable = [
        'employee_id',
        'category_id',
        'name',
        'image'
    ];

    public function employee()
    {
        return $this->belongsTo( Employee::class );
    }

    public function category()
    {
        return $this->hasOne( Category::class );
    }

    public function getImageUrlAttribute()
    {
        return Storage::url( $this->image );
    }

}
