<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class DepartmentController extends Controller
{
   public function index()
   {
        //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");

        $departments = Department::all();
        
        return view('department.departments', compact('departments'));
   }
   public function newDepartment(): View
   {
        //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");

        return view('department.add-department');
   }
   
   public function createDepartment(Request $request)
   {
        //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");
       
        $request->validate([
            'name' => 'required|string|max:50|unique:departments'
        ]);

        Department::create([            
            'name' => $request->name
        ]);

        return redirect()->route('departments');

   }

   public function editDepartment($id)
   {
     //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");

     if($this->isDepartmentBlocked($id)){
          return redirect()->route('departments');
     }
     $department = Department::findOrFail($id);

     return view('department.edit-department', compact('department'));

     
   }
   public function updateDepartment(Request $request)
   {

     //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");

     $id = $request->id;

     if($this->isDepartmentBlocked($id)){
          return redirect()->route('departments');
     }
     
     $department = Department::findOrFail($id);

     $department->update([
          'name' => $request->name
     ]);
     
     return redirect()->route('departments');

   }
   
   public function deleteDepartment($id)
   { 
     //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");
     
     if($this->isDepartmentBlocked($id)){
          return redirect()->route('departments');
     }

     $department = Department::findOrFail($id);
     // display page for comfirmation

     return view('department.delete-department-confirm', compact('department'));

   }

   public function deleteDepartmentConfirm($id)
   {
     //Auth::user()->can('admin') ?: abort(403, "Você não tem acesso a essa página!");
     
     if($this->isDepartmentBlocked($id)){
          return redirect()->route('departments');
     }
     $department = Department::findOrFail($id);

     $department->delete();

     // Altera todos os usuarios que tinham esse id
     User::where('department_id', $id)
          ->update([
               'department_id'=>null
                    ]);


     return redirect()->route('departments');

   }

   private function isDepartmentBlocked($id)
   {
     return in_array(intval($id), [1,2]);
   }
}