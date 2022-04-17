<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Unit;
use App\Models\User;
use App\Models\Employee;
use App\Models\TatapMuka;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class UsersController extends Controller
{
    public function index(){
        return view('users.dashboard',['unit'=>Unit::All()]);
    }

    public function konsultasi(){
        $user =  Auth::guard()->user()->id ;
        $aktif = DB::table ('konsultasis')->where(
            [
                ['id_user','=', $user],
                ['status', '=', 'Aktif',],
            
            ])
            ->orWhere([
                ['id_user','=', $user],
                ['status', '=', 'Baru',],
            
            ])
            ->orderBy('id', 'desc')
            ->get();
        $selesai = DB::table ('konsultasis')->where(
            [
                ['id_user','=', $user],
                ['status', '=', 'Selesai'],
            
            ])
            ->orderBy('id', 'desc')
            ->get();
        $tatapMuka = DB::table ('konsultasis')->where(
            [
                ['id_user','=', $user],
                ['status', '=', 'Tatap Muka'],
            
            ])->get();
        
        return view('users.konsultasi' ,[
            'konsultasi' => $aktif,
            'selesai' => $selesai,
            'tatapM' => $tatapMuka,
        ]);
    }


    public function jawabUser(){
        $user =  Auth::guard('user')->user()->name;

        return view('users.konsultasi' ,[
            'konsultasi' => Konsultasi::all()->sortDesc(),
        ]);
    }
 

    public function showById($id){
        $konsultasi = Konsultasi::find($id);
        if (empty($konsultasi)){
            return redirect('/konsultasi/user');
        }
        else{
         
            $auth = Auth::guard()->user()->id ;
        
           if ($konsultasi->id_user != $auth){
                 return redirect('/konsultasi/user');
            }

            else{

                $user = User::find($konsultasi['id_user']);
                $emp = Employee::find($konsultasi['id_employee']);
                $pesan = DB::table ('posts')->where('id_konsul','=', $id)->get();
                $TM = DB::table ('tatap_mukas')->where('id_konsultasi','=', $id)->get();
                
                return view('users.konsul',[
                    'konsultasi' => $konsultasi,
                    'user' => $user,
                    'emp' => $emp,
                    'pesan' =>$pesan,
                    'TM' => $TM,
                ]);

            }
        
        }
    }

    protected function validator(array $data)
    {
        
        return Validator::make($data, [
            'tema' => ['required', 'string', 'max:255'],
            'pertanyaan' => ['required', 'string', 'max:500'],
            
        ]);
    }

    public function inputKonsultasi(Request $request){
        
        $this->validator($request->all())->validate();
        $jabatan =  Auth::guard()->user()->jabatan ;
        $idUnit =  Auth::guard()->user()->id_unit ;
        $unit = Unit::find($idUnit);
      
      
        
       
        Konsultasi::create([
           'id_user' => $request['id_user'],
           'unit_kerja' => $unit->name,
           'jabatan' => $jabatan,
           'tema' => $request['tema'],
           'pertanyaan' => $request['pertanyaan'],
           'status' => 'Baru'

        ]);

        $request->session()->flash('success', 'Konsultasi berhasil diajukan!');
        return redirect('home');
        
            //    return var_dump($request['unit']);
    }


    
  protected function validateJawab(array $data)
  {
      
      return Validator::make($data, [
        
          'jawab' => ['required', 'string', 'max:500'],
          
      ]);
  }

  public function inputJawaban(Request $request){
      $this->validateJawab($request->all())->validate();
      Post::create([
         'id_user' => $request['id_user'],
         'id_konsul' => $request['id_konsul'],
         'pertanyaan' => $request['jawab'],
         'created_by' => 'User',

      ]);

      $request->session()->flash('pesan', 'Pesan Berhasil Ditambahkan!');
      return redirect('konsultasi/user/'.$request['id_konsul']);
   
    }

    public function selesaiKonsul($id){
        $konsultasi = Konsultasi::find($id);
        $konsultasi->status = 'Selesai';
        $konsultasi->save();

        return  $this->showById($id);
    }

    public function tatapMuka(){

        $user =  Auth::guard()->user()->id ;

        $tatapMuka = DB::table ('konsultasis')->where(
            [
                ['id_user','=', $user],
                ['status', '=', 'Tatap Muka'],
            
            ])->get();
        
       
        

        return view('users.tatapMuka',[
            'tatapM' => $tatapMuka,
        ]);
    }


    protected function validateTatap(array $data)
  {
      $now = Carbon::now();
      return Validator::make($data, [
        'now' => $now,
        'jadwal'=> ['date','after_or_equal:now','required'],
        
          
      ]);
  }

    public function addTatapMuka(Request $request){
      
        $this->validateTatap($request->all())->validate();
        $user =  Auth::guard()->user()->id ;

        $konsultasi = Konsultasi::find($request['id']);
        $konsultasi->status = 'Tatap Muka';
        $konsultasi->save();

        TatapMuka::create([
            'id_user' => $user,
            'id_konsultasi' => $request['id'],
            'id_employee' => $request['id_emp'],
            'tanggal' => $request['jadwal'],
            'phone' => Auth::guard()->user()->phone,
            'status' => 'Menunggu Konfirmasi'
        ]);

        $request->session()->flash('tatapMuka', 'Pengajuan tatap muka berhasil! Tunggu konfirmasi pengajuan dari pegawai!');
        
        return  $this->showById( $request['id']);

        
        // dd($request['id_emp']);
    }

    public function ajukanUlang(Request $request){
       

        Validator::make($request->all(), [
            'jadwal' => 'required',
        ])->validate();

        $tM = tatapMuka::find($request['idJadwal']);
        $tM->tanggal =  $request['jadwal'];
        $tM->status = "Menunggu Konfirmasi";
        $tM->save();

        $request->session()->flash('tatapMuka', 'Pengajuan tatap muka berhasil! Tunggu konfirmasi pengajuan dari pegawai!');
        
        return  redirect('tatapmuka/user');
    }

    public function cetak($id){
        $tM = TatapMuka::find($id);
        $user = $tM->id_user;
        $emp = $tM ->id_employee;
        $kons = $tM ->id_konsultasi;

        $u = User::find($user);
        $e = Employee::find($emp);
        $k = Konsultasi::find($kons);

        return view('users.cetak' ,[
            'tM' => $tM,
            'u' => $u,
            'e' => $e ,
            'k' => $k ,

        ]);
    }

    public function account(){
        return view('users.account');
    }

    public function editProfil(){
        $id = Auth::guard('')->user()->id;
        $data = User::find($id);
        return view('users.editProfil' , ['Data' => $data]) ;
    }

    public function saveProfil(Request $request){
       
        $this->validateProfil($request->all())->validate();

        $cek = User::find($request->id);

        $password = $request->password;
        $password2 = $cek->password;

        if(Hash::check($password, $password2)){
            $cek->name = $request->nama;
            $cek->nip = $request->nip;
            $cek->email = $request->email;
            $cek->save();

            return redirect('/user/account')->with('success','Data berhasil diubah');
        }
        else {
            return back()->with('gagal','Password tidak sesuai!');
        }
    }

        public function validateProfil(array $data) {

            return Validator::make($data, [
            
                'email' => 'required|email',
                'nama' => 'required|max:200',
                'nip' => 'required|max:200',
                'password' => 'required',
                
                
            ]);
            
        }
}
