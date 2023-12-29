<?php

namespace App\Traits;

/**
 * Apply search ability on model to search by column name on any model that use this trait;
 */
trait Searchable
{
    public function scopeSearchable($query, $columns, $like = true)
    {
        $search = request()->search;
        $search = !$like ? $search : "%$search%";

        $query->where(function ($q) use ($columns, $search) {
            foreach ($columns as $column) {
                return $q->orWhere($column, 'LIKE', $search);
            }
        });
        return $query;
    }
}
