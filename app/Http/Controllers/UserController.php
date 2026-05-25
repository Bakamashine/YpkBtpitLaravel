<?php
/**
 * Контроллер для управления пользователями (административная панель).
 *
 * Предоставляет CRUD-операции для работы с пользователями: просмотр списка,
 * создание, редактирование и удаление. Доступен только администраторам.
 */

namespace App\Http\Controllers;

use App\Contracts\IImageService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\Ypk;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param IImageService $imageService
     */
    public function __construct(private IImageService $imageService)
    {
    }

    /**
     * Показать список всех пользователей с пагинацией.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::with('role')
            ->when($search, function ($query, $search) {
                $query->whereLike('name', "%{$search}%")
                    ->orWhereLike('phone_number', "%{$search}%")
                    ->orWhereLike('email', "%{$search}%")
                    ->orWhereLike('user_info', "%{$search}%");
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        $roles = Role::all();
        $ypks = Ypk::all();

        return view('users.index', compact('users', 'roles', 'ypks'));
    }

    /**
     * Создать нового пользователя.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->imageService->uploadImage($request->file('avatar'), "avatar");
        }

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return to_route('user_management.index');
    }

    public function create()
    {
        $roles = Role::all();
        $ypks = Ypk::all();

        return view('users.create', compact('roles', 'ypks'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $ypks = Ypk::all();

        return view('users.edit', compact('user', 'roles', 'ypks'));
    }

    /**
     * Обновить данные пользователя.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->imageService->updateImage($request->file('avatar'), 'avatars', $user->avatar);
        }

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return to_route('user_management.index');
    }

    /**
     * Удалить пользователя.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $this->imageService->removeImage($user->avatar);
        $user->delete();

        return to_route('user_management.index');
    }
}
