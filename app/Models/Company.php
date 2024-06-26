<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';
    protected $primaryKey = 'id_company';
    protected $fillable = ['company', 'cnpj', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company_authentication(): HasOne
    {
        return $this->hasOne(CompanyAuthentication::class, 'id_company', 'id_company');
    }

    public function company_gateways(): HasMany
    {
        return $this->hasMany(CompanyGateway::class, 'id_company', 'id_company');
    }
}
