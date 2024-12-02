<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static findOrFail($id)
 */
class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = [
        'user_id',
        'make',
        'model',
        'year',
        'license_plate',
        'engine_type',
        'transmission',
        'mileage',
        'last_service_date',
        'image',
        'status'
    ];

    protected $attributes = [
        'image' => 'images/default_car.jpg'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function requests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Request::class);
    }
}
