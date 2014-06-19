@section('main')
  <h2>Tasks</h2>
  @if ( !$tasks->count() )
    You have no tasks
  @else
    <ul>
    @foreach( $tasks as $task )
      <li>
        {{ $task->id }}: 
        @if ($task->completed)
          complete
        @else
          incomplete
        @endif
        {{ Form::open(array('class' => 'inline', 'method' => 'DELETE', 'route' => array('tasks.destroy', $task->id))) }}
          {{ link_to_route('tasks.edit', 'Edit', array($task->id), array('class' => 'btn btn-info')) }},
          {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
        {{ Form::close() }}

        <p>{{ $task->description }}</p>
      </li>
    @endforeach
    </ul>
  @endif
 
  <p>{{ link_to_route('tasks.create', 'Create Task') }}</p>
@stop
