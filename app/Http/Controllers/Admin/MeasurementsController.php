<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Measurement;
use App\Models\User;
use Illuminate\Validation\Rule;

class MeasurementsController extends Controller
{

    public function index(Request $request)
    {

        $measurements = Measurement::query()
            ->orderBy('priority')
            ->get();

        return view('admin.measurements.index', [
            'measurements' => $measurements,
        ]);
    }

    public function add(Request $request)
    {
        $authors = User::query()->orderBy('name')->get();
        return view('admin.measurements.add', [
            'authors' => $authors
    ]);
    }

    public function insert(Request $request)
    {

        $formData = $request->validate([
            'title' => ['required', 'string'],
            'top_left_sensor' => ['required', 'numeric'],
            'top_right_sensor' => ['required', 'numeric'],
            'sensor_thrird' => ['required', 'numeric'],
            'bottom_right_sensor' => ['required', 'numeric'],
            'vertical_engine' => ['required', 'numeric'],
            'horizontal_engine' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'status' => ['required']
        ]);

        $measurementWithHighestPriority = Measurement::query()
            ->orderBy('priority', 'desc')
            ->first();

        $newMeasurement = new Measurement();

        if ($measurementWithHighestPriority) {
            $newMeasurement->priority = $measurementWithHighestPriority->priority + 1;
        } else {
            $newMeasurement->priority = 1;
        }

        $newMeasurement->fill($formData)->save();

        session()->flash('system_message', 'Measurement has been added!');
        return redirect()->route('admin.measurements.index');
    }

    public function edit(Measurement $measurement)
    {
        $authors = User::query()->orderBy('name')->get();
        return view('admin.measurements.edit', [
            'measurement' => $measurement,
            'authors' => $authors
        ]);
    }

    public function update(Request $request, Measurement $measurement)
    {

        $formData = $request->validate([
            'title' => ['required', 'string', 'max:50', Rule::unique("measurements")->ignore($measurement->id)],
            'top_left_sensor' => ['required', 'numeric'],
            'top_right_sensor' => ['required', 'numeric'],
            'sensor_thrird' => ['required', 'numeric'],
            'bottom_right_sensor' => ['required', 'numeric'],
            'vertical_engine' => ['required', 'numeric'],
            'horizontal_engine' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'status' => ['required']
        ]);

        $measurement->fill($formData)->save();

        session()->flash('system_message', 'Measurement has been edited!');
        return redirect()->route('admin.measurements.index');
    }

    public function delete(Request $request)
    {

        $formData = $request->validate([
            'id' => ['required', 'numeric', 'exists:measurements,id']
        ]);

        $measurement = Measurement::findOrFail($formData['id']);
        $measurement->delete();

        Measurement::query()
            ->where('priority', '>', $measurement->priority)
            ->decrement('priority');

        session()->flash('system_message', 'Measurement has been deleted!');
        return redirect()->route('admin.measurements.index');
    }

    public function changePriorities(Request $request)
    {
        $formData = $request->validate([
            'priorities' => ['required', 'string']
        ]);

        $priorities = explode(',', $formData['priorities']); //change string to array

        foreach ($priorities as $key => $id) {
            $measurement = Measurement::findOrFail($id);
            $measurement->priority = $key + 1;
            $measurement->save();
        }

        session()->flash('system_message', 'Measurements have been ordered!');
        return redirect()->route('admin.measurements.index');
    }


    public function changeStatus(Request $request)
    {

        $formData = $request->validate([
            'id' => ['required', 'numeric', 'exists:measurements,id']
        ]);

        $measurement = Measurement::findOrFail($formData['id']);
        $measurement->changeStatus()->save();

        session()->flash(
            'system_message',
            __('Featured of :measurement has been changed!', ['measurement' => $measurement->title])
        );
        return redirect()->route('admin.measurements.index');
    }
}
