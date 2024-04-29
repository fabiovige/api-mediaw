<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyAuthentication extends Model
{
    use HasFactory;

    protected $table = 'company_authentication';
    protected $fillable = ['id_company', 'token_api_service'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'id_company');
    }
}
