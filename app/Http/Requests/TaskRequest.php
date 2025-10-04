<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'title' => 'required_without:status|nullable|string|max:255',
            'description' => 'required_without:status|nullable|string|max:2000',
            'required_volunteers' => 'required_without:status|nullable|integer|min:1',
            'execution_time' => 'required_without:status|nullable|date_format:H:i',
            'campaign_id' => 'required_without:status|exists:campaigns,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required_without' => 'يجب إدخال عنوان المهمة',
            'description.required_without' => 'يجب إدخال وصف المهمة',
            'required_volunteers.required_without' => 'حدد عدد المتطوعين المطلوبين',
            'required_volunteers.integer' => 'عدد المتطوعين يجب أن يكون رقمًا صحيحًا',
            'execution_time.required_without' => 'حدد وقت تنفيذ المهمة',
            'execution_time.date_format' => 'وقت التنفيذ يجب أن يكون بصيغة ساعة:دقيقة (HH:MM)',
            'campaign_id.required_without' => 'يجب تحديد الحملة المرتبطة بالمهمة',
            'campaign_id.exists' => 'الحملة المحددة غير موجودة',
        ];
    }
}
