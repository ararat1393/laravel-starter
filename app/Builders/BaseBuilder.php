<?php


namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class BaseBuilder extends Builder
{
    /**
     * PhotoBuilder constructor.
     * @param QueryBuilder $query
     */
    public function __construct(QueryBuilder $query)
    {
        parent::__construct($query);
    }

    /**
     * @param string $column
     * @param string $value
     * @param string $align
     * @return BaseBuilder
     */
    public function like(string $column, string $value, string $align = 'center')
    {
        switch ( $align ){
            case 'center':
                $value = "%$value%";
                break;
            case 'left':
                $value = "%$value";
                break;
            case 'right':
                $value = "$value%";
                break;
        }
        return $this->where( $column,'like',$value);
    }

    /**
     * @param string $column
     * @param string $value
     * @param string $align
     * @return BaseBuilder
     */
    public function orLike(string $column, string $value, string $align = 'center')
    {
        switch ( $align ){
            case 'center':
                $value = "%$value%";
                break;
            case 'left':
                $value = "%$value";
                break;
            case 'right':
                $value = "$value%";
                break;
        }
        return $this->orWhere( $column,'like',$value);
    }
}
