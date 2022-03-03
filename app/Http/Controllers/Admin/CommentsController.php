<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller {

    public function index() {
        return view('admin.comments.index');
    }

    public function datatable(Request $request) {

        $searchFilters = $request->validate([
            'measurement_id' => ['nullable', 'numeric', 'exists:measurements,id'],
            'index' => ['nullable', 'numeric', 'in:0,1']
        ]);

        $query = Comment::query()
                ->with(['measurement'])
                ->join('measurements', 'comments.measurement_id', '=', 'measurements.id')
                ->select(['comments.*', 'measurements.title AS measurement_title']);

        $dataTable = \DataTables::of($query);
        $dataTable->addColumn('actions', function ($comment) {
            return view('admin.comments.partials.actions', ['comment' => $comment]);
        })->editColumn('name', function ($comment) {
            return '<strong>' . $comment->name . '</strong>';
        })->editColumn('index', function ($comment) {
            return view('admin.comments.partials.status', ['comment' => $comment]);
        })->editColumn('created_at', function ($comment) {
            return $comment->datePresenter();
        })->editColumn('measurement_title', function ($comment) {
            return view('admin.comments.partials.measurement_title', ['comment' => $comment]);
        })->editColumn('content', function ($comment) {
            return view('admin.comments.partials.content', ['comment' => $comment]);
        });

        $dataTable->rawColumns(['name', 'actions']);

        $dataTable->filter(function ($query) use ($request, $searchFilters) {
            if (
                    $request->has('search') &&
                    is_array($request->get('search')) &&
                    isset($request->get('search')['value'])
            ) {
                $searchTerm = $request->get('search')['value'];

                $query->where(function ($query) use ($searchTerm) {
                    $query->orWhere('comments.name', 'LIKE', '%' . $searchTerm . '%')
                            ->orWhere('comments.email', 'LIKE', '%' . $searchTerm . '%')
                            ->orWhere('comments.content', 'LIKE', '%' . $searchTerm . '%');
                });
            }
            if (isset($searchFilters['measurement_id'])) {
                $query->where('comments.measurement_id', 'LIKE', '%' . $searchFilters['measurement_id'] . '%');
            }
            if (isset($searchFilters['index'])) {
                $query->where('comments.index', 'LIKE', '%' . $searchFilters['index'] . '%');
            }
        });
        return $dataTable->make(true);
    }

    public function disable(Request $request) {
        $formData = $request->validate([
            'id' => ['required', 'numeric', 'exists:comments,id'],
        ]);
        $comment = Comment::findOrFail($formData['id']);
        $comment->index = 0;
        $comment->save();

        return response()->json([
                    'system_message' => __('Comment has been disabled')
        ]);
    }

    public function enable(Request $request) {
        $formData = $request->validate([
            'id' => ['required', 'numeric', 'exists:comments,id'],
        ]);
        $comment = Comment::findOrFail($formData['id']);
        $comment->index = 1;
        $comment->save();

        return response()->json([
                    'system_message' => __('Comment has been enabled')
        ]);
    }

}
