<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->paginate(10);
        return Inertia::render('Employees/Index', [
            'employees' => $employees,
        ]);
    }

    public function create()
    {
        return Inertia::render('Employees/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|string|max:50',
            'position' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'hired_at' => 'nullable|date',
        ]);

        Employee::create($data);

        return redirect()->route('employees.index')->with('success', 'Employee created');
    }

    public function edit(Employee $employee)
    {
        return Inertia::render('Employees/Edit', ['employee' => $employee]);
    }

    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'nullable|string|max:50',
            'position' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'hired_at' => 'nullable|date',
        ]);

        $employee->update($data);

        return redirect()->route('employees.index')->with('success', 'Employee updated');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted');
    }
}
