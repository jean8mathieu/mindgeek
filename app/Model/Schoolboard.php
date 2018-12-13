<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schoolboard extends Model
{
    use SoftDeletes;

    /**
     * The table associated to the model
     *
     * @var string
     */
    protected $table = "schoolboards";

    /**
     * Fillable field / column
     *
     * @var array
     */
    protected $fillable = ['name', 'format'];

    /**
     * Hidden field / column that you don't want to output to the user
     *
     * @var array
     */
    protected $hidden = ['deleted_at'];

    /**
     * This create the relation from the school bord to the students
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'schoolboard_id', 'id');
    }
}
