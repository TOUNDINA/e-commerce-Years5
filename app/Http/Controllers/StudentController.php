<?php

namespace App\Http\Controllers; // "Controller" should be plural

use Illuminate\Http\Request;
use DB;

class StudentController extends Controller // "extends" should be "extends"
{
    public function displayForm() // Method names should follow camelCase convention
    {
        return view('studentform');
    }

    public function save(Request $request)
    {
        // Your save logic will go here
        $student_name = $request->input('stud_name');
        $student_number = $request->input('stud_number');
        $student_course = $request->input('stud_course');
        $student_address = $request->input('stud_address');
        
        DB::insert('insert into student (stud_name,stud_number,stud_course,stud_address) values(?,?,?,?) ',[$student_name,$student_number ,$student_course,$student_address]);

        return redirect('student')->with('success','Data saved');
    }
    public function viewform(){
        return view('studentview');
    }
    public function index(){
       $student = DB::select('select * from student');
       return view('studentview',['student'=>$student]);
    }
    public function edit_function($id){
        $student = DB::select('select * from student where id = ?', [$id]);
        return view('studentedit',['student'=>$student]);
    }
    public function update_function(Request $request, $id){
        $student_name = $request->input('stud_name');
        $student_number = $request->input('stud_number');
        $student_course = $request->input('stud_course');
        $student_address = $request->input('stud_address');
    
        DB::table('student')
            ->where('id', $id)
            ->update([
                'stud_name' => $student_name,
                'stud_number' => $student_number,
                'stud_course' => $student_course,
                'stud_address' => $student_address
            ]);
    
        return redirect('studentview')->with('success', 'Data Updated');
    }

    public function delete_function($id){
        DB::delete('delete from student where id = ?',[$id]);
        return redirect('studentview')->with('success','Data Deleted');
    }
    
}
