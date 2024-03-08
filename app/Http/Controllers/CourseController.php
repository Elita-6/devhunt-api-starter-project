<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response(Course::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $gen = new GenUuid();

            $file = $request->file("file");
            $data = $request->only([
                "courseName",
                "categoryId",
                "fileType",
                "courseDescription"
            ]);

            $filename = "course_".$data["courseName"].".".$file->getClientOriginalExtension();
            $path = $file->storeAs('file', $filename, 'files');

            $userId = Auth::user()->userId;
            $course = Course::create([
                "courseId" => $gen->genUuid(),
                "courseName" => $data["courseName"],
                "courseDescription" => $request->input("courseDescription"),
                "courseUrl" => $path,
                "categoryId" => $data["categoryId"],
                "fileType" => $data["fileType"],
                "userId"=>$userId
            ]);




        } catch (\Exception $th) {
            return response()->json(["errorMessage" => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(["deleted"=> true],204);
    }
}
