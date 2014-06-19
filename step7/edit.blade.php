@section('main')
  <h2>Edit Task</h2>

  {{ Form::model($task, ['method' => 'PATCH', 'route' => ['tasks.update', $task->id]]) }}
  <ul>
    <li>
      {{ Form::label('description', 'Description:') }}
      {{ Form::text('description') }}
    </li>
    <li>
      {{ Form::label('completed', 'Completed:') }}
      {{ Form::checkbox('completed') }}
    </li>
    <li>
      {{ Form::submit('Update Task') }}
    </li>
  </ul>
  {{ Form::close() }}
@stop
