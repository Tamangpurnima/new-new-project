<?php

namespace App\Http\Controllers;

use App\Models\CourseDetail;
use Illuminate\Http\Request;

    class CourseDetailController extends Controller
    {

    public function index()
        {
            return view('coursedetail.create');
        }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id' => 'required',
            'college_id' => 'required',
            'description' => 'required'
        ]);

        $data['course_id'] = $request->input('course_id');
        $data['college_id'] = $request->input('college_id');
        $data['description'] = $request->input('description');

        // If you have a model, you can use it to create a new record
        CourseDetail::create($data);
    
        
        return view('home.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseDetail  $courseDetail
     * @return \Illuminate\Http\Response
     */
    public function show(CourseDetail $courseDetail)
    {
        $courseDetails=CourseDetail::all();
        return view('home.coursedetailshow',['courseDetails'=>$courseDetails]);
    }

    public function showForCollege(CourseDetail $courseDetail)
    {
        $courseDetails=CourseDetail::all();
        return view('college.coursedetailshow',['courseDetails'=>$courseDetails]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseDetail  $courseDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $courseDetail=CourseDetail::find($id);
        return view('home.coursedetailedit', ['courseDetail'=>$courseDetail]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseDetail  $courseDetail
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, CourseDetail $courseDetail, $id)
    // {
    //     {
    //         $courseDetail=CourseDetail::find($id);
    //         $courseDetail->id=$id;
    //         $courseDetail->description=$request->get('description');
    //         $courseDetail->college_id=$request->get('college_id');
    //         $courseDetail->course_id=$request->get('course_id');
        
    
    //         $courseDetail->save();
    
    //         return redirect('coursedetail/show');
    //     }
    // }

    public function update(Request $request, $id)
{
    // Validate and update the course details here
    // Example:
    $courseDetail = CourseDetail::find($id);

    // Update the fields based on your form input
    $courseDetail->description = $request->input('description');

    // Save the updated course detail
    $courseDetail->save();

    // Redirect to a success page or back to the edit page with a success message

   return redirect()->route('coursedetail.show');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseDetail  $courseDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseDetail $courseDetail, $id)
    {
        $courseDetail=CourseDetail::find($id);
        $courseDetail->delete();
        return redirect('coursedetail/show');
    }
    public function getById($id)
    {
        $courseDetail = CourseDetail::find($id);
        return view('home.viewdes', compact('courseDetail'));
    }
    

}
