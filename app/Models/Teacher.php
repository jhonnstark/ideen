<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method static create(array $record)
 * @property mixed $material
 * @property mixed $id
 * @property mixed created_at
 * @property mixed $courses
 */
class Teacher extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'mothers_lastname',
        'email',
        'password',
        'phone',
        'enrollment',
        'birthday',
        'birthplace',
        'age',
        'address',
        'municipality',
        'degree_certificate',
        'professional_license',
        'curp_certificate',
        'emergency_phone',
        'facebook',
        'curp',
        'rfc',
        'bank',
        'account_number',
        'account_clabe',
        'state_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The course that belong to the teacher.
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'lecturings');
    }

    /**
     * The student that belong to the Activity.
     *
     * @return BelongsToMany
     */
    public function material(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'work_proofs');
    }
}
