<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use App\Http\Resources\Json as JsonResource;

class ColorsController extends Controller {

    public function list()
    {
        return Color::all();
    }


    public function create(Request $request) {

        $data = $request->validate([
            'name' => 'required|string',
            'hex_value' => 'required|string|min:6|max:6',
            'status' => 'required|boolean'
        ]);

        $newColor = new Color();
        $newColor->fill($data);
        $newColor->hex_value = "#" . $data['hex_value'];
        $newColor->save();

        if ($request->wantsJson()) {
            return JsonResource::make($newColor)->withSuccess(__('New color has been saved!'));
        }
    }

    // public function edit(Request $request, Color $color) {
    //     $data = $request->validate([]);
    //     if ($request->wantsJson()) {
    //         return JsonResource::make()->withSuccess(__('Color has been changed!'));
    //     }
    // }

    public function delete(Request $request, Color $color) {

        $color->delete();

        if ($request->wantsJson()) {
            return JsonResource::make()->withSuccess(__('Color has been deleted!'));
        }
    }

    public function changeStatus(Request $request, Color $color) {
        
        $color->update([
            'status' => !$color->status,
        ]);
        
        if ($request->wantsJson()) {
            return JsonResource::make()->withSuccess(__('Color status has been changed!'));
        }
    }
}
