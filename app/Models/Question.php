<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Question extends Model
{
    protected $fillable = [
        'male_question',
        'female_question', 
        'wrong_answers',
        'show_importance_checkbox_for'
    ];
    protected function question(): Attribute
    {
        return Attribute::make(get: function () {
            return $this->{Auth::user()->gender . '_question'};
        });
    }

    protected function casts(): array
    {
        return [
            'wrong_answers' => 'array',
            'show_importance_checkbox_for' => 'string'
        ];
    }

    /**
     * Check if importance checkbox should be shown for specific gender
     */
    public function shouldShowImportanceCheckbox($gender)
    {
        return in_array($this->show_importance_checkbox_for, ['both', $gender]);
    }
}