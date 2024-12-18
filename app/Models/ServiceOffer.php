<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 */
class ServiceOffer extends Model
{
    use HasFactory;

    protected $table = 'service_offers';

    protected $fillable = [
        'service_id',
        'service_request_id',
        'price',
        'description',
        'status',
        'available_slots',
    ];

    protected $attributes = [
        'status' => 'started',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function serviceRequest(): BelongsTo
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    public function availableSlots()
    {
        return json_decode($this->available_slots); // Декодируем JSON со слотами
    }

}
