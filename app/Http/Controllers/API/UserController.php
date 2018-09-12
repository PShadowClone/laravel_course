<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{


    public function index()
    {
        $users = User::paginate(10);
        return parent::success($users);
    }

    /**
     *
     * store new user
     *
     * @param Request $request
     * @return $this
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), $this->rules());
        if ($validation->fails()) {
            return parent::error($validation->errors(), 404);
        }

        $user = new User();
        $request['password'] = Hash::make($request->input('password'));
        $user->fill($request->all());
        $user->save();
        return parent::success($user);
    }


    /**
     *
     * delete user's info
     *
     * @param null $id
     * @return $this
     */
    public function destroy($id = null)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return $this->success($user);
        } catch (\Exception $exception) {
            return parent::error('user not found');
        }

    }

    /**
     *
     * update user's infos
     *
     * @param Request $request
     * @param $id
     * @return $this
     */
    public function update(Request $request, $id)
    {

        try {
            $user = User::findOrFail($id);

        } catch (ModelNotFoundException $modelNotFoundException) {
            return parent::error('user not found');
        }
        $validation = Validator::make($request->all(), $this->rules($id));
        if ($validation->fails()) {
            return parent::error($validation->errors(), 404);
        }
        $user->fill($request->all());
        $user->update();
        return parent::success($user);
    }


    public function show(Request $request, $id = null)
    {
        try {
            $user = User::paginate($request->input('per_page', 10));
            if ($id) {
                $user = User::findOrFail($id);
            }
            return parent::success($user);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return parent::error('user not found');
        }
    }

    private function rules($id = null)
    {
        $rules = [
            'username' => 'required|unique:users',
            'email' => 'required|unique:users,email|email',
            'name' => 'required',
            'phone' => 'required|unique:users',
        ];

        if (!$id) {
            $rules['password'] = 'required|min:6';
        }
        return $rules;
    }

}
