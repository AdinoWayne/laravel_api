{!! Form::open(['method' => 'POST', 'url' => 'user']) !!}
{!! Form::text('name') !!}
{!! Form::text('email') !!}
{!! Form::text('user_type_id') !!}
{!! Form::password('password') !!}
{!! Form::radio('gender', 'true') !!}
{!! Form::radio('gender', 'false') !!}
{!! Form::text('contact_number') !!}
{!! Form::date('date_of_birth') !!}
{!! Form::submit('Click Me!') !!}
{!! Form::close() !!}