<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class SinhvienController extends Controller
{
    public function index(Request $request)
    {
        $code = $request->code;
        $name = $request->name;
        $sex = $request->sex;
        $students = new Student();
        if (isset($code)) {
            $students = $students->where('Student', '=', $code)->get();
        } elseif (isset($name)) {
            $students = $students->where('Name', '=', $name)->get();
        } elseif (isset($sex)) {
            $students = $students->where('Gender', '=', $sex)->get();
        } else {
            $students = $students->get();
        }
        return view('products.index', [
            'students' => $students,

        ]);
    }
    public function login()
    {
        return view('products.login');
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'student' => 'required|numeric',
            'name' => 'required',
            'date' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'age' => 'required|numeric',
        ]);
        $newProduct = Student::create([
            'Student' => $request->student,
            'Name' => $request->name,
            'Date' => $request->date,
            'Gender' => $request->gender,
            'Address' => $request->address,
            'Phone' => $request->phone,
            'Age' => $request->age,
        ]);
        return redirect(route('student.index'));
    }

    public function edit(Student $student)
    {
        return view('products.edit', ['student' => $student]);
    }

    public function update(Student $student, Request $request)
    {

        $request->validate([
            'student' => 'required|numeric',
            'name' => 'required',
            'date' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'age' => 'required|numeric'
        ]);

        $student->update([
            'Student' => $request->student,
            'Name' => $request->name,
            'Date' => $request->date,
            'Gender' => $request->gender,
            'Address' => $request->address,
            'Phone' => $request->phone,
            'Age' => $request->age,
        ]);

        return redirect()->route('student.index');
    }

    public function delete(Student $student)
    {
        $student->delete();
        return redirect()->route('student.index');
    }
}
