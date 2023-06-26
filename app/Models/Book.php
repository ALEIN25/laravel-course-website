<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller');
    }
    public function getSellerInfo()
    {
        $seller = $this->seller()->first();
        if ($seller) {
            return [
                'email' => $seller->email,
                'phonenr' => $seller->phonenr,
            ];
        }
        return null;
    }
}
