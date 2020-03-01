@extends('task.menu')
@section('menu_content')
<form method="POST" action="{{ route('task_statuses.update', $taskStatus) }}">
@method('PUT')
@csrf

<div class="form-group row">
    

    <div class="col-md-4">
        <input id="name" type="text" class="form-control" name="name" value="{{ $taskStatus->name }}" required autocomplete="name" autofocus>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<button type="submit" class="btn btn-primary mt-2">
    {{ __('Save') }}
</button>
<a class="btn btn-primary mt-2" href="{{ route('task_statuses.destroy', $taskStatus) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>    
</form>

@endsection