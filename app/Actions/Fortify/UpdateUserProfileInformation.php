<?php

namespace App\Actions\Fortify;

use App\Contracts\IImageService;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    public function __construct(
        private IImageService $imageService,
    ) {}

    /**
     * Validate and update the given user's profile information.
     *
     * @param array<string, string> $input
     *
     * @throws ValidationException
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:150'],
            'phone_number' => [
                'required',
                'string',
                'max:12',
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => ['nullable', 'email', Rule::unique('users')->ignore($user->id)],
            'user_info' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image', 'mimetypes:image/jpeg,image/jpg,image/png,image/webp'],
        ])->validateWithBag('updateProfileInformation');

        $user->forceFill([
            'name' => $input['name'],
            'phone_number' => $input['phone_number'],
            'email' => $input['email'] ?? $user->email,
            'user_info' => $input['user_info'] ?? $user->user_info,
            // 'avatar' => isset($input['avatar']) && $input['avatar'] ? $input['avatar']->store('avatars', 'public') : $user->avatar,
            'avatar' => isset($input['avatar']) && $input['avatar'] ? $this->imageService->uploadImage($input['avatar'], 'avatars') : $user->avatar,
        ])->save();

    }
}
