<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlide;
use Intervention\Image\Facades\Image as Image;

class HomeSliderController extends Controller
{
    public function HomeSlider()
    {
        $homeSlide = HomeSlide::find(1);
        return view('admin.homeSlide.homeSlideAll', compact('homeSlide'));
    }

    public function UpdateSlider(Request $request)
    {
        $slideId = $request->id;
        //request de image
        if ($request->file('home_slide')) {
            // put inside of a variable
            $image = $request->file('home_slide');
            // generate a unique name hexadecimal
            $nameGenerate = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension('home_slide'); // 3232323.jpg
            // resize using intervation.io
            Image::make($image)->resize(636, 852)->save('upload/homeSlider/' . $nameGenerate);
            //save in the folder
            $saveURL = 'upload/homeSlider/' . $nameGenerate;
            //update into the database
            HomeSlide::findOrfail($slideId)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
                'home_slide' => $saveURL
            ]);
            // makes apear a notification
            $notification = array(
                'message' => 'Home Slide Updated with Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            HomeSlide::findOrfail($slideId)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
            ]);
            // makes apear a notification
            $notification = array(
                'message' => 'Home Slide Updated without Image Successfully',
                'alert-type' => 'success'
            );
        }
    }
}
