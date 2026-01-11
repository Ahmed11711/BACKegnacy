<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'items' => ['required', 'array', 'min:1'],
            'items.*.orderable_type' => ['required', 'string', 'in:App\Models\Product,App\Models\Bundle'],
            'items.*.orderable_id' => ['required', 'integer'],
            'items.*.name' => ['required', 'string'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.price' => ['required', 'numeric', 'min:0'],
            'billing_address' => ['required', 'array'],
            'billing_address.street' => ['required', 'string'],
            'billing_address.city' => ['required', 'string'],
            'billing_address.state' => ['required', 'string'],
            'billing_address.zip' => ['required', 'string'],
            'billing_address.country' => ['required', 'string'],
            'shipping_address' => ['required', 'array'],
            'shipping_address.street' => ['required', 'string'],
            'shipping_address.city' => ['required', 'string'],
            'shipping_address.state' => ['required', 'string'],
            'shipping_address.zip' => ['required', 'string'],
            'shipping_address.country' => ['required', 'string'],
            'notes' => ['nullable', 'string'],
            'tax' => ['nullable', 'numeric', 'min:0'],
            'shipping' => ['nullable', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'min:0'],
        ];
    }
}
