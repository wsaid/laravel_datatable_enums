<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\Datatables\Datatables;
use App\Enums\UserType;

class DatatablesController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
    	$user_types = UserType::getInstances();
        return view('datatables.index')->with('user_types', $user_types);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData(Request $request)
    {
       $users = User::select(['id', 'name', 'email', 'created_at', 'user_type', 'updated_at']);

       return Datatables::of($users)
       ->filter(function ($query) use ($request) {
           if ($request->has('user_type_id')) {
               $query->where('user_type', '=', $request->get('user_type_id'));
           }

           if ($request->has('email')) {
               $query->where('email', 'like', "%{$request->get('email')}%");
           }
       })
       ->make(true);
        // return Datatables::of(User::query())->make(true);
    }

    // public function getCustomFilterData(Request $request)
    //    {
    //        $users = User::select(['id', 'name', 'email', 'created_at', 'updated_at']);

    //        return Datatables::of($users)
    //        ->filter(function ($query) use ($request) {
    //            if ($request->has('name')) {
    //                $query->where('name', 'like', "%{$request->get('name')}%");
    //            }

    //            if ($request->has('email')) {
    //                $query->where('email', 'like', "%{$request->get('email')}%");
    //            }
    //        })
    //        ->make(true);
    //    }
}
