<?php


namespace App\Rest\version\v1;


use App\Models\User;
use App\Rest\version\BaseController;
use App\Validators\UserValidator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends BaseController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store( Request $request , User $user )
    {
        $validator = new UserValidator($user);
        $validator->loadAttributes( $request->all() );
        $validator->setScenario(User::SCENARIO_CREATE);
        if( $validator->validate() && $user->save()){
            return response()->json(['user' => $user ], Response::HTTP_OK);
        }
        return response()->json(['errors'=>$validator->getErrors()],Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
