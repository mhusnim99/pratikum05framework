<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            //  SQL builder
        $pageTitle = 'Employee List';
        $employees = DB::table('employees')
                    ->select('*', 'employees.id as employee_id', 'positions.name as position_name')
                    ->leftJoin('positions','employees.position_id', '=', 'positions.id')
                    ->get();
        return view('employee.index', [
            'pageTitle' => $pageTitle,
            'employees' => $employees
        ]);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // RAW SQL builder
        $pageTitle ='Create Employee';
        $Posision = DB::select('select * from positions');
        $positions = DB::table('positions')
                    ->select('*')
                    ->get();
        return view('employee.create',compact('pageTitle','positions'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
        ];

        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // INSERT QUERY
        DB::table('employees')->insert([
            'firstname' => $request->firstName,
            'lastname' => $request->lastName,
            'email' => $request->email,
            'age' => $request->age,
            'position_id' => $request->position,
        ]);

        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // SQL builder
        $pageTitle = 'Employee Detail';
        $employees = collect(DB::select(
            'select *, employees.id as employee_id, positions.name as position_name
            from employees
            left join positions on employees.position_id = positions.id where employees.id = ?', [$id]
        ))->first();
        $employee = DB::table('employees')
                    ->select('*', 'employees.id as employee_id', 'positions.name as position_name')
                    ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
                    ->where('employees.id', '=', $id)
                    ->first();
        return view('employee.show', compact('pageTitle', 'employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // SQL builder
        $pageTitle = 'Employee Edit';
        $employee = DB::table('employees')
                    ->select('*', 'employees.id as employee_id', 'positions.name as position_name')
                    ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
                    ->where('employees.id', '=', $id)
                    ->first();
        $positions = DB::table('positions')
                    ->select('*')
                    ->get();
        return view('employee.edit', compact('pageTitle', 'employee','positions'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // RAW SQL builder
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
        ];

        $validator = Validator::make($request-> all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()-> withErrors($validator)->withInput();
        }
        DB::table('employees')-> where('id',$id)-> update([
            'firstname' => $request-> firstName,
            'lastname' => $request-> lastName,
            'email' => $request-> email,
            'age' => $request-> age,
            'position_id' => $request->position,
        ]);
        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //QUery builder
        DB::table('employees')
            ->where('id', $id)
            ->delete();
        return redirect()->route('employees.index');
    }
}
