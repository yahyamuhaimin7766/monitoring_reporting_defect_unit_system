<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePemasanganRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $method = $this->method();
        $rules = [];
        switch ($method) {
            case 'PUT':
                $rules = [
                    'tanggal' => 'required|date',
                    'type' => 'required',
                    'no_sasis' => 'required',
                    'no_mesin' => 'required',
                    'warna' => 'required',
                    'varian' => 'required',
                ];
                break;
            case 'PATCH':
                $rules = [
                    'tanggal' => 'required|date',
                    'type' => 'required',
                    'no_sasis' => 'required',
                    'no_mesin' => 'required',
                    'warna' => 'required',
                    'varian' => 'required',
                ];
                break;
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'tanggal.required' => 'Tanggal wajib diisi',
            'tanggal.date' => 'Harus Berupa Tanggal',
            'no_sasis.required' => 'Nomor sasis wajib diisi',
            'no_mesin.required' => 'Nomor Mesin wajib diisi',
            'type.required' => 'Type wajib diisi',
            'warna.required' => 'Warna wajib diisi',
            'varian.required' => 'Varian wajib diisi',
        ];
    }
}
