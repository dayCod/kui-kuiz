<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assessment extends Model
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
    protected $with = ['asmntGroup', 'asmntSetting'];

    public function asmntGroup(): BelongsTo
    {
        return $this->belongsTo(AsmntGroup::class, 'asmnt_group_id', 'id');
    }

    public function asmntSetting(): BelongsTo
    {
        return $this->belongsTo(AsmntSetting::class, 'asmnt_setting_id', 'id');
    }

    public function asmntQuestion()
    {
        return $this->hasMany(AsmntQuestion::class, 'asmnt_id', 'id');
    }
}
