<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory, Searchable;
    public function scopeActive()
    {
        return $this->where('status', 1);
    }

    public function statusBadge(): Attribute
    {
        return new Attribute(
            get: fn () => $this->badgeData(),
        );
    }

    public function badgeData()
    {
        if ($this->status) {
            $class = 'success';
            $text = 'Enabled';
        } else {
            $class = 'danger';
            $text = 'Disabled';
        }

        $html = '<span><span class="badge badge--' . $class . '">' . trans($text) . '</span></span>';

        return $html;
    }
}
