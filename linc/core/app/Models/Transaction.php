<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function agent()
    {
        return $this->belongsTo(Agent::class);
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
