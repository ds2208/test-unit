<?php

namespace App\Http\Controllers\API;

use App\Models\Color;
use App\Http\Controllers\Controller;

use App\Http\Resources\Api\ColorResource;
use App\Http\Resources\Json as JsonResource;

use App\Http\Requests\ColorRequest;
use Illuminate\Http\Request;


class ColorsController extends Controller
{
    
    /**
     * Function return list of colors in json format.
     * 
     * @return JsonResource
     */
    public function list()
    {
        try {
            $colors = Color::query()->orderBy('name')->limit(50)->get();
        } catch (\Throwable $th) {
            logger('Color list error: ' . $th->getMessage());
            return JsonResource::make([])->withError(__('Error!'));
        }
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
        try {
            $newColor = Color::createNewEntity($data);
            $newColor->handleHexValue($data['hex_value']);
            $newColor->save();
        } catch (\Throwable $th) {
            logger('Create color error: ' . $th->getMessage());
            return JsonResource::make([])->withError(__('Error!'));
        }


        if ($request->wantsJson()) {
            return JsonResource::make(['color' => new ColorResource($newColor)])->withSuccess(__('New color has been saved!'));
        }
        return abort(500, __('Server error'));
    }

    /**
     * Function get one color by id.
     * 
     * @param int $id
     */
    public function getColorById(Request $request, int $id)
    {
        try {
            $color = Color::firstWhere('id', $id);
        } catch (\Throwable $th) {
            logger('Get color by id error: ' . $th->getMessage());
            return JsonResource::make([])->withError(__('Error!'));
        }
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
        try {
            $color->edit($data);
        } catch (\Throwable $th) {
            logger('Edit color error: ' . $th->getMessage());
            return JsonResource::make([])->withError(__('Error!'));
        }
        if ($request->wantsJson()) {
            return JsonResource::make()->withSuccess(__('Color has been changed!'));
        }
        return abort(500, __('Server error'));
    }

    /**
     * Function change one color.
     * 
     * @param Color $color
     * @return mixed
     */
    public function delete(Request $request, Color $color)
    {
        try {
            $color->delete();
        } catch (\Throwable $th) {
            logger('Delete color error: ' . $th->getMessage());
            return JsonResource::make([])->withError(__('Error!'));
        }
        if ($request->wantsJson()) {
            return JsonResource::make()->withSuccess(__('Color has been deleted!'));
        }
        return abort(500, __('Server error'));
    }

    /**
     * Function change color status.
     * 
     * @param Color $color
     * @return mixed
     */
    public function changeStatus(Request $request, Color $color)
    {
        try {
            $color->changeStatus();
        } catch (\Throwable $th) {
            logger('Change color status error: ' . $th->getMessage());
            return JsonResource::make([])->withError(__('Error!'));
        }
        if ($request->wantsJson()) {
            return JsonResource::make(['color' => new ColorResource($color)])->withSuccess(__('Color status has been changed!'));
        }
        return abort(500, __('Server error'));
    }
}
