<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Models\AdminUser;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class AdminUserController extends Controller
{
    public function login(Request $request)
    {
        $validater = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        $mathchTese = [
            'name' => $request->name,
            'password' => $request->password
        ];
        $result = AdminUser::where($mathchTese)
            ->get();
        $jsonResult = json_decode($result);
        if(count($result) == 1) {
            Session::put('name', $jsonResult[0]->name);
        }
        return redirect()->route('admin');
    }
    public function logout() {
        Session::forget('name');
        // dd(Session::get('email'));
        // exit;
        // return response().json(['logout', 'success']);

        return redirect()->to('/admin');

    }


    public function exportUsers() {
        $admin = Session::get("name");
        if ($admin && AdminUser::where("name", $admin)->exists()){
            $date = date("YWdHis");
            return Excel::download(new UsersExport, "fantasy-users$date.xlsx");
        }
        else {
            return redirect()->to("/");
        }
    }
}
