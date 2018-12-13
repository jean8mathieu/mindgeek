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

    /**
     * This function is used to create the relation between the student and the grades
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grades()
    {
        return $this->hasMany(Grade::class, 'student_id', 'id');
    }

    /**
     * This function is used to create the relation between the student and the school board
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function schoolboard()
    {
        return $this->hasOne(Schoolboard::class, 'id', 'schoolboard_id');
    }
}
