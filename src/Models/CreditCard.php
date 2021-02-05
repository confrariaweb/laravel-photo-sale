<?php

namespace ConfrariaWeb\PhotoSale\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;

    public $table = 'creditcards';

    public $fillable = ['user_id', 'title', 'brand', 'token', 'security_code'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
