<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        // Inicializo query per detyrat e perdoruesit te kyqur
        $query = auth()->user()->tasks();
    
        // Apliko filterin e statusit nese eshte i plotesum
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        // Apliko filter te prioritetit nese eshte i plotesum
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
    
        // Ekzekuto pyetjen dhe merr rezultatet
        $tasks = $query->get();
    
        // Kthe pamjen me detyrat e filtrume
        return view('tasks.index', compact('tasks'));
    }
    

    

public function create()
{
    return view('tasks.create');
}

public function store(Request $request)
    {
        // Validimi për krijimin e detyres se re
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);

        // Krijimi i detyres
        auth()->user()->tasks()->create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Detyra u shtua me sukses!');
    }

public function edit(Task $task)
{
    $this->authorize('update', $task);
    return view('tasks.edit', compact('task'));
}

public function update(Request $request, Task $task)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
    ]);

    // Update statusin bazuar nese kutia e kontrollit eshte e shenuar ose jo
    $task->status = $request->has('status') ? 1 : 0;

    // Update tjerat
    $task->title = $request->input('title');
    $task->description = $request->input('description');
    $task->priority = $request->input('priority');

    $task->save();

    return redirect()->route('tasks.index')->with('success', 'Detyra u përditësua me sukses!');
}



public function destroy(Task $task)
{
    $this->authorize('delete', $task);
    $task->delete();
    return redirect()->route('tasks.index')->with('success', 'Detyra u fshi me sukses!');
}


}
