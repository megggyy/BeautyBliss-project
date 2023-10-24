<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use App\Imports\ColorImport;
use Maatwebsite\Excel\Facades\Excel;

class ColorController extends Controller
{
    public function index()
    {
        //$colors = Color::all();
        $colors = Color::withTrashed()->get();
        //$colors = Color::withTrashed()->paginate(10);
        return view('admin.colors.index',compact('colors'));
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(ColorFormRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['status']= $request->status == true ? '1':'0';
        Color::create($validatedData);

        return redirect('admin/colors')->with('message','Color Added Successfully');
    }

    public function edit(Color $color)
    {
       return view('admin.colors.edit',compact('color'));
    }

    public function update(ColorFormRequest $request, $color_id)
    {
        $validatedData = $request->validated();
        $validatedData['status']= $request->status == true ? '1':'0';
        Color::find($color_id)->update($validatedData);

        return redirect('admin/colors')->with('message','Color Updated Successfully');
    }

    public function destroy($color_id)
    {
        $color = Color::find($color_id);
        $color->delete();
        return redirect('admin/colors')->with('message','Color Deleted Successfully');
    }

    public function restore($color_id)
    {
        $color = Color::withTrashed()->findOrFail($color_id);
        $color->restore();
        
        return redirect('admin/colors')->with('message', 'Color Restored Successfully'); 
    }

    public function import(Request $request)
    {
        if ($request->hasFile('excel_file')) {
            try {
                Excel::import(new ColorImport, $request->file('excel_file'));

                return redirect('admin/colors')->with('message', 'Excel file imported successfully.');
            } catch (\Exception $e) {
                return redirect('admin/colors')->with('message', 'Error importing Excel file: ' . $e->getMessage());
            }
        }

        return redirect('admin/colors')->with('message', 'No Excel file selected.');
    }
   
}

