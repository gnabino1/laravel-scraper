<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScrappedJob extends Model
{
    protected $table='scrapped_jobs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'position'
        'company',
        'location',
        'job_type'
    ];

}
