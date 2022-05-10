<?php

namespace App\Http\Controllers\API;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Json as JsonResource;
use App\Http\Resources\Api\Filter\ColorResource;

class ColorsController extends Controller {

    public function list()
    {
        $colors = Color::where('status', 1)
            ->orderBy('name')
            ->limit(10)
            ->get();
        
        return JsonResource::make(ColorResource::collection($colors))->withSuccess(__('List of color are sent!'));
    }

    public function create(Request $request) {

        $data = $request->validate([
            'name' => 'required|string',
            'hex_value' => 'required|string|min:6|max:6',
            'status' => 'required|boolean'
        ]);

        $newColor = new Color();
        $newColor->fill($data);
        $newColor->handleHexValue($data['hex_value']);
        $newColor->save();

        if ($request->wantsJson()) {
            return JsonResource::make(new ColorResource($newColor))->withSuccess(__('New color has been saved!'));
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

    public function changeStatus(Request $request, Color $color)
    {
        $color->changeStatus();
        
        if ($request->wantsJson()) {
            return JsonResource::make(new ColorResource($color))->withSuccess(__('Color status has been changed!'));
        }
    }
}
