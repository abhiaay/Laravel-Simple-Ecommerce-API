<?php

namespace App\Traits;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method static function filter(EloquentBuilder $builder, $filters = [])
 */
trait Filter
{
    use Searchable;

    /**
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $builder, $filters = [])
    {

        if (!$filters) { // check if has filter query params
            return $builder;
        }

        /**
         * Loop through filter param passing
         */
        foreach ($filters as $searchColumn => $value) {

            // check if filter field is search, then do search
            if($searchColumn == 'search' && $value !== null) {
                $builder->search($value, null, false, true);
            }
            if( ! isset($this->filterFields)) {
                continue;
            }

            $fields = $this->filterFields['fields'];
            $alias = $this->filterFields['alias'] ?? null;
            $relations = $this->filterFields['relations'] ?? null;

            // aliasing column for query
            $aliasColumn = $alias[$searchColumn] ?? $searchColumn;
            /**
             * If filter field is defined
             */
            if(in_array($searchColumn, $fields)) {
                // check if used relations
                if(isset($relations) && isset($relations[$searchColumn])) {
                    $builder->whereHas($relations[$searchColumn], function($query) use($aliasColumn, $value) {
                        return $query->whereIn($aliasColumn, is_array($value) ? $value : [$value]);
                    });
                } else if(is_array($value)) { // filter column multiple value
                    $builder->whereIn($aliasColumn, $value);
                } else { // filter column single value
                    $builder->where($aliasColumn, $value);
                }
            }

        }
        return $builder;
    }
}
