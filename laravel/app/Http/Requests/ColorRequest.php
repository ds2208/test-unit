<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ColorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        $request = request();
        // $user = auth()->user();

        $rules = [
            'name' => ['required', 'string', 'max:80'],
            'hex_value' => ['required', 'string', 'min:6', 'max:6'],
            'status' => ['required', 'boolean']
        ];
        
        if($request->action){
            
            $rules = array_merge($rules, [
                'publish_at_fixed' => ['required', 'integer', 'in:0,1'],
                'publish_at' => ['required_if:publish_at_fixed,0', 'date_format:d.m.Y H:i'],
                'comment_text' => ['nullable', 'string']
            ]);

            if($request->action == 'send-to-desk'){
                $rules = array_merge($rules, [
                    'author_initials' => ['required', 'string']
                ]);
            } else if($request->action == 'schedule-emit'){
                $rules = array_merge($rules, [
                    "schedule_emit_at" => ["required", "date_format:d.m.Y H:i", "after_or_equal:".now()->format('d.m.Y H:i')],
                ]);
            } else {
                $rules = array_merge($rules, [
                    "send_to_id" => ["required", "integer"]
                ]); 
            }
        }

        return $rules;
    }

    public function withValidator($validator)
    {   
        $request = request();
        // ako ne prodje validacija setujemo u sesiji parametar 'akcija' 
        // da bi znali sa kog modala je poslat request
        if($validator->fails()){
            session()->put('error_messages', $validator->messages());
        }
    }
}
