<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AsmntQuestion extends Model
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
    protected $with = ['assessment', 'hasAnswers'];

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class, 'asmnt_id', 'id');
    }

    public function hasAnswers(): HasMany
    {
        return $this->hasMany(AsmntQuestionAnswer::class, 'asmnt_question_id', 'id');
    }
}
