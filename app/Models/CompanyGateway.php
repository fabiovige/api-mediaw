<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyGateway extends Model
{
    use HasFactory;

    protected $table = 'company_gateway';
    protected $fillable = ['id_company', 'name_gateway', 'public_key', 'live_api_key', 'recipient_id'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'id_company', 'id');
    }
}
