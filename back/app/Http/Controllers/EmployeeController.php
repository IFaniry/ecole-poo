<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function create(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'firstName' => 'required|string',
            'department' => 'required|string'
        ]);

        $employee = Employee::create([
            'name' => $fields['name'],
            'firstName' => $fields['firstName'],
            'department' => $fields['department'],
            'dateCreated' => Carbon::today()
        ]);

        // $response = [
        //     'id' => $employee->id
        // ];

        return response($employee, 201);
    }

    public function list(Request $request) {
        return Employee::all();
    }

}
