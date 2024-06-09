<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Provider;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ProviderController extends Controller
{
    public function index():Response
    {
        //Paginar proveedores
        $providers = Provider::where('company_id', Auth::user()->company_id)->paginate(10);



        return Inertia::render('Providers/Index', [
            'providersPagination' => $providers,
        ]);
    }

    public function store(ProviderRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['company_id'] = Auth::user()->company_id;

        Provider::create($data);

        return Redirect::route('providers');
    }
}
