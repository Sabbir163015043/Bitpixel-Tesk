<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\FileUpload;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $data = [
            'customers' => Customer::get()
        ];

        return view('customer.index')->with($data);
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:customers,email',
            'phone' => 'required|unique:customers,phone',
            'gender' => 'required',
            'photo' => 'mimes:jpg,png,gif,jpeg'
        ]);

        $customer = new Customer();
        $customer->name = $request->get('name');
        $customer->email = $request->get('email');
        $customer->phone = $request->get('phone');
        $customer->gender = $request->get('gender');
        $customer->is_active = $request->get('status') ? 1 : 0;

        //file upload
        if ($request->hasFile('photo')) {
            $customer->photo = FileUpload::upload($request, 'photo', 'customers');
        }

        if ($customer->save()) {
            return redirect()->route('customer.list');
        }

        return 'customer failed to add';
    }

    public function edit($id)
    {
        $data = [
            'customer' => Customer::find($id)
        ];

        return view('customer.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:customers,email,'.$id,
            'phone' => 'required|unique:customers,phone,'.$id,
            'gender' => 'required',
            'photo' => 'mimes:jpg,png,gif,jpeg'
        ]);

        $customer = Customer::find($id);
        $customer->name = $request->get('name');
        $customer->email = $request->get('email');
        $customer->phone = $request->get('phone');
        $customer->gender = $request->get('gender');
        $customer->is_active = $request->get('status') ? 1 : 0;

        //file upload
        if ($request->hasFile('photo')) {
            $old_photo = $customer->photo;            
            $customer->photo = FileUpload::upload($request, 'photo', 'customers');
            
            if($old_photo) {
                unlink($old_photo);
            }
        }

        if ($customer->save()) {
            return redirect()->route('customer.list');
        }

        return 'customer failed to update';
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);

        if ($customer->delete()) {
            return redirect()->route('customer.list');
        }
    }

}
