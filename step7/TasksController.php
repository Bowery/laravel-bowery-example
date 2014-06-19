<?php
 
class TasksController extends \BaseController {
 
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tasks = Task::all();
		$this->layout->content = View::make('tasks.index', compact('tasks'));
	}
 
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content = View::make('tasks.create');
	}
 
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		Task::create($input);
		return Redirect::route('home');
	}
 
	/**
	 * Display the specified resource.
	 *
	 * @param  Task $task
	 * @return Response
	 */
	public function show(Task $task)
	{
		//
	}
 
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  Task $task
	 * @return Response
	 */
	public function edit(Task $task)
	{
		$this->layout->content = View::make('tasks.edit', compact('task'));
	}
 
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Task $task
	 * @return Response
	 */
	public function update(Task $task)
	{
		$input = array_except(Input::all(), '_method');
		$input["completed"] = Input::get("completed", "0");

		$task->update($input);
		return Redirect::route('home');
	}
 
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Task $task
	 * @return Response
	 */
	public function destroy(Task $task)
	{
		$task->delete();
		return Redirect::route('home');
	}
 
}