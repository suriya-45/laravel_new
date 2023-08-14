<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Alert;

class PropertyController extends Controller
{
   public function Allproperty(){
    $all_property = PropertyType::paginate(5);
    $title = 'Delete User!';
    $text = "Are you sure you want to delete?";
    confirmDelete($title, $text);
    return view('backend/property.allproperty',compact('all_property'));
   }
   public function Addproperty(){
    return view('backend/property.addproperty');
   }
   public function StoreProperty(Request $request){
   
    $property = PropertyType::create([
    'name'=>$request->name,
    'icon'=>$request->icon
    ]);
    toastr()->success('Property Created Successfully');
    return redirect(route('admin.allproperty'));
   }

   public function EditProperty(PropertyType $id){
    return view('backend.property.editproperty', ['property' => $id]);
   }

   public function UpdateProperty(Request $request){
    $request->validate([
     'name'=>['required',Rule::unique('property_types')->ignore($request->id)],
     'icon'=>['required']

    ]);
    $property = PropertyType::findorFail($request->id)->update([
      'name'=>$request->name,
      'icon'=>$request->icon
    ]);
    toastr()->success("Property Updated successfully");
    return redirect(route('admin.allproperty'));
   }

   public function DeleteProperty(Request $request){
     PropertyType::findOrFail($request->id)->delete();
    Alert::alert('Delete', 'Property Deleted Successfully', 'Success');
    return redirect(route('admin.allproperty'));
   }

}
