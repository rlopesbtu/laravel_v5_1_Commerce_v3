<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use CodeCommerce\User;
use Illuminate\Http\Request;


class UsersController extends Controller
{

    private $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function index()
    {
        $users = $this->userModel->paginate(10);
        return view('users.index', compact('users'));
    }


    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['is_admin'] = $request->get('is_admin') ? true : false;
        $input['password'] = bcrypt($input['password']);

        $user = $this->userModel->fill($input);
        $user->save();

        return redirect()->route('users.index');
    }


    public function show($id)
    {
        $user = $this->userModel->find($id);

        return view('users.show', compact('user'));
    }


    public function edit($id)
    {
        $user = $this->userModel->find($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $input['is_admin'] = $request->get('is_admin') ? true : false;
        $this->userModel->find($id)->update($input);
        return redirect()->route('users.index');
    }


    public function destroy($id)
    {
        $this->userModel->find($id)->delete();
        return redirect()->route('users.index');
    }



}