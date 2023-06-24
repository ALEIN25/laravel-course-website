<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'seller',
    ];
    public function wishlists(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'wishlist', 'book_id', 'user_id')->withTimestamps();
    }
    
}
