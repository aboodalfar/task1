<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Services\UserServiceInterface;

class UserController extends Controller
{
    /**
     *
     */
    public function __construct(
        public UserServiceInterface $userService,
    ) {}


    /**
     * view list of users
     * @return View
     */
    public function index():View{
        return view('admin.user.index', [
            'users' => $this->userService->list()
        ]);
    }

    /**
     * view deatils of user
     * @param int $id
     * @return View
     */
    public function show($id):View{
        return view('admin.user.view', [
            'user' => $this->userService->find($id)
        ]);
    }

    /**
     * edit deatils of user
     * @param int $id
     * @return View
     */
    public function edit($id):View{
        return view('admin.user.edit', [
            'user' => $this->userService->find($id)
        ]);
    }

    /**
     * update user
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UserRequest $request, $id):RedirectResponse{
        $this->userService->update($id,$request->validated());
        return redirect()->back()->with('with_success', 'Account was Updated succesfully!');
    }

    /**
     * view list of deleted users
     * @return View
     */
    public function trashed():View{
        return view('admin.user.trashed', [
            'users' => $this->userService->listTrashed()
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function restore($id):RedirectResponse{
        $this->userService->restore($id);
        return redirect()->back()->with('with_success', 'Account was restore succesfully!');
    }
    public function delete($id):RedirectResponse{
        $this->userService->delete($id);
        return redirect()->back()->with('with_success', 'Account was deleted succesfully!');
    }
}
