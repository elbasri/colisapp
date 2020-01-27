<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\User;
use Intervention\Image\Facades\Image;

class DriverController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        return view('manager.driver.add');
        
        $searchtext = $request->search;
        if (!empty($searchtext)) {
            $driverList = User::where([['type', 'Driver'], ['branch_id', Auth::user()->branch_id]])
                    ->where(function($q) use($searchtext) {
                        $q->orWhere('name', 'LIKE', "%$searchtext%")
                        ->orWhere('email', 'LIKE', "%$searchtext%")
                        ->orWhere('phone', 'LIKE', "%$searchtext%");
                    })
                    ->paginate(20);
        } else {
            $driverList = User::where([['type', 'Driver'], ['branch_id', Auth::user()->branch_id]])->paginate(20);
        }

        return view('manager.driver.list', compact('List'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('manager.driver.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $driver) {
        $request->validate([
            'password' => 'required|min:4',
            'name' => 'required|max:50|unique:users',
            'email' => 'required|max:50|email|unique:users',
            'phone' => 'max:50',
            'image' => 'image|mimes:jpeg,png,jpg|max:5120',
        ]);
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageObj = Image::make($image);
            $imageObj->save('assets/driver/img/driver/' . $image->hashname());
            $data['image'] = $image->hashname();
        }

        if ($request->get('status')) {
            $data['status'] = "Active";
        } else {
            $data += ["status" => "Inactive"];
        }
        //password hash make
        $data['password'] = Hash::make($request->get('password'));

        $driver->create($data);

        return back()->withSuccess('Branch driver created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(User $driver) {
        return view('manager.driver.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $driver) {

        $request->validate([
            'name' => ['required',
                Rule::unique('users')->ignore($driver->id), 'max:50'
            ],
            'email' => ['required',
                Rule::unique('users')->ignore($driver->id), 'email', 'max:50'
            ],
            'phone' => 'max:50',
            'image' => 'image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $data = $request->all();
        if ($request->get('status')) {
            $data['status'] = "Active";
        } else {
            $data += ["status" => "Inactive"];
        }
        if ($request->hasFile('image')) {
            if ($driver->image) {
                unlink('assets/driver/img/driver/' . $driver->image);
            }
            $image = $request->image;
            $imageObj = Image::make($image);
            $imageObj->save('assets/driver/img/driver/' . $image->hashname());
            $data['image'] = $image->hashname();
        }
        $driver->update($data);

        return back()->withSuccess('Branch driver updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy($branchmanager) {
        
    }

    public function changePassword(Request $request) {
        $niceName = [
            'newword' => 'New Password',
            'newword_confirmation' => 'Re-type password',
        ];
        $rules = [
            'newword' => 'required|min:4|confirmed',
            'newword_confirmation' => 'required',
        ];
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'min' => 'Password must be 4 char',
        ];
        $this->validate($request, $rules, $customMessages, $niceName);

        $id = $request->get('id');
        //bcrypt passwrod 
        $manager = User::find($id);
        $manager->password = Hash::make($request->get('newword'));
        $manager->save();
        return back()->withSuccess('Password updated successfully');
    }

}
