<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    /**
     * The table associated to the model
     *
     * @var string
     */
    protected $table = "students";

    /**
     * Fillable field / column
     *
     * @var array
     */
    protected $fillable = ['name', 'schoolboard_id'];

    /**
     * Hidden field / column that you don't want to output to the user
     *
     * @var array
     */
    protected $hidden = ['deleted_at'];

    public function grades()
    {
        return $this->hasMany(Grade::class, 'student_id', 'id');
    }
}
