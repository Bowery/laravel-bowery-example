@section('main')
  <h2>Create Task</h2>

  {{ Form::model(new Task, ['route' => ['tasks.store']]) }}
  <ul>
    <li>
      {{ Form::label('description', 'Description:') }}
      {{ Form::text('description') }}
    </li>
    <li>
      {{ Form::submit('Create Task') }}
    </li>
  </ul>
  {{ Form::close() }}
@stop
