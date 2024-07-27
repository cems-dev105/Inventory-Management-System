<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeeList = Employee::all();

        return response()->json([
            'status' => 'success',
            'message' => 'All employee list..',
            'data' => $employeeList,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([

            'name' => 'required|max:50',
            'email' => 'required',
            'phone' => 'required|min:11',
            'address' => 'required',
            'salary' => 'required'
        ]);

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->salary = $request->salary;
        $employee->nid = $request->nid;
        $employee->joining_date = $request->joining_date;
        $employee->save();

        return response()->json([
            'status' => 'success',
            'message' => 'New Employee Create Successfully!',
            'data' => $employee,
        ], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employeeEdit = Employee::find($id);

        if ($employeeEdit)
        {

            return response()->json([
                'status' => 'success',
                'message' => 'Employee found!',
                'data' => $employeeEdit
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee not found!',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employeeUpdate = Employee::find($id);

        if($employeeUpdate)
        {

            $employeeUpdate->update($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Employee Updated!',
                'data' => $employeeUpdate
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee not found!',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employeeDelete = Employee::find($id);

        if ($employeeDelete)
        {
            $employeeDelete->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Employee deleted successfully!',
                'data' => $employeeDelete
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee not found!',
            ], 404);
        }
    }
}
