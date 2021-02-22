<?php

namespace ConfrariaWeb\PhotoSale\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'status_id',
        'address_id',
        'parent_id',
        'plan_id',
        'code',
        'price',
        'done',
        'recurrent'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('user_order', function (Builder $builder) {
            $builder->where('user_id', Auth::id());
        });
    }

    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }

    public function payments()
    {
        return $this->hasMany(OrderPayment::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope para buscar somente os pagamentos ja pagos.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder

    public function scopePaid($query)
    {
        return $this->hasMany(OrderPayment::class)
            ->where(['order_payments.paid' => true]);
    } */

    public function paid()
    {
        return $this->hasMany(OrderPayment::class)
            ->where(['order_payments.paid' => true])->exists();
    }

    public function isDone()
    {
        return ($this->done === 1);
    }

}
