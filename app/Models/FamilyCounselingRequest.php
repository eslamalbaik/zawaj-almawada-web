<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FamilyCounselingRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'pseudonym',
        'question',
        'answer',
        'is_public',
        'ip_address',
        'user_agent',
        'status',
        'answered_by',
        'answered_at'
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'answered_at' => 'datetime',
    ];

    /**
     * Get the user who answered this request
     */
    public function answeredBy()
    {
        return $this->belongsTo(User::class, 'answered_by');
    }

    /**
     * Scope for public requests
     */
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }


    /**
     * Scope for pending requests
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for answered requests
     */
    public function scopeAnswered($query)
    {
        return $query->where('status', 'answered');
    }
}
