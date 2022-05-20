<?php

namespace App\Http\Controllers\API;

use Redirect;
use App\Models\Color;
use App\Http\Requests\ColorRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Json as JsonResource;
use App\Http\Resources\Api\ColorResource;
use Symfony\Component\HttpFoundation\Request;

class ColorsController extends Controller {

    public function list()
    {
        $colors = Color::where('status', 1)
            ->orWhere('status', 0)
            ->orderBy('name')
            ->limit(50)
            ->get();
        
        return JsonResource::make(['colors' => ColorResource::collection($colors)])->withSuccess(__('List of color are sent!'));
    }

    public function create(ColorRequest $request)
    {
        $data = $request->validated();

        $newColor = new Color();
        $newColor->fill($data);
        $newColor->handleHexValue($data['hex_value']);
        $newColor->save();

        if ($request->wantsJson()) {
            return JsonResource::make(['color' => new ColorResource($newColor)])->withSuccess(__('New color has been saved!'));
        }
        // return Redirect::route('handle_route');
    }

    public function getColorById(Request $request, $id)
    {
        $color = Color::firstWhere('id', $id);
        if(!$color) {
            return JsonResource::make([])->withError(__('Color does not exist!'));
        }
        return JsonResource::make(['color' => new ColorResource($color)])->withSuccess(__('Color sent!'));
    }

    public function edit(ColorRequest $request, Color $color)
    {
        $data = $request->validated();

        $color->update($data);
        $color->handleHexValue($data['hex_value']);
        $color->save();
        
        if ($request->wantsJson()) {
            return JsonResource::make()->withSuccess(__('Color has been changed!'));
        }
        // return Redirect::route('handle_route');
    }

    public function delete(Request $request, Color $color)
    {
        $color->delete();

        if ($request->wantsJson()) {
            return JsonResource::make()->withSuccess(__('Color has been deleted!'));
        }
        // return Redirect::route('handle_route');
    }

    public function changeStatus(Request $request, Color $color)
    {
        $color->changeStatus();

        if ($request->wantsJson()) {
            return JsonResource::make(['color' => new ColorResource($color)])->withSuccess(__('Color status has been changed!'));
        }
        // return Redirect::route('handle_route');
    }
}
