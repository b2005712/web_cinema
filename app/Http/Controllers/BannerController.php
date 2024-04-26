<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\MovieGenres;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function banners()
    {
        $banners = Banner::orderBy('id', 'DESC')->Paginate(10);
        return view('admin.web.banners', ['banners' => $banners]);
    }

    public function postCreate(Request $request)
    {
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $fileName = $file->getClientOriginalName();
            $banner = new Banner(
                [
                    'image' => $fileName,
                ]
            );
        }else{
            return redirect('admin/banners')->with('warning','Vui lòng nhập hình ảnh');
        }
        $banner->save();
        return redirect('admin/banners');
    }

    public function postEdit(Request $request, $id)
    {
        $banners = Banner::find($id);

        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $fileName = $file->getClientOriginalName();
            $request['image'] = $file;
        }
        $banners->update($request->all());
        return redirect('admin/banners')->with('success', 'Updated Successfully!');
    }

    public function delete($id)
    {
        $banners = Banner::find($id);
        $banners->delete();
        return response()->json(['success' => 'Delete Successfully']);
    }
    public function status(Request $request){
        $banners = Banner::find($request->banner_id);
        $banners['status'] = $request->active;
        $banners->save();
        return response('success',200);
    }
}
