<?php

declare(strict_types=1);

namespace App\Http\Requests\User\Cat;

use App\DataObjects\CatData;
use App\Enums\CatGender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertCatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image_url' => [
                'required',
                'url',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'age' => [
                'required',
                'integer',
                'min:1',
                'max:255',
            ],
            'gender' => [
                'required',
                'string',
                Rule::enum(CatGender::class),
            ],
            'breed' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'required',
                'string',
                'max:65535',
            ],
        ];
    }

    public function toDataObject(): CatData
    {
        return CatData::from([
            'image_url' => $this->image_url,
            'name' => $this->name,
            'age' => $this->age,
            'breed' => $this->breed,
            'gender' => $this->gender,
            'description' => $this->description,
        ]);
    }
}
