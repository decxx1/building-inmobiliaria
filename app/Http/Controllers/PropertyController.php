<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\City;
use App\Models\Zone;
use App\Models\Province;
use App\Models\Type;
use App\Models\Status;
use App\Models\Antiquity;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    public function index(Request $request):Response
    {

        $privinces = Province::all();
        $types = Type::all();
        $statuses = Status::all();
        $antiquities = Antiquity::all();
        $users = User::all();

        $validator = Validator::make($request->all(), [
            'type' => 'nullable|integer',
            'status' => 'nullable|integer',
            'user' => 'nullable|integer',
            'province' => 'nullable|integer',
            'price' => 'nullable|string', // Ajusta los valores permitidos según tu caso
            'priceMin' => 'nullable|numeric',
            'priceMax' => 'nullable|numeric',
            'search' => 'nullable|string',
        ]);

        // Obtener los datos validados
        $validated = $validator->validated();

        $properties = Property::orderBy('created_at', 'DESC');
        //si se activa un filtro
        if(isset($validated['type']) && $validated['type'] != 0){
            $searchType = $validated['type'];
            $properties->where('type_id', $searchType);
        }
        if(isset($validated['status']) && $validated['status'] != 0){
            $searchStatus = $validated['status'];
            $properties->where('status_id', $searchStatus);
        }
        if(isset($validated['user']) && $validated['user'] != 0){
            $searchUser = $validated['user'];
            $properties->where('seller_id', $searchUser);
        }
        if(isset($validated['province']) && $validated['province'] != 0){
            $searchProvince = $validated['province'];
            $properties->where('province_id', $searchProvince);
        }
        if(isset($validated['price']) && $validated['price'] != 'all'){
            $searchPrice = $validated['price'];
            $searchPrice = $searchPrice === 'USD' ? true : false;
            $properties->where(function($query) use ($searchPrice) {
                $query->where('is_price_dollar', $searchPrice)
                      ->orWhere('price_hidden', true);
            });
        }
        // Aplicar los filtros de precio mínimo y máximo
        if (isset($validated['priceMin']) && $validated['priceMin'] != 0) {
            $priceMin = $validated['priceMin'];
            $properties->where('price_property', '>=', $priceMin);
        }
        if (isset($validated['priceMax']) && $validated['priceMax'] != 0) {
            $priceMax = $validated['priceMax'];
            $properties->where('price_property', '<=', $priceMax);
        }

        //si se realiza una búsqueda
        if(isset($validated['search']) && $validated['search'] != ''){
            $search = $validated['search'];
            $properties->where(function($query) use ($search) {
                $query->where('description', 'like', '%' . $search . '%')
                      ->orWhere('address', 'like', '%' . $search . '%');
            });
        }
        //Paginar
        $pagination = $properties->paginate(10);



        //agregar las relaciones
        $formattedProperties = collect($pagination->items())->map(function ($property) {
            $property->province = Province::where('id', $property->province_id)->pluck('name')->first();
            $property->city = City::where('id', $property->city_id)->pluck('name')->first();
            $property->zone = Zone::where('id', $property->zone_id)->pluck('name')->first();
            $property->seller = User::where('id', $property->seller_id)->pluck('name')->first();
            $property->type = Type::where('id', $property->type_id)->pluck('name')->first();
            $property->status = Status::where('id', $property->status_id)->pluck('name')->first();
            $property->antiquity = Antiquity::where('id', $property->antiquity_id)->pluck('name')->first();
            $imageController = new ImageController();
            $property->currentImageCover = $imageController->getThumb($property->id, 1);
            // Iterar sobre los índices de las imágenes extras
            for ($i = 2; $i <= 6; $i++) {
                $imagePath = $imageController->getThumb($property->id, $i);
                $newName = 'currentImageExtra'.$i;
                if (!empty($imagePath)) {
                    $property->$newName = $imagePath;
                }
            }
            return $property;
        });

        return Inertia::render('App/Properties/Index', [
            'currentPage' => $pagination->currentPage(),
            'properties' => $formattedProperties,
            'perPage' => $pagination->perPage(),
            'totalProperties' => $pagination->total(),
            'provinces' => fn () => $privinces,
            'types' => fn () => $types,
            'statuses' => fn () => $statuses,
            'antiquities' => fn () => $antiquities,
            'users' => fn () => $users,
        ]);
    }

    public function inmueblesWebShow(int $id):Response
    {
        //validar si se encontró el inmueble
        $property = Property::findOrFail($id);

        //agregar las relaciones
        $property->province = Province::where('id', $property->province_id)->pluck('name')->first();
        $property->city = City::where('id', $property->city_id)->pluck('name')->first();
        $property->zone = Zone::where('id', $property->zone_id)->pluck('name')->first();
        $property->seller = User::where('id', $property->seller_id)->pluck('name')->first();
        $property->type = Type::where('id', $property->type_id)->pluck('name')->first();
        $property->status = Status::where('id', $property->status_id)->pluck('name')->first();
        $property->antiquity = Antiquity::where('id', $property->antiquity_id)->pluck('name')->first();
        $imageController = new ImageController();
        $property->currentImageCover = $imageController->getImageFull($property->id, 1);
        // Iterar sobre los índices de las imágenes extras
        for ($i = 2; $i <= 6; $i++) {
            $imagePath = $imageController->getImageFull($property->id, $i);
            $newName = 'currentImageExtra'.$i;
            if (!empty($imagePath)) {
                $property->$newName = $imagePath;
            }
        }


        return Inertia::render('Inmueble', [
            'property' => $property,
        ]);
    }

    public function indexWeb():Response
    {
        $properties = Property::orderBy('created_at', 'DESC');

        $types = Type::all();
        $statuses = Status::all();

        //Paginar
        $pagination = $properties->paginate(8);

        //agregar las relaciones
        $formattedProperties = collect($pagination->items())->map(function ($property) {
            $property->type = Type::where('id', $property->type_id)->pluck('name')->first();
            $property->status = Status::where('id', $property->status_id)->pluck('name')->first();
            $imageController = new ImageController();
            $property->currentImageCover = $imageController->getThumb($property->id, 1);
            return $property;
        });

        return Inertia::render('Index', [
            'properties' => $formattedProperties,
            'types' => fn () => $types,
            'statuses' => fn () => $statuses,
        ]);
    }

    public function inmueblesWeb(Request $request):Response
    {
        $privinces = Province::all();
        $types = Type::all();
        $statuses = Status::all();

        $validator = Validator::make($request->all(), [
            'type' => 'nullable|integer',
            'status' => 'nullable|integer',
            'user' => 'nullable|integer',
            'province' => 'nullable|integer',
            'city' => 'nullable|integer',
            'price' => 'nullable|string', // Ajusta los valores permitidos según tu caso
            'priceMin' => 'nullable|numeric',
            'priceMax' => 'nullable|numeric',
            'search' => 'nullable|string',
        ]);

        // Obtener los datos validados
        $validated = $validator->validated();

        $properties = Property::orderBy('created_at', 'DESC');
        //si se activa un filtro
        if(isset($validated['type']) && $validated['type'] != 0){
            $searchType = $validated['type'];
            $properties->where('type_id', $searchType);
        }
        if(isset($validated['status']) && $validated['status'] != 0){
            $searchStatus = $validated['status'];
            $properties->where('status_id', $searchStatus);
        }
        if(isset($validated['province']) && $validated['province'] != 0){
            $searchProvince = $validated['province'];
            $properties->where('province_id', $searchProvince);
        }
        if(isset($validated['city']) && $validated['city'] != 0){
            $searchCity = $validated['city'];
            $properties->where('city_id', $searchCity);
        }
        if(isset($validated['price']) && $validated['price'] != 'all'){
            $searchPrice = $validated['price'];
            $searchPrice = $searchPrice === 'USD' ? true : false;
            $properties->where(function($query) use ($searchPrice) {
                $query->where('is_price_dollar', $searchPrice)
                      ->orWhere('price_hidden', true);
            });
        }
        // Aplicar los filtros de precio mínimo y máximo
        if (isset($validated['priceMin']) && $validated['priceMin'] != 0) {
            $priceMin = $validated['priceMin'];
            $properties->where('price_property', '>=', $priceMin);
        }
        if (isset($validated['priceMax']) && $validated['priceMax'] != 0) {
            $priceMax = $validated['priceMax'];
            $properties->where('price_property', '<=', $priceMax);
        }

        //si se realiza una búsqueda
        if(isset($validated['search']) && $validated['search'] != ''){
            $search = $validated['search'];
            $properties->where(function($query) use ($search) {
                $query->where('description', 'like', '%' . $search . '%')
                      ->orWhere('address', 'like', '%' . $search . '%');
            });
        }
        //Paginar
        $pagination = $properties->paginate(10);



        //agregar las relaciones
        $formattedProperties = collect($pagination->items())->map(function ($property) {
            $property->province = Province::where('id', $property->province_id)->pluck('name')->first();
            $property->city = City::where('id', $property->city_id)->pluck('name')->first();
            $property->zone = Zone::where('id', $property->zone_id)->pluck('name')->first();
            $property->seller = User::where('id', $property->seller_id)->pluck('name')->first();
            $property->type = Type::where('id', $property->type_id)->pluck('name')->first();
            $property->status = Status::where('id', $property->status_id)->pluck('name')->first();
            $property->antiquity = Antiquity::where('id', $property->antiquity_id)->pluck('name')->first();
            $imageController = new ImageController();
            $property->currentImageCover = $imageController->getThumb($property->id, 1);

            return $property;
        });

        return Inertia::render('Inmuebles', [
            'currentPage' => $pagination->currentPage(),
            'properties' => $formattedProperties,
            'perPage' => $pagination->perPage(),
            'totalProperties' => $pagination->total(),
            'provinces' => fn () => $privinces,
            'types' => fn () => $types,
            'statuses' => fn () => $statuses,
        ]);
    }

    public function store(PropertyRequest $request): RedirectResponse
    {

        // Validar imágenes separadamente
        $imageRules = [
            'imageCover' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'imageExtra2' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'imageExtra3' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'imageExtra4' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'imageExtra5' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'imageExtra6' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ];
        $imageValidator = Validator::make($request->all(), $imageRules);

        if ($imageValidator->fails()) {
            return redirect()->back()->withErrors($imageValidator)->withInput();
        }
         // Obtener datos validados para la propiedad
        $data = $request->validated();

        // Crear la propiedad sin imágenes
        $property = Property::create($data);

        // Subir imágenes aparte
        $imageController = new ImageController(); // Mejor cambiar esto por un servicio o helper
        $key=1;
        foreach (['imageCover', 'imageExtra2', 'imageExtra3', 'imageExtra4', 'imageExtra5', 'imageExtra6'] as $imageField) {
            if ($request->hasFile($imageField)) {
                $imageController->upload($request->file($imageField), $property->id, $key);
            }
            $key++;
        }

        return redirect()->back();
    }

    public function update(PropertyRequest $request, int $id): RedirectResponse
    {
        //validar si se encontró el inmueble
        $property = Property::findOrFail($id);

        // Validar imágenes separadamente
        $imageValidation = Validator::make($request->all(), [
            'imageCover' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'imageExtra2' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'imageExtra3' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'imageExtra4' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'imageExtra5' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'imageExtra6' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($imageValidation->fails()) {
            return redirect()->back()->withErrors($imageValidation)->withInput();
        }

        // Obtener datos validados
        $data = $request->validated();
       try{

            //subir imágenes aparte
            $imageController = new ImageController();
            $key=1;
            foreach (['imageCover','imageExtra2', 'imageExtra3', 'imageExtra4', 'imageExtra5', 'imageExtra6'] as $imageField) {
                if ($request->hasFile($imageField)) {
                    $imageController->upload($request->file($imageField), $property->id, $key);
                }
                $key++;
            }

            // Actualizar la propiedad con los nuevos datos
            $property->update($data);

            return redirect()->back();
        } catch (\Exception $e){
            return redirect()->back()->withErrors([
                'message' => 'Error al actualizar inmueble',
                'error' => $e->getMessage()
            ]);
        }

    }

    public function destroy(Request $request, int $id): RedirectResponse
    {
        $property = Property::findOrFail($id);

        try{
            //eliminar carpeta de images de propiedad
            $dir = public_path('images/properties/'.$id);
            $controller = new Controller();
            $controller->delTree($dir);

            $property->delete();

            return redirect()->back();
        } catch (\Exception $e){
            return redirect()->back()->withErrors([
                'message' => 'Error al eliminar inmueble',
                'error' => $e->getMessage()
            ]);
        }

    }
}
