<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;

class AboutController extends Controller
{
    public function AboutPage()
    {
        $aboutPage = About::find(1);
        return view('admin.aboutpage.aboutPageAll', compact('aboutPage'));
    } //end method

    public function UpdateAbout(Request $request)
    {
        $aboutId = $request->id;
        //request de image
        if ($request->file('about_image')) {
            // put inside of a variable
            $image = $request->file('about_image');
            // generate a unique name hexadecimal
            $nameGenerate = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension('about_image'); // 3232323.jpg
            // resize using intervation.io
            Image::make($image)->resize(503, 605)->save('upload/homeSlider/' . $nameGenerate);
            //save in the folder
            $saveURL = 'upload/aboutPage/' . $nameGenerate;
            //update into the database
            About::findOrfail($aboutId)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $saveURL
            ]);
            // makes apear a notification
            $notification = array(
                'message' => 'About Page Updated with Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            About::findOrfail($aboutId)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
            ]);
            // makes apear a notification
            $notification = array(
                'message' => 'About Page Updated without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    } // end method

    public function HomeAbout()
    {
        $about = About::find(1);
        return view('frontend.aboutPage.aboutPage', compact('about'));
    }
}
