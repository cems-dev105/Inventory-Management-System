<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class SalaryController extends Controller
{
    public function paid(Request $request, $id)
    {
        $validated = $request->validate([
            'att_month' => 'required',
        ]);

        $month = $request->salary_month;
        $check = Salary::where('employee_id',$id)->where('salary_month',$month)->first();

        if($check)
        {
            return response()->json([
                'message' => 'Salary already paid!'
            ]);

        } else{

            try {

                $paidSalary = new Salary();
                $paidSalary->employee_id = $id;
                $paidSalary->amount = $request->amount;
                $paidSalary->salary_date = date('d/m/Y');
                $paidSalary->salary_month = $month;
                $paidSalary->salary_year = date('Y');
                $paidSalary->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Salary paid successfully!',
                    'data' => $paidSalary
                ], 201);

            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to salary paid',
                    'error' => $e->getMessage()
                ], 500);
            }
        }
    }

    public function allSalary()
    {
        $salary = Salary::select('salary_month')->groupBy('salary_month')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'All salary fetched!',
            'data' => $salary
        ], 200);
    }

    public function viewSalary($month)
    {
        $view = DB::table('salaries')
                ->join('employees','salaries.employee_id','employees.id')
                ->select('employees.name', 'salaries.*')
                ->where('salaries.salary_month', $month)
                ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'View salary!',
            'data' => $view
        ], 200);
    }

    public function editSalary($id)
    {
        $editSalary = DB::table('salaries')
                ->join('employees','salaries.employee_id','employees.id')
                ->select('employees.name', 'employees.email', 'salaries.*')
                ->where('salaries.salary_month', $id)
                ->first();

        return response()->json([
            'status' => 'success',
            'message' => 'Edit view salary!',
            'data' => $editSalary
        ], 200);
    }

    public function updateSalary(Request $request, $id)
    {
        $salaryUpdate = Salary::find($id);

        if($salaryUpdate)
        {

            $salaryUpdate->update($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Salary Updated!',
                'data' => $salaryUpdate
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee not found!',
            ], 404);
        }
    }
}
