<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Ypk;
use Illuminate\Http\Request;

class CurrentUserController extends Controller
{
    public function index(Request $request)
    {

        $current_user = $request->user();
        $ypk = Ypk::all();

        return view('user.home', [
            'current_user' => $current_user,
            'ypk' => $ypk
        ]);
    }

    public function edit(Request $request)
    {
        $user = $request->user();
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, UpdateUserProfileInformation $updater)
    {
        $updater->update($request->user(), $request->all());
        return to_route('home');
    }
}
