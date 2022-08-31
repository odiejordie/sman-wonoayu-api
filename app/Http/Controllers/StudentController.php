<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Models\StudentBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Excel;
use App\Exports\StudentExport;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Student::query();
        $data->when($request->search, function ($q, $search) {
            $q->where("name", "like", "%" . $search . "%");
        });

        return StudentResource::collection($data->latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $student = new Student();
            $student->receipt_number = $request->receipt_number;
            $student->student_number = $request->student_number;
            $student->name = $request->name;
            $student->class = $request->class;
            $student->borrow_date = $request->borrow_date;
            $student->return_date = $request->return_date;
            $student->borrow_status = $request->borrow_status;
            $student->save();

            foreach ($request->books_id as $value) {
                $books[] = [
                    "student_id" => $student->id,
                    "book_id" => $value["id"],
                    "receipt_number" => $student->receipt_number,
                ];
            }

            if (count($books) > 0) {
                StudentBook::insert($books);
            }

            DB::commit();

            return response()->json(
                [
                    "student_id" => $student->id,
                    "message" => "Successfully borrow books!",
                ],
                201
            );
        } catch (Throwable $e) {
            report($e);
            DB::rollBack();
            return response()->json(
                ["message" => "Something wen't wrong!"],
                500
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $student->borrow_status = 1;
        $student->save();

        return response()->json(
            ["message" => "Successfully update student!"],
            201
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }

    public function export()
    {
        return Excel::download(new StudentExport(), "students.xlsx");
    }
}
