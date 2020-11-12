<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
	 * List
	 *
	 * @param Request $request
	 * @return Response|array
	 */
	public function list(Request $request)
	{
		$todos = Todo::query()
			->orderBy('created_at', 'asc')
			->get();

		return response()->json(['message' => '', 'data' => $todos]);
	}

	/**
	 * Get Details
	 *
	 * @param Request $request
	 * @param $id
	 * @return Response
	 * @internal param Request $request
	 */
	public function show(Request $request, $id)
	{
		$todo = Todo::query()
			->where('id', $id)
			->first();

		// Data not found
		if (!$todo) return response()->json(['message' => __('Todo not found.')], 404);

		return response()->json(['message' => '', 'data' => $todo]);
	}

	/**
	 * Create
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function create(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
		]);

		$name = trim($request->input('name'));

		$todo = new Todo();
		$todo->name = $name;
		$todo->save();

		return response()->json(['message' => '', 'data' => $todo]);
	}

	/**
	 * Update
	 *
	 * @param Request $request
	 * @param $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$name = $request->has('name') ? trim($request->input('name')) : false;

		$todo = Todo::query()
			->where('id', $id)
			->first();

		if (!$todo) return response()->json(['message' => 'Not found', 'data' => null], 422);
		if ($name) $todo->name = $name;
		$todo->save();

		$todo = Todo::query()->where('id', $id)->first();

		return response()->json(['message' => __('Todo updated'), 'data' => $todo]);
	}

	/**
	 * Delete
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function delete(Request $request)
	{
		$this->validate($request, [
			'ids' => 'required'
		]);

		$todoIds = json_decode($request->input('ids'));

		Todo::query()->whereIn('id', $todoIds)->delete();

		return response()->json(['message' => count($todoIds) . ' ' . __('Todo has been deleted')]);
	}
}
