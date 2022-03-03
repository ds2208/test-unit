<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Measurement;
use App\Models\Comment;

class MeasurementsController extends Controller {

    public function index(Request $request) {

        $measurements = Measurement::query()
                ->where('status', 1)
                ->orderBy('created_at')
                ->get();

        return view('front.measurements.index', [
            'measurements' => $measurements
        ]);
    }

    public function single(Request $request, Measurement $measurement, string $seoSlug) {
        if($seoSlug != \Str::slug($measurement->title)){
            return redirect()->away($measurement->getFrontUrl());
        }
        
        if ($measurement->status == 0) {
            session()->put('system_error', 'You can not see this measurement!');
            return redirect()->route('front.measurements.index');
        }
        
        return view('front.measurements.single', [
            'measurement' => $measurement
        ]);
    }

    public function commentContainer(Request $request) {
        
        $formData = $request->validate([
            'measurement_id' => ['required', 'numeric', 'exists:measurements,id']
        ]);
        
        $measurement = Measurement::find($formData['measurement_id']);
        
        $comments = $measurement->comments()
                ->where('index', '=', 1)
                ->get();
        
        return view('front.measurements.partials.comments', [
            'measurement' => $measurement,
            'comments' => $comments
        ]);
    }

    public function addComment(Request $request) {
        
        $formData = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'content' => ['required', 'string', 'min:50', 'max:500'],
            'measurement_id' => ['required', 'numeric', 'exists:measurements,id']
        ]);

        $newComment = new Comment();
        $newComment->fill($formData);
        $newComment->save();

        return response()->json([
                    'systemMessage' => 'Comment has been added!',
        ]);
    }

}
