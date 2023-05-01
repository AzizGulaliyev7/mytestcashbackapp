<?php

namespace App\Modules\Cashback\Requests;

use App\Traits\ResponseAble;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use function App\Modules\Requests\__;

class CashbackRequest extends FormRequest
{
    use ResponseAble;
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
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'               => 'required|integer',
            'cashback_action_id'    => 'required|integer',
            'attributes'            => 'required|array'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        return $this->sendError(
            $errors,
            __('messages.validation_error'),
            422
        );

    }
}
