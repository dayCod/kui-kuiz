<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AsmntGroup extends Model
{
    use HasFactory;

    /**
     * Fill the model with an array of attributes.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['certificateSetting'];


    public function certificateSetting(): BelongsTo
    {
        return $this->belongsTo(AsmntCertificateSetting::class, 'certificate_setting_id', 'id');
    }
}
