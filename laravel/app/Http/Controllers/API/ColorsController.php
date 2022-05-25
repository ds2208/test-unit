<?php

namespace App\Http\Controllers\API;

use App\Models\Color;
use App\Http\Requests\ColorRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ColorResource;
use App\Http\Resources\Json as JsonResource;
use App\Lib\MailHandler;
use App\Mail\ColorMail;
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
        try {
            $colors = Color::/*active()->inactive()*/orderBy('name')->limit(50)->get();
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
            // $mail = new MailHandler('danilo.strahinovic@gmail.com');
            // $mail->sendMail(ColorMail::class);
        } catch (\Throwable $th) {
            logger('Create color error: ' . $th->getMessage());
            return JsonResource::make([])->withError(__('Error!'));
        }


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
        try {
            $color->delete();
        } catch (\Throwable $th) {
            logger('Delete color error: ' . $th->getMessage());
            return JsonResource::make([])->withError(__('Error!'));
        }

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
        try {
            $color->changeStatus();
        } catch (\Throwable $th) {
            logger('Change color status error: ' . $th->getMessage());
            return JsonResource::make([])->withError(__('Error!'));
        }

        if ($request->wantsJson()) {
            return JsonResource::make(['color' => new ColorResource($color)])->withSuccess(__('Color status has been changed!'));
        }
        return redirect()::route('handle_route');
    }
}
