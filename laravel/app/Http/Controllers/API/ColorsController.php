<?php

namespace App\Http\Controllers\API;

use App\Models\Color;
use App\Http\Requests\ColorRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ColorResource;
use App\Http\Resources\Json as JsonResource;
use Symfony\Component\HttpFoundation\Request;

class ColorsController extends Controller
{

    /**
     * Function return list of Colors in json format.
     * 
     * @return json
     */
    public function list()
    {
        $colors = Color::
            // ->active()
            // ->inactive()
            orderBy('name')
            ->limit(50)
            ->get();

        return JsonResource::make(['colors' => ColorResource::collection($colors)])->withSuccess(__('List of color are sent!'));
    }

    /**
     * Function create new color.
     * 
     * @return mixed
     */
    public function create(ColorRequest $request)
    {
        $data = $request->validated();

        $newColor = Color::WcreateNewEntity($data);
        $newColor->handleHexValue($data['hex_value']);
        $newColor->save();

        if ($request->wantsJson()) {
            return JsonResource::make(['color' => new ColorResource($newColor)])->withSuccess(__('New color has been saved!'));
        }
        return redirect()::route('handle_route');
    }

    /**
     * Function get one color by id.
     * 
     * @param int $id
     */
    public function getColorById(Request $request, $id)
    {
        $color = Color::firstWhere('id', $id);

        if (!$color) {
            return JsonResource::make([])->withError(__('Color does not exist!'));
        }
        return JsonResource::make(['color' => new ColorResource($color)])->withSuccess(__('Color sent!'));
    }

    /**
     * Function change one color.
     * 
     * @param Color $color
     * @return mixed
     */
    public function edit(ColorRequest $request, Color $color)
    {
        $data = $request->validated();

        $color->edit($data);

        if ($request->wantsJson()) {
            return JsonResource::make()->withSuccess(__('Color has been changed!'));
        }
        return redirect()::route('handle_route');
    }

    /**
     * Function change one color.
     * 
     * @param Color $color
     * @return mixed
     */
    public function delete(Request $request, Color $color)
    {
        $color->delete();

        if ($request->wantsJson()) {
            return JsonResource::make()->withSuccess(__('Color has been deleted!'));
        }
        return redirect()::route('handle_route');
    }

    /**
     * Function change color status.
     * 
     * @param Color $color
     * @return mixed
     */
    public function changeStatus(Request $request, Color $color)
    {
        $color->changeStatus();

        if ($request->wantsJson()) {
            return JsonResource::make(['color' => new ColorResource($color)])->withSuccess(__('Color status has been changed!'));
        }
        return redirect()::route('handle_route');
    }
}
