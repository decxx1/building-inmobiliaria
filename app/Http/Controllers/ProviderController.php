<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Provider;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ProviderController extends Controller
{
    public function index():Response
    {
        //Paginar proveedores
        $providers = Provider::where('company_id', Auth::user()->company_id)->orderBy('name', 'ASC');

        if(request()->has('search') && request('search') != ''){
            $providers = $providers->where('name', 'like', '%'.request('search').'%');
        }

        return Inertia::render('Providers/Index', [
            'providersPagination' => $providers->paginate(10),
        ]);
    }

    public function store(ProviderRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['company_id'] = Auth::user()->company_id;

        Provider::create($data);

        return Redirect::route('providers');
    }

    public function update(ProviderRequest $request, int $id): RedirectResponse
    {
        if(!$id){
            return redirect()->back()->withErrors([
                'message' => 'No se encontró el proveedor'
            ]);
        }
        $provider = Provider::findOrFail($id);

        try{
            //$this->authorize('update', $user);
            $provider->update($request->validated());

            return Redirect::route('providers');
        } catch (\Exception $e){
            return redirect()->back()->withErrors([
                'message' => 'Error al actualizar provider',
                'error' => $e->getMessage()
            ]);
        }

    }
}
