<?php

namespace App\Http\Controllers;

use App\Contracts\IImageService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\Ypk;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct(private IImageService $imageService)
    {
    }
    public function index()
    {
        $users = User::with('role')->paginate(10);
        $roles = Role::all();
        $ypks = Ypk::all();

        return view('users.index', compact('users', 'roles', 'ypks'));
    }

    public function store(StoreUserRequest $request)
    {
        // $data = $request->validated();
        $data = $request->all();

        if ($request->hasFile('avatar')) {
            // $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $this->imageService->uploadImage($request->file('avatar'), "avatar");
        }

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return to_route('user_management.index');
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return to_route('user_management.index');
    }

    public function destroy(User $user)
    {

        $this->imageService->removeImage($user->avatar);
        // if ($user->avatar) {
        //     Storage::disk('public')->delete($user->avatar);
        // }

        $user->delete();

        return to_route('user_management.index');
    }
}
