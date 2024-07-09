<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use App\Models\Avatar;
use App\Http\Controllers\AvatarController;

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
        $APP_URL = env('APP_URL');
        $avatar = $APP_URL.'avatar.webp';
        if($user){
            $AvatarController = new AvatarController();
            $avatar = $AvatarController->get($user->id);
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
            'recaptcha_site_key' => config('services.google_recaptcha.site_key'),
        ];
    }
}
