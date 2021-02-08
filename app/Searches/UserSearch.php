<?php


namespace App\Searches;


use App\interfaces\Search;
use App\Models\User;

/**
 * Class UserSearch
 * @package App\Models\search
 */
class UserSearch implements Search
{
    /**
     * @param $params
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function search(array $params = [])
    {
        $query = User::query();
        $query->select(['users.*']);
        if( $params['search'] ){
            $query->like('name',$params['search']);
        }
        $query->latest('users.created_at');
        return $query;
    }
}
