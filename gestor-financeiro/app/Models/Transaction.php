<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault(['name' => "sem categoria"]);
    }



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
