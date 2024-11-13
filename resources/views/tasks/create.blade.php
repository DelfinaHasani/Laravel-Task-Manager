@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Krijo Detyrë të Re</h1>

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

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Titulli</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Përshkrimi</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="priority" class="form-label">Prioriteti</label>
            <select class="form-control" id="priority" name="priority">
                <option value="1">I lartë</option>
                <option value="2">Mesatar</option>
                <option value="3">I ulët</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Krijo</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Anulo</a>
    </form>
</div>
@endsection
