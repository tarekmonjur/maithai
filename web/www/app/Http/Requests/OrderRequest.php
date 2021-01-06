<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $tableName = (new Order())->getTable();
        if ($this->request->get('order_status') === 'completed'){
            $payment_type = ['required', 'in:cash,card'];
        } else {
            $payment_type = ['required'];
        }

//        if ($id = $this->segment(3)) {
//            $name = ['required', 'min:2', 'max:45', 'unique:'.$tableName.',name,'.$id];
//        } else {
//            $name = ['required', 'min:2', 'max:45', 'unique:'.$tableName.',name'];
//        }

        return [
            'payment_type' => $payment_type,
        ];
    }
}
