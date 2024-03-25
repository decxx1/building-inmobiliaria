<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use App\Models\Avatar;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        //encontrar el avatar del usuario
        $user = $request->user();

        $avatar = 'avatar.webp';
        if($user){
            $userAvatar = Avatar::where('user_id', $user->id)->first();
            $avatar = $userAvatar  ? $userAvatar->thumbnail : 'avatar.webp';
        }


        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'avatar' => $avatar,
            ],
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
        ];
    }
}
