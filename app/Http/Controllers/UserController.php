<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\User;

class UserController extends Controller
{
    /**
     * Login Operation For User Inside The System.
     *
     * @Author Mohamed Said.
     * 
     * @return \Illuminate\Http\Response
     */
    public function userLogin(Request $request)
    {
        $this->validate($request, [
            "email" => "required|email|exists:users,email",
            "password" => "required|min:5|max:25"
        ]);
        $user = User::where('email', '=', $request->email)->get()->first();
        if (!Hash::check($request->password, $user->password)) {
            return response()->json("Wrong Operation", 500); 
        }
        return response()->json(['user' => $user], 200); 
    }
    
    /**
     * Return User With Specified Id.
     *
     * @Author Mohamed Said.
     * 
     * @param  int  $id  User Id.
     * 
     * @return \Illuminate\Http\Response
     */
    public function findUserById($userId){
        $user = User::where('id', $userId)->get();
        if($user->isEmpty()){
            return response()->json("Not Found", 404); 
        }
        return response()->json(['user' => $user], 200); 
    }

    /**
     * Return User With Specified E-mail.
     *
     * @Author Mohamed Said.
     * 
     * @param  string  $email  User E-mail
     * 
     * @return \Illuminate\Http\Response
     */
    public function findUserByEmail($userEmail){
        $user = User::where('email', $userEmail)->get();
        if($user->isEmpty()){
            return response()->json("Not Found", 404); 
        }
        return response()->json(['user' => $user], 200); 
    }

    /**
     * Register A New User Inside The System.
     *
     * @Author Mohamed Said.
     * 
     * @return \Illuminate\Http\Response
     */
    public function userRegister(Request $request)
    {
        $this->validate($request, [
            "name" => "required|min:3|max:25",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:8|max:50",
            "phone" => "min:8|max:18",
            "address" => "min:6|max:50"
        ]);
        \DB::beginTransaction();
        $user = new User();
        $user->fill($request->all());
        $user->password=Hash::make($request->password);
        if ($user->save()) {
            \DB::commit();
            return response()->json(['user' => $user], 200); 
        }
        \DB::rollBack();
        return response('There Is An Error', 500);
    }
    
    /**
     * Delete User From System Using It's Id.
     *
     * @Author Mohamed Said.
     * 
     * @param  int  $userId User Id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId)
    {
        try {
            $user = User::find($userId);
            if ($user->delete())
                return response()->json("Deleted", 200); 
        } catch (\Exception $exception) {
            return response()->json("Can't Delete Item", 500); 
        }
        return response()->json("Can't Delete Item", 500); 
    }

     /**
     * Update User Item Using It's Id.
     *
     * @Author Mohamed Said.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  object $user User Object
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            "name" => "required|min:3|max:25",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:8|max:50",
            "phone" => "min:8|max:18",
            "address" => "min:6|max:50"
        ]);
        $user->fill($user->all());
        if ($user->save())
            return response()->json("Update Done", 200);
        return response()->json("Error", 500); 
        }

}
