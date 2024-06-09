<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use App\Models\Avatar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;



class UserController extends Controller
{
    public function index():Response
    {
        //Paginar usuarios
        $users = User::where('company_id', Auth::user()->company_id)->paginate(10);
        //agregar avatar a los usuarios
        $formattedUsers = collect($users->items())->map(function ($user) {
            $AvatarController = new AvatarController();
            $user->avatar = $AvatarController->get($user->id);
            return $user;
        });
        //crear paginador
        $paginator = new LengthAwarePaginator(
            $formattedUsers,
            $users->total(),
            $users->perPage(),
            $users->currentPage(),
            [
                'path' => Paginator::resolveCurrentPath(),
                'query' => request()->query(),
            ]
        );

        return Inertia::render('Users/Index', [
            'usersPagination' => $paginator,
        ]);
    }


    public function store(UserRequest $request): RedirectResponse
    {
        User::create([
            'company_id' => Auth::user()->company_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return Redirect::route('users');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        if(!$id){
            return redirect()->back()->withErrors([
                'message' => 'No se encontró el usuario'
            ]);
        }
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        try{
            //$this->authorize('update', $user);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            return Redirect::route('users');
        } catch (\Exception $e){
            return redirect()->back()->withErrors([
                'message' => 'Error al actualizar usuario',
                'error' => $e->getMessage()
            ]);
        }

    }
    public function updatePassword(Request $request, int $id): RedirectResponse
    {
        if(!$id){
            return redirect()->back()->withErrors([
                'message' => 'No se encontró el usuario'
            ]);
        }
        $user = User::findOrFail($id);

        if (!Hash::check($request->password_current, $user->password)) {
            // The passwords do not match
            return redirect()->back()->withErrors([
                'message' => 'La contraseña actual no coincide con la registrada'
            ]);
        }
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try{
            //$this->authorize('update', $user);
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return Redirect::route('users');
        } catch (\Exception $e){
            return redirect()->back()->withErrors([
                'message' => 'Error al actualizar usuario',
                'error' => $e->getMessage()
            ]);
        }

    }

    public function destroy(Request $request, int $id): RedirectResponse
    {
        if(!$id){
            return redirect()->back()->withErrors([
                'message' => 'No se encontró el usuario'
            ]);
        }

        try{
            $user = User::findOrFail($id);
            //eliminar carpeta de avatar
            $dir = public_path('avatars/'.$id);
            $controller = new Controller();
            $controller->delTree($dir);

            $user->delete();

            return Redirect::route('users');
        } catch (\Exception $e){
            return redirect()->back()->withErrors([
                'message' => 'Error al eliminar usuario',
                'error' => $e->getMessage()
            ]);
        }

    }

    public function updateAvatar(Request $request, int $id): RedirectResponse
    {
        if(!$id){
            return redirect()->back()->withErrors([
                'message' => 'No se encontró el usuario'
            ]);
        }

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:3072',
        ]);

        try{
            $user = User::findOrFail($id);
            if($request->hasFile('image')){
                $avatar = new AvatarController();
                $avatar->upload($request, $user->id);
            }

            return Redirect::route('users');
        } catch (\Exception $e){
            return redirect()->back()->withErrors([
                'message' => 'Error al actualizar imagen',
                'error' => $e->getMessage()
            ]);
        }

    }
}
