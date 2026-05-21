<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class CurrentUserController extends Controller
{
    public function index(Request $request)
    {

        $current_user = $request->user();
        return view('user.home', [
            'current_user'  => $current_user,

        ]);
    }

    public function edit(Request $request) {
        $user = $request->user();
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, UpdateUserProfileInformation $updater) {
        $updater->update($request->user(), $request->all());
        return to_route('home');
    }
}
