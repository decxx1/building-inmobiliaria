<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'province_id' => ['required', 'exists:provinces,id', 'integer'],
            'city_id' => ['required', 'exists:cities,id', 'integer'],
            'zone_id' => ['nullable', 'integer'],
            'neighborhood' => ['nullable', 'string', 'max:60'],
            'address' => ['required', 'string', 'max:100'],
            'lat' => ['required', 'numeric'],
            'lng' => ['required', 'numeric'],
            'type_id' => ['nullable', 'exists:types,id', 'integer'],
            'status_id' => ['nullable', 'exists:statuses,id', 'integer'],
            'is_price_dollar' => ['required', 'boolean'],
            'price_property' => ['nullable', 'numeric'],
            'price_hidden' => ['required', 'boolean'],
            'description' => ['required', 'string'],
            'active' => ['required', 'boolean'],
            'seller_id' => ['nullable', 'exists:users,id', 'integer'],
            'price_usd_m2' => ['nullable', 'numeric'],
            'price_ars_m2' => ['nullable', 'numeric'],
            'superficie_cubierta' => ['nullable', 'integer'],
            'superficie_total' => ['nullable', 'integer'],
            'aire_acondicionado' => ['nullable', 'string'],
            'dormitorios' => ['required', 'string'],
            'amoblado' => ['nullable', 'string'],
            'internet' => ['nullable', 'string'],
            'antiquity_id' => ['nullable', 'exists:antiquities,id', 'integer'],
            'piscina' => ['nullable', 'string'],
            'hipoteca' => ['nullable', 'string'],
            'plantas' => ['nullable', 'string'],
            'banos' => ['nullable', 'string'],
            'barrio_privado' => ['nullable', 'string'],
            'cable' => ['nullable', 'string'],
            'telefono' => ['nullable', 'string'],
            'calefaccion_central' => ['nullable', 'string'],
            'zona_escolar' => ['nullable', 'string'],
            'ambientes' => ['nullable', 'string'],
            'mascotas' => ['nullable', 'string'],
            'cochera' => ['nullable', 'string'],
            'expensas' => ['nullable', 'string'],
            'conservacion' => ['nullable', 'string'],
            'financiacion' => ['nullable', 'string'],
            'permuta' => ['nullable', 'string'],
            'agua' => ['nullable', 'string'],
            'gas' => ['nullable', 'string'],
            'luz' => ['nullable', 'string'],
            'cloacas' => ['nullable', 'string'],
        ];
    }
}
