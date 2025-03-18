<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassSubjectModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;

class ClassSubjectController extends Controller
{
    public function list(Request $request)
    {
        $data['getRecord'] = ClassSubjectModel::getRecord();
        $data['header_title'] = "Assign Subject List";
        return view('admin.assign_subject.list', $data);
    }

    public function add(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getSubject();
        $data['header_title'] = "Assign Subject Add";
        return view('admin.assign_subject.add', $data);
    }

    public function insert(Request $request)
    {
        // dd($request->all());
        if(!empty($request->subject_id))
        {
            foreach ($request->subject_id as $subject_id)
            {
                $save = new ClassSubjectModel();
                $save = 
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Due to some error please try again');
        }
    }
}
