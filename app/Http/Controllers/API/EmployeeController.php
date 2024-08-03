<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'salary' => 'required',
            'nid' => 'required|string|max:20',
            'joining_date' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $employee = new Employee();
            $employee->name = $validated['name'];
            $employee->email = $validated['email'];
            $employee->phone = $validated['phone'];
            $employee->address = $validated['address'];
            $employee->salary = $validated['salary'];
            $employee->nid = $validated['nid'];
            $employee->joining_date = $validated['joining_date'];

            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('public/photos');
                $employee->photo = Storage::url($path);
            }

            $employee->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Employee created successfully!',
                'data' => $employee
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create employee',
                'error' => $e->getMessage()
            ], 500);
        }
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

            if($employeeDelete->photo)
            {
                $photoPath = str_replace('/storage', 'public', $employeeDelete->photo);

                if(Storage::exists($photoPath))
                {
                    Storage::delete($photoPath);
                }
            }

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
