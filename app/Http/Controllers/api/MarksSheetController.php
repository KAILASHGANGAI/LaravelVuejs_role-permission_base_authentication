<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\exam;
use App\Models\marks;
use App\Models\students;
use App\Models\subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarksSheetController extends Controller
{
    public function index(Request $req)
    {
        $faculty = $req->faculty;
        $sem = $req->semester;

        $students = students::select('id', 'name')->where('faculty_id', $faculty)->where('semesters_id', $sem)->get();
        $subjects = subjects::where('faculty_id', $faculty)->where('semester_id', $sem)->get();

        return response()->json([
            'students' => $students, 'subjects' => $subjects,
        ]);
    }

    public function store(Request $req)
    {
        //   DD($req);
        $getmarks = $req->getmarks;
        $exist = marks::where('exam_id', $req->exam_type)->where('subject_id', $req->subject)->count();
        if ($exist > 0) {
            return response()->json([
                'status' => 'Already Exist ',
            ]);
        } else {
            foreach ($getmarks as $key => $value) {
                if ($value != null) {
                    $new = new marks();
                    $new->exam_id = $req->exam_type;
                    $new->student_id = $req->student_id[$key]['id'];
                    $new->subject_id = $req->subject;
                    $new->marks = $value;
                    $new->practical = $req->getPractical[$key];
                    $new->save();
                }
            }

            return response()->json([
                'status' => 'marks Saved Sucessfully',
            ]);
        }

    }

    public function lasers($id)
    {
        $exam = exam::with('faculty', 'semester')->where('id', $id)->first();
        $data = students::select('id', 'name')
            ->with([
                'marks' => function ($query) use ($id) {
                    $query->select('id', 'student_id', 'subject_id', 'exam_id', 'marks', 'practical')
                        ->where('exam_id', $id);
                },
                'marks.subject' => function ($query) {
                    $query->select('id', 'subjects', 'fullmarks', 'passmarks', 'practical_fullmarks', 'practical_passmarks', 'creadit_hrs');
                },
                'marks.exam' => function ($query) {
                    $query->select('id', 'exam_type');
                },
            ])
            ->whereHas('marks.exam', function ($query) use ($id, $exam) {
                $query->where('id', $id)
                    ->where('faculty_id', $exam->faculty_id)
                    ->where('semesters_id', $exam->semester_id);
            })
            ->where('faculty_id', $exam->faculty_id)
            ->where('semesters_id', $exam->semester_id)
            ->get();

        $subjects = subjects::select('subjects')->where('faculty_id', $exam->faculty_id)->where('semester_id', $exam->semester_id)->get();
        $ranks = DB::table(function ($query) use ($exam) {
            $query->select('students.id as student_id', 'students.name',
                DB::raw('SUM(marks.marks) as total_marks'),
                DB::raw('SUM(marks.practical) as total_practical'))
                ->from('students')
                ->join('marks', 'students.id', '=', 'marks.student_id')
                ->where('students.faculty_id', $exam->faculty_id)
                ->where('students.semesters_id', $exam->semester_id)
                ->groupBy('students.id', 'students.name')
                ->orderByDesc('total_marks')
                ->orderByDesc('total_practical');
        }, 'sub')
            ->select('sub.*', DB::raw('ROW_NUMBER() OVER (ORDER BY sub.total_marks DESC, sub.total_practical DESC) as rank'))
            ->get();

        return response()->json([
            'exam' => $exam,
            'data' => $data,
            'subjects' => $subjects,
            'ranks' => $ranks,
        ]);
    }
}
