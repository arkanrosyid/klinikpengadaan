<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Employee;
use App\Models\TatapMuka;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function konsultasi()
    {
        $konsultasi = DB::table('konsultasis')->where(
            'status','=' , 'Baru'
        ) ->get();
        return view('employee.konsultasi' ,[
            'konsultasi' => $konsultasi,
        ]);
    }

    public function konsultasiByEmp()
    {
        $emp =Auth::guard('employee')->user()->id;
        $aktif = DB::table('konsultasis')
        ->where('id_employee','=' , $emp)
        ->where('status','=','Aktif')
        ->get();
        

        $selesai = DB::table('konsultasis')
        ->where('id_employee','=' , $emp)
        ->where('status','=','Selesai')
        ->get();
        
        $tatap = DB::table('konsultasis')
        ->where('id_employee','=' , $emp)
        ->where('status','=','Tatap Muka')
        ->get();

        return view('employee.konsultasiByEmp' ,[
            'konsultasi' => $aktif,
            'selesai' => $selesai,
           
        ]);
    }

    public function tanggapi($id){

        $id_emp = Auth::guard('employee')->user()->id;
        $konsultasi = Konsultasi::find($id);

        $konsultasi->id_employee = $id_emp;
        $konsultasi->unit_employee = "UKPBJ";
        $konsultasi->status = 'Aktif';
        
        $konsultasi->save();
      

        return redirect('konsultasi/'.$id);

    }

  
    public function showById($id){
        $konsultasi = Konsultasi::find($id);
        
       

        $user =  User::find($konsultasi['id_user']);
        $pesan = DB::table ('posts')->where('id_konsul','=', $id)->get();
        $TM = DB::table ('tatap_mukas')->where('id_konsultasi','=', $id)->get();

        return view('employee.konsul',[
            'konsultasi' => $konsultasi,
             'user' => $user,
             'pesan' =>$pesan,
             'TM' => $TM,
        ]);
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
         'created_by' => 'Employee',

      ]);

      $request->session()->flash('pesan', 'Pesan Berhasil Ditambahkan!');
      return redirect('konsultasi/'.$request['id_konsul']);
   
    }

    public function tatapMuka()
    {
        $emp =Auth::guard('employee')->user()->id;
       
        
        $tatap = DB::table('konsultasis')
        ->where('id_employee','=' , $emp)
        ->where('status','=','Tatap Muka')
        ->get();

        return view('employee.tatapMuka' ,[
            'tatapM' => $tatap,
          
           
        ]);
    }

    public function selesaikanTM(Request $request){
       
        $id = $request->id;

        // dd($request->id);

        $kons = Konsultasi::find($id);

        $kons->status = "Selesai";
        $kons->save();
        
        $jad = DB::Table('tatap_mukas')
        ->where('id_konsultasi' ,'=', $id)
        ->get();


         $TM = TatapMuka::find($jad[0]->id);
       $TM->status = "Selesai";
       $TM->hasil = $request->hasil;
       $TM->save();
       
       return redirect('employee/tatapmuka');
    
    }
    public function setujuiTM($id){
        $jad = DB::Table('tatap_mukas')
        ->where('id_konsultasi' ,'=', $id)
        ->get();


         $TM = TatapMuka::find($jad[0]->id);
       $TM->status = "Disetujui";
       $TM->save();
       
       return redirect('employee/tatapmuka');
    
    }
    public function ajukanTM($id){

        $jad = DB::Table('tatap_mukas')
        ->where('id_konsultasi' ,'=', $id)
        ->get();


         $TM = TatapMuka::find($jad[0]->id);
       $TM->status = "Ajukan Ulang";
       $TM->save();
       
       return redirect('employee/tatapmuka');
    
    }

    public function account(){
        return view('employee.account');
    }

    public function editProfil(){
        $id = Auth::guard('employee')->user()->id;
        $data = Employee::find($id);
        return view('employee.editProfil' , ['Data' => $data]) ;
    }

    public function saveProfil(Request $request){
       
        $this->validateProfil($request->all())->validate();

        $cek = Employee::find($request->id);

        $password = $request->password;
        $password2 = $cek->password;

        if(Hash::check($password, $password2)){
            $cek->name = $request->nama;
            $cek->nip = $request->nip;
            $cek->email = $request->email;
            $cek->save();

            return redirect('/employee/account')->with('success','Data berhasil diubah');
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
