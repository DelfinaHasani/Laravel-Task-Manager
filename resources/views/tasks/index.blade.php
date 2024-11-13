@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista e Detyrave</h1>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Krijo Detyrë të Re</a>

    <!-- Forma e search-it per filtrimin e detyrave -->
    <form action="{{ route('tasks.index') }}" method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-3">
            <select name="status" class="form-control">
                <option value="">Filtroni sipas Statusit</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>E përfunduar</option>
                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>E papërfunduar</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="priority" class="form-control">
                <option value="">Filtroni sipas Prioritetit</option>
                <option value="1" {{ request('priority') == '1' ? 'selected' : '' }}>I lartë</option>
                <option value="2" {{ request('priority') == '2' ? 'selected' : '' }}>Mesatar</option>
                <option value="3" {{ request('priority') == '3' ? 'selected' : '' }}>I ulët</option>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-success">Filtro</button>
        </div>
        <div class="col-md-3">
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Pastro Filtrimin</a>
        </div>
    </div>
</form>


    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Titulli</th>
                <th>Përshkrimi</th>
                <th>Statusi</th>
                <th>Prioriteti</th>
                <th>Veprime</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->status ? 'E përfunduar' : 'E papërfunduar' }}</td>
                    <td>
                        @if($task->priority == 1) I lartë
                        @elseif($task->priority == 2) Mesatar
                        @else I ulët
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Ndrysho</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('A jeni i sigurt?')">Fshi</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
