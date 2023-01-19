<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UserCreateFormRequest;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function users()
    {
        $users = User::all()->where('status', 1);
        return view('admin.user.index', compact('users'));
    }

    public function showuser($id)
    {
        $user = User::find($id);
        return view('admin.user.show', compact('user'));
    }

    public function adduser()
    {
        return view('admin.user.add');
    }

    public function insertuser(UserCreateFormRequest $request)
    {
        $user = new User();
        // if($request->hasFile('image'))
        // {
        //     $file = $request->file('image');
        //     $ext = $file->getClientOriginalExtension();
        //     $filename = time().'.'.$ext;
        //     $file->move('assets/uploads/user',$filename);
        //     $user->image = $filename;
        // }
        $user->role_as = $request->input('role_as');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = 'eshop'.rand(1111,9999);
        $user->phone = $request->input('phone');
        $user->address1 = $request->input('address1');
        $user->address2 = $request->input('address2');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->country = $request->input('country');
        $user->zipcode = $request->input('zipcode');
        $user->save();

        return redirect('users')->with('status', "User Added Successfully");
    }

    public function edituser($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', \compact('user'));
    }

    public function updateuser(UserFormRequest $request, $id)
    {
        $user = User::find($id);
        // if($request->hasFile('image'))
        // {
        //     $path = 'assets/uploads/category/'.$user->image;
        //     if(File::exists($path))
        //     {
        //         File::delete($path);
        //     }
        //     $file = $request->file('image');
        //     $ext = $file->getClientOriginalExtension();
        //     $filename = time().'.'.$ext;
        //     $file->move('assets/uploads/category',$filename);
        //     $user->image = $filename;
        // }
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->address1 = $request->input('address1');
        $user->address2 = $request->input('address2');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->country = $request->input('country');
        $user->zipcode = $request->input('zipcode');
        $user->update();

        if (Auth::id() == $id) {
            return redirect('show-user/'.$id)->with('status',"User Updated Successfully");
        }else{
            return redirect('users')->with('status',"User Updated Successfully");
        }

    }

    public function destroyuser($id)
    {
        $user = User::find($id);
        // if ($user->image)
        // {
        //     $path = 'assets/uploads/category/'.$user->image;
        //     if (File::exists($path))
        //     {
        //         File::delete($path);

        //     }
        // }
        $user = User::find($id);
        $user->status = 0;
        $user->email = $user->email.'-Deleted';
        $user->update();
        return redirect('users')->with('status',"User Deleted Successfully");
    }
}
