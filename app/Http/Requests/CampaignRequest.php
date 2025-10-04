<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return in_array($this->user()->role, ['admin', 'organizer']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'         => 'required_without:activity|nullable|string|max:50',
            'description'   => 'required_without:activity|nullable|string|max:255',
            'location'      => 'required_without:activity|nullable|string|max:255',
            'image'         => 'required_without:activity|nullable|image|mimes:jpg,jpeg,png|max:2048',
            'start_date'    => 'required_without:activity|nullable|date',
            'end_date'      => 'required_without:activity|nullable|date|after_or_equal:start_date',
            'organizer_id'  => 'required_without:activity|nullable|exists:users,id',

        ];
    }

    public function messages(): array
    {
        return [
            'title.required_without'   => 'عنوان الحملة مطلوب.',
            'title.string'     => 'يجب أن يكون عنوان الحملة نصاً.',
            'title.max'        => 'يجب ألا يزيد عنوان الحملة عن 50 حرفاً.',

            'description.required_without'   => 'وصف الحملة مطلوب.',
            'description.string'     => 'يجب أن يكون وصف الحملة نصاً.',
            'description.max'        => 'يجب ألا يزيد وصف الحملة عن 255 حرفاً.',

            'location.required_without'   => 'موقع الحملة مطلوب.',
            'location.string'     => 'يجب أن يكون موقع الحملة نصاً.',
            'location.max'        => 'يجب ألا يزيد موقع الحملة عن 255 حرفاً.',

            'image.image'    => 'يجب أن تكون الصورة صورة صحيحة.',
            'image.mimes'    => 'يجب أن تكون الصورة بصيغة jpeg أو png أو jpg.',
            'image.max'      => 'يجب ألا يزيد حجم الصورة عن 2 ميجابايت.',
            
            'start_date.required_without' => 'تاريخ البداية مطلوب.',
            'end_date.required_without' => 'تاريخ النهاية مطلوب.',
            'start_date.date' => 'يجب أن يكون تاريخ البداية تاريخاً صالحاً.',
            'end_date.date' => 'يجب أن يكون تاريخ النهاية تاريخاً صالحاً.',
            'end_date.after_or_equal' => 'يجب أن يكون تاريخ النهاية بعد أو يساوي تاريخ البداية.',

            'organizer_id.required_without' => 'منظم الحملة مطلوب.',
            'organizer_id.exists' => 'منظم الحملة غير موجود أو غير صالح.',

        ];
    }
}
