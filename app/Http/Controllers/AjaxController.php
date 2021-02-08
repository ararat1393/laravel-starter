<?php

namespace App\Http\Controllers;

use App\Searches\UserSearch;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AjaxController extends Controller
{
    const USERS_PER_PAGE = 5;
    /**
     * AjaxController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        if( !$request->ajax() ){
            return response()->json(['error' => 'Request is not Ajax request'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        return true;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function users(Request $request)
    {
        $userSearch = new UserSearch();
        $query = $userSearch->search($request->all());
        $results = $query->paginate(self::USERS_PER_PAGE);
        $response = array(
            "results" => $results->items(),
            "pagination" => array(
                "more" => $results->hasMorePages()
            )
        );
        return response()->json($response,Response::HTTP_OK);
    }
}
