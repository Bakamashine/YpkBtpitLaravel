<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     *
     * @throws ValidationException
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'fullname' => ['required', 'string', 'max:150'],
            'phone_number' => [
                'required',
                'string',
                'max:12',
                Rule::unique('users')->ignore($user->id),
            ],
            'user_info' => ['nullable', 'string'],
            'avatar_path' => ['nullable', 'string'],
        ])->validateWithBag('updateProfileInformation');

        $user->forceFill([
            'fullname' => $input['fullname'],
            'phone_number' => $input['phone_number'],
            'user_info' => $input['user_info'] ?? $user->user_info,
            'avatar_path' => $input['avatar_path'] ?? $user->avatar_path,
        ])->save();
    }
}
