<?php

namespace App\Models;

use App\Traits\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendMoney extends Model
{
    use HasFactory, Searchable;
    protected $casts = [
        'sender'      => 'object',
        'recipient'   => 'object',
        'received_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function payoutBy()
    {
        return $this->hasOne(Agent::class, 'id', 'payout_by');
    }

    public function sourceOfFund()
    {
        return $this->belongsTo(SourceOfFund::class);
    }

    public function sendingPurpose()
    {
        return $this->belongsTo(SendingPurpose::class);
    }

    public function scopeInitiated($query)
    {
        return $query->where('status', 0);
    }

    public function scopePaid($query)
    {
        return $query->where('status', 1);
    }

    public function scopePayout($query)
    {
        return $query->where('status', 2);
    }

    public function scopeRefunded($query)
    {
        return $query->where('status', 3);
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 5);
    }

    public function scopeFilterAgent($query)
    {
        return $query->where('agent_id', authAgent()->id);
    }

    public function scopeFilterUser($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function scopeFilterByDay($query, $day = 7)
    {
        return $query->whereDate('created_at', '>=', Carbon::now()->subDays($day));
    }


    public function getStatusTextAttribute()
    {
        $className = '';
        if ($this->status == 1) {
            $className .= 'primary';
            $text = 'Payment Completed';
        } elseif ($this->status == 2) {
            $className .= 'success';
            $text = 'Payout Completed';
        } elseif ($this->status == 3) {
            $className .= 'danger';
            $text = 'Payment Refunded';
        } elseif ($this->status == 4) {
            $className .= 'info';
            $text = 'Payment Pending';
        } elseif ($this->status == 5) {
            $className .= 'danger';
            $text = 'Payment Rejected';
        } else {
            $className .= 'warning';
            $text = 'Send Money Initiated';
        }
        return "<span class='badge badge--$className'>" . trans($text) . "</span>";
    }
    public function getSenderInfoAttribute()
    {
        if ($this->user_id) {
            $user = $this->user;
            $address = $user->address;
            $sender['name']    = $user->fullname;
            $sender['mobile']  = $user->mobile;
            $sender['address'] = $address->zip . ', ' . $address->state  . ', ' .  $address->city  . ', ' .  $address->country;
            return (object) $sender;
        } else {
            return $this->sender;
        }
    }
}
