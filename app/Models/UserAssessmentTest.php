<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAssessmentTest extends Model
{
    use HasFactory;

    /**
     * Fill the model with an array of attributes.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function assessmentTest(): BelongsTo
    {
        return $this->belongsTo(AssessmentTest::class, 'assessment_test_id', 'id');
    }
}
