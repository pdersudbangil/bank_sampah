<?php

namespace App\Http\Controllers;

use App\Models\Antrian\Doctor;
use App\Models\MWLWL;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }

    public function dashboard()
    {
        $data = DB::table('antrian_patientwl')
                ->join('antrian_mwlwl', 'antrian_patientwl.PATIENT_ID', '=', 'antrian_mwlwl.PATIENT_ID')
                ->leftJoin('report_ris_2024-11-09', 'report_ris_2024-11-09.ACCESSION_NO', '=', 'antrian_mwlwl.ACCESSION_NO')
                ->leftJoin('antrian_study_ris as sris', function ($join) {
                    $join->on('report_ris_2024-11-09.ACCESSION_NO', '=', 'sris.ACCESSION_NO');
                    $join->where('sris.PATIENT_LOCATION', 'Radiologi');
                })
                ->select('antrian_patientwl.PATIENT_ID','antrian_mwlwl.ACCESSION_NO','antrian_mwlwl.PATIENT_NAME', 'report_ris_2024-11-09.ID_REPORT_RIS', 'sris.ACCESSION_NO')
                // ->select('antrian_mwlwl.ACCESSION_NO', 'report_ris.ACCESSION_NO', 'antrian_study_ris.ACCESSION_NO')
                ->where('antrian_mwlwl.PATIENT_LOCATION', 'Radiologi')
                ->groupBy('antrian_patientwl.PATIENT_ID','antrian_mwlwl.ACCESSION_NO','antrian_mwlwl.PATIENT_NAME', 'report_ris_2024-11-09.ID_REPORT_RIS', 'sris.ACCESSION_NO')
                ->get();
                // dd($data);
        $doctors = Doctor::select('nama','gelar_belakang')->where('unit_ruang', 'radiologi')->limit(10)->get();
        // $data = MWLWL::select('ACCESSION_NO', 'PATIENT_NAME')->where('PATIENT_LOCATION', 'Radiologi')->get();
        return view('antrian.dashboard', compact('data','doctors'));
    }

    public function root()
    {
        return view('index');
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->file('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
            $user->avatar =  $avatarName;
        }

        $user->update();
        if ($user) {
            Session::flash('message', 'User Details Updated successfully!');
            Session::flash('alert-class', 'alert-success');
            // return response()->json([
            //     'isSuccess' => true,
            //     'Message' => "User Details Updated successfully!"
            // ], 200); // Status code here
            return redirect()->back();
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            // return response()->json([
            //     'isSuccess' => true,
            //     'Message' => "Something went wrong!"
            // ], 200); // Status code here
            return redirect()->back();

        }
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return response()->json([
                'isSuccess' => false,
                'Message' => "Your Current password does not matches with the password you provided. Please try again."
            ], 200); // Status code
        } else {
            $user = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->update();
            if ($user) {
                Session::flash('message', 'Password updated successfully!');
                Session::flash('alert-class', 'alert-success');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Password updated successfully!"
                ], 200); // Status code here
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Something went wrong!"
                ], 200); // Status code here
            }
        }
    }
}
