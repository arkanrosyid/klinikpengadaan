<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Unit;
use App\Models\User;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function index()
    {


        $users = DB::table('users')->get();
        $countUs = count($users);

        $emp = DB::table('employees')
        ->where('status','=','Active')->get();
        $countEmp = count($emp);

        $kons = DB::table('konsultasis')->get();
        $countK = count($kons);

        $konsA = DB::table('konsultasis')
            ->where('status', 'Aktif')
            ->orWhere('status', 'Baru')
            ->orWhere('status', 'Tatap Muka')
            ->get();
        $countKA = count($konsA);



        return view('admins.dashboard', [
            'user' => $countUs,
            'pegawai' => $countEmp,
            'konsul' => $countK,
            'aktif' => $countKA,
        ]);
    }

    public function users()
    {
        return view('admins.users', [
            'data' => User::all()->sortDesc(),
            'data2' => Employee::all(),
        ]);
    }


    public function account()
    {
        return view('admins.account');
    }

    public function laporan()
    {
        $all = Konsultasi::all()->sortDesc();


        return view('admins.laporan', [
            'laporan' => $all,
        ]);
    }

    public function showUnit()
    {
        return view('admins.unit', [
            'unit' => Unit::all(),
        ]);
    }

    public function addUnit(Request $request)
    {

        $this->validator($request->all())->validate();

        Unit::create(['name' => $request['unit']]);
        $request->session()->flash('success', 'Unit Kerja berhasil ditambah!');

        return redirect('admin/unit');
    }



    protected function validator(array $data)
    {

        return Validator::make($data, [
            'unit' => ['required', 'string', 'max:255'],
        ]);
    }

    public function Delete($id)
    {

        Unit::find($id)->delete();

        session()->flash('delete', 'Unit Kerja berhasil dihapus!');
        return redirect('admin/unit');
    }

    public function aktifkanPegawai($id)
    {
        $emp = Employee::find($id);
        $emp->status = "Active";
        $emp->save();

        return redirect('/admin/users');
    }

    public function suspendPegawai($id)
    {
        $emp = Employee::find($id);
        $emp->status = "Suspend";
        $emp->save();

        return back();
    }

    public function detailPegawai($id)
    {
        $user = Employee::find($id);
        return view('admins.detailUser', [
            'User' => $user,
            'title' => 'Pegawai',
        ]);
    }

    public function detailUser($id)
    {
        $user = User::find($id);

        $unit = Unit::find($user->id_unit);

        return view('admins.detailUser', [
            'User' => $user,
            'title' => 'Pengguna',
            'unit' => $unit
        ]);
    }

    public function hapusUser($id)
    {
        User::find($id)->delete();
        return back()->with('delete', 'User berhasil dihapus');
    }

    public function resetLaporan($id)
    {
        $konsul = Konsultasi::find($id);
        $konsul->id_employee = NULL;
        $konsul->unit_employee = NULL;
        $konsul->jabatan_employee = NULL;
        $konsul->status = "Baru";
        $konsul->save();

        return back()->with('reset', 'Laporan berhasil direset');
    }

    public function detailLaporan($id)
    {

        $konsul = Konsultasi::find($id);
        $user = User::find($konsul->id_user);
        $emp = Employee::find($konsul->id_employee);
        return view('admins.detailLaporan', [
            'Konsul' => $konsul,
            'User' => $user,
            'Pegawai' => $emp,
            'Posts' => Post::where('id_konsul', $id)->get(),
        ]);
    }

    public function editProfil()
    {
        $id = Auth::guard('admin')->user()->id;
        $data = Admin::find($id);
        return view('admins.editProfil', ['Data' => $data]);
    }

    public function saveProfil(Request $request)
    {

        $this->validateProfil($request->all())->validate();

        $cek = Admin::find($request->id);

        $password = $request->password;
        $password2 = $cek->password;

        if (Hash::check($password, $password2)) {
            $cek->name = $request->nama;
            $cek->email = $request->email;
            $cek->save();

            return redirect('/admin/account')->with('success', 'Data berhasil diubah');
        } else {
            return back()->with('gagal', 'Password tidak sesuai!');
        }
    }

    public function validateProfil(array $data)
    {

        return Validator::make($data, [

            'email' => 'required|email',
            'nama' => 'required|max:200',
            'password' => 'required',


        ]);
    }
    public function validatePegawai(array $data)
    {

        return Validator::make($data, [

            'email' => 'required|email|unique:employees,email',
            'nama' => 'required|max:200',
            'jabatan' => 'required|max:200',
            'nip' => 'required|unique:employees,nip',
            'phone' => 'required|unique:employees,phone',


        ]);
    }


    public function tambahPegawai(Request $request)
    {
        $this->validatePegawai($request->all())->validate();

        $ran = uniqid();
        $varray = str_split($ran);
        $len = sizeof($varray);
        $otp = array_slice($varray, $len - 8, $len);
        $otp = implode(",", $otp);
        $otp = str_replace(',', '', $otp);

        $password = bcrypt($otp);
        Employee::create([
<<<<<<< Updated upstream
            'name' => $request->nama,
            'nip' => $request->nip,
            'email' => $request->email,
            'password' => $password,
            'jabatan' => $request->jabatan,
            'phone' => $request->phone,
        ]);

        return redirect('/admin/users')->with('success', 'Akun berhasil dibuat password sementara adalah ' . $otp);
=======
                    'name' => $request->nama,
                    'nip' => $request->nip,
                    'email' => $request->email,
                    'password' => $password,
        ]);

        return redirect('/admin/users')->with('success','Akun berhasil dibuat password sementara adalah '. $otp);
>>>>>>> Stashed changes
    }
}
