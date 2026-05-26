<?php
/**
 * Контроллер для работы с текущим аутентифицированным пользователем.
 *
 * Управляет отображением личного кабинета и редактированием профиля.
 */

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Order;
use App\Models\Ypk;
use Illuminate\Http\Request;

class CurrentUserController extends Controller
{
    /**
     * Показать личный кабинет пользователя.
     *
     * Передаёт в шаблон данные о текущем пользователе и список типов услуг/продуктов.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $current_user = $request->user();
        $ypk = Ypk::all();

        $orders = $current_user->executorOrders()->paginate(6);
        $favourite_products = $current_user->products()->paginate(6);
        return view('user.home', [
            'current_user' => $current_user,
            'ypk' => $ypk,
            'favourite_products' => $favourite_products,
            'orders' => $orders
        ]);
    }

    /**
     * Показать детальную информацию о пользователе.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        $user = $request->user()->load('role', 'ypk');
        return view('user.show', compact('user'));
    }

    /**
     * Показать форму редактирования профиля.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $user = $request->user();
        return view('user.edit', compact('user'));
    }

    /**
     * Обновить данные профиля пользователя.
     *
     * @param Request $request
     * @param UpdateUserProfileInformation $updater
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, UpdateUserProfileInformation $updater)
    {
        $updater->update($request->user(), $request->all());

        return to_route('home');
    }
}
