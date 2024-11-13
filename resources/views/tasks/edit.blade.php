@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ndrysho Detyrën</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Titulli</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Përshkrimi</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $task->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="priority" class="form-label">Prioriteti</label>
            <select class="form-control" id="priority" name="priority">
                <option value="1" {{ $task->priority == 1 ? 'selected' : '' }}>I lartë</option>
                <option value="2" {{ $task->priority == 2 ? 'selected' : '' }}>Mesatar</option>
                <option value="3" {{ $task->priority == 3 ? 'selected' : '' }}>I ulët</option>
            </select>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="status" name="status" {{ $task->status ? 'checked' : '' }}>
            <label class="form-check-label" for="status">E përfunduar</label>
        </div>
        <button type="submit" class="btn btn-primary">Ruaj Ndryshimet</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Anulo</a>
    </form>
</div>
@endsection
