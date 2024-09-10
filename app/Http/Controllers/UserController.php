<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\State;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class UserController extends Controller
{

    public function getStates(Country $country)
    {
        return $country->states()->select('id', 'name')->get();
    }

    public function userList(Request $request)
    {
        if ($request->ajax()) {
            $data = User::get();
            return FacadesDataTables::of($data)->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary edit_btn">Edit</a> 
                    
                    <button class="btn btn-danger delete_btn" data-id="' . $row->id . '">Delete</button>';
                    return $btn;
                })
                ->addColumn('image', function ($row) {
                    $image = '<img src="/storage/images/' . $row->image . '" width="50" height="50">';
                    return $image;
                })
                // ->addColumn('country_id', function ($row) {
                //     return @$row->countries->country;
                // })
                ->rawColumns(['action', "image"])
                ->make(true);
        }

        $country  =  Country::get();
        $state  =  State::get();
        $city  =  City::get();
        return view("userList", ['countries' => $country, 'states' => $state, 'cities' => $city]);
        
    }

    public function userStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'hobby' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'image' => 'required',
            'technology' => 'required',
        ],[
            'first_name.required'=>"First Name is required", 
            'last_name.required'=>"Last Name is required", 
            'email.required'=>"Email is required", 
            'sub_emp_id.required'=>"Sub employee is required", 
            'gender.required'=>"Gender is required", 
            'country.required'=>"country is required", 
            'state.required'=>"state is required", 
            'city.required'=>"city is required", 
            'hobby.required'=>"Hobby is required", 
            'image.required'=>"Image is required", 
            'technology.required'=>"technology is required", 
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(["error" => $errors, "status" => "0"]);
        }

        User::create([

            $photo = $request->file("image")->getClientOriginalName(),
            Storage::disk('public')->putFileAs('images', new File($request->file("image")), $photo),

            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "gender" => $request->gender,
            "hobby" =>  @implode(",", $request->hobby),
            "country_id" => $request->country,
            "state_id" => $request->state,
            "city_id" => $request->city,
            "image" => $photo,
            "technology" => @implode(",", $request->technology),
        ]);

        return response()->json(["msg" => "data insert"]);
    }

    public function userEdit(Request $request)
    {

        $user = User::find($request->id);
        $hobby = explode(",", $user->hobby);
        return response()->json(["msg" => "data edit", "user" => $user, "hobby" => $hobby]);
    }

    public function userUpdate(Request $request)
    {


        if ($request->image) {

            $photo = $request->file("image")->getClientOriginalName();
            Storage::disk('public')->putFileAs('images', new File($request->file("image")), $photo);
            User::where('id', $request->id)->update([
                "image" => $photo,
            ]);
        }

        User::where('id', $request->id)->update([

            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "gender" => $request->gender,
            "hobby" =>  @implode(",", $request->hobby),
            "country_id" => $request->country,
            "state_id" => $request->state,
            "city_id" => $request->city,
            "technology" => @implode(",", $request->technology),

        ]);
        return response()->json(["msg" => "User Update"]);
    }

    public function userDelete(Request $request)
    {
        $stud = User::find($request->id);
        if ($stud) {
            $stud->delete();
            return response()->json(["msg" => "data Delete"]);
        } else {
            return response()->json(["msg" => "Some error"]);
        }
    }
}