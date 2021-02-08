<?php


namespace App\Searches;


use App\interfaces\Search;
use App\Models\Photo;

/**
 * Class PhotoSearch
 * @package App\Models\search
 */
class PhotoSearch implements Search
{

    /**
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function search( $params = [] )
    {
        $query = Photo::query();
        $query->select(['photos.*']);

        if( isset($params['search']) ){
            $query->leftJoin('users',function($join){
                $join->on('users.id', '=', 'photos.user_id');
            })
                ->like('users.name',$params['search'])
                ->orLike('users.email',$params['search']);
        }

        $query->approved();

        return $query->latest('photos.created_at');
    }
}
