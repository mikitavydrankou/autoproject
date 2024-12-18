<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequestStatusHistory extends Model
{
    use HasFactory;

    protected $table = 'service_request_status_history';

    protected $fillable = [
        'service_request_id',
        'status'
    ];

    public function serviceRequest(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ServiceRequest::class);
    }

}
