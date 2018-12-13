<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model
{
    use SoftDeletes;

    /**
     * The table associated to the model
     *
     * @var string
     */
    protected $table = "grades";

    /**
     * Fillable field / column
     *
     * @var array
     */
    protected $fillable = ['student_id', 'grade'];

    /**
     * Hidden field / column that you don't want to output to the user
     *
     * @var array
     */
    protected $hidden = ['deleted_at'];
}
