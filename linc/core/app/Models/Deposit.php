<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $casts = [
        'detail' => 'object'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
    public function gateway()
    {
        return $this->belongsTo(Gateway::class, 'method_code', 'code');
    }

    public function statusBadge(): Attribute
    {
        return new Attribute(
            get: fn () => $this->badgeData(),
        );
    }

    public function badgeData()
    {
        $html = '';
        if ($this->status == 2) {
            $html = '<span class="badge badge--warning">' . trans('Pending') . '</span>';
        } elseif ($this->status == 1 && $this->method_code >= 1000) {
            $html = '<span><span class="badge badge--success">' . trans('Approved') . '</span><br>' . diffForHumans($this->updated_at) . '</span>';
        } elseif ($this->status == 1 && $this->method_code < 1000) {
            $html = '<span class="badge badge--success">' . trans('Succeed') . '</span>';
        } elseif ($this->status == 3) {
            $html = '<span><span class="badge badge--danger">' . trans('Rejected') . '</span><br>' . diffForHumans($this->updated_at) . '</span>';
        } else {
            $html = '<span><span class="badge badge--dark">' . trans('Initiated') . '</span></span>';
        }
        return $html;
    }

    public function sendMoney()
    {
        return $this->belongsTo(SendMoney::class);
    }

    // scope
    public function scopeGatewayCurrency()
    {
        return GatewayCurrency::where('method_code', $this->method_code)->where('currency', $this->method_currency)->first();
    }

    public function scopeBaseCurrency()
    {
        return $this->gateway->crypto == 1 ? 'USD' : $this->method_currency;
    }

    public function scopePending($query)
    {
        return $query->where('method_code', '>=', 1000)->where('status', 2);
    }

    public function scopeRejected($query)
    {
        return $query->where('method_code', '>=', 1000)->where('status', 3);
    }

    public function scopeApproved($query)
    {
        return $query->where('method_code', '>=', 1000)->where('status', 1);
    }

    public function scopeSuccessful($query)
    {
        return $this->where('status', 1);
    }

    public function scopeInitiated($query)
    {
        return $query->where('status', 0);
    }
    public function scopeFilterAgent($query)
    {
        return $query->where('agent_id', @auth()->guard('agent')->id());
    }
    public function scopeFilterUser($query)
    {
        return $query->where('user_id', @auth()->id());
    }
    public function scopeSearchable($query, $key, $search, $like = false)
    {
        if ($search) {
            if ($like) {
                return $query->where($key, 'like', "%$search%");
            }
            return $query->where($key, $search);
        }
        return $query;
    }
    public function scopeFilterByDay($query, $day = 7)
    {
        return $query->whereDate('created_at', '>=', Carbon::now()->subDays($day));
    }
}
