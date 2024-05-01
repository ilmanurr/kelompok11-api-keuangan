<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'amount', 'description', 'expense_date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Expense::class, "user_id", "id");
    }
}