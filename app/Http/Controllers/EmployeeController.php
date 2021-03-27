<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\Designation;
use App\Models\Employee;
use Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('employees.add')->with('countries', $countries);
    }

    public function getStateList(Request $request)
    {
        $states = State::where("country_id", $request->country_id)
            ->pluck("name", "id");
        return response()->json($states);
    }

    public function getDesignationList(Request $request)
    {
        $designations = Designation::where("state_id", $request->state_id)
            ->pluck("name", "id");
        return response()->json($designations);
    }

    public function create(Request $request)
    {

        $employee = $request->validate([
            'name' => 'required|string|max:60',
            'email' => 'required|email',
            'doj' => 'required|date',
            'dob' => 'required|date|before:today',
            'age' => 'required|integer',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'designation_id' => 'required|integer',
            'department' => 'required|string',
        ]);

        unset($employee['country_id']);

        $create = Employee::create($employee);

        $success = true;

        return view('admin.dashboard')->with('success', $success);
    }

    public function report(Request $request)
    {
        $inputs = $request->validate([
            'designation_id' => 'integer',
            'sort_by' => 'string',
            'order_by' => 'string',
        ]);
        // return view('debug')->with('debug',$request->designation_id);

        $countries = Country::all();

        // $query = Employee::select('name', 'email', 'doj', 'dob', 'age', 'department', 'state_id', 'designation_id');
        $query = Employee::join('states', 'employees.state_id', '=', 'states.id')
            ->join('designations', 'employees.designation_id', '=', 'designations.id')
            ->join('countries', 'states.country_id', '=', 'countries.id')
            ->select('employees.*', 'states.name as state_name', 'designations.name as designation_name', 'countries.name as country_name');

        if (isset($request->designation_id) && $request->designation_id != "") {
            $query = $query->where('employees.designation_id', $request->designation_id);
        }

        if (isset($request->sort_by) && $request->sort_by != "") {
            $sort_by = $request->sort_by;
        } else {
            $sort_by = "asc";
        }

        if (isset($request->order_by) && $request->order_by != "") {
            $query = $query->orderBy($request->order_by, $sort_by);
        } else {
            $query = $query->orderBy('name', $sort_by);
        }

        $employees = $query->get();
        // return view('debug')->with('debug',$employees);

        return view('employees.report')->with('employees', $employees)
            ->with('countries', $countries);
    }
}
