<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class HomeController extends Controller
{
    public function index()
    {
        $students = Student::all();

        return view('students', compact('students'));
    }
}
