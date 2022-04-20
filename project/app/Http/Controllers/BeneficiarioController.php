<?php

namespace App\Http\Controllers;

use App\Models\nefropediatria;
use Illuminate\Http\Request;
use App\Http\Resources\Beneficiario as BeneficiarioResource;
use App\Models\Jornada as Jornada;
use App\Models\Beneficiario as Beneficiario;
use Illuminate\Support\Facades\DB;

class BeneficiarioController extends Controller
{
    //Regresa la colección de todos los beneficiarios.
    public function index()
    {
        $datos['Beneficiario']=BeneficiarioResource::collection(Beneficiario::paginate(10));
        
        return view('beneficiario.index',$datos);
    }

    //Regresa un beneficiario en específico a partir de su id.
    public function show($id)
    {
        $beneficiario=Beneficiario::findOrFail($id);
        $nefropediatria = nefropediatria::where('beneficiario_id', $id)->orderBy('id', 'desc')->paginate(3,['*'],'Nefropediatria');
        
        return view('beneficiario.show',compact('beneficiario','nefropediatria'))->with(['id'=>$id]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nombreBeneficiario' => 'required',
            'fechaNacimiento' => 'required',
            'genero' => 'required',
            'curp' => 'required',
            'diagnostico' => 'required',
            'tipoSangre' => 'required',
            'email' => 'required',
            'telefono' => 'required|numeric',
            'municicpio' => 'nullable',
            'observacion' => 'nullable',
            'fecharegistro' => 'nullable',//'required',
        ]);
    

        $beneficiario = Beneficiario::create([
            'nombreBeneficiario' => request('nombreBeneficiario'),
            'fechaNacimiento' => request('fechaNacimiento'),
            'genero' => request('genero'),
            'curp' => request('curp'),
            'diagnostico' => request('diagnostico'),
            'tipoSangre' => request('tipoSangre'),
            'email' => request('email'),
            'telefono' => request('telefono'),
            'municipio' => request('municipio'),
            'observacion' => request('observacion'),
            //'fecharegistro' => request('fecharegistro'),
        ]);

        $beneficiario->jornadas()->attach(request('jornada_id'));

        return redirect('beneficiario')->with('nuevo','Beneficiario Registrado Exitosamente!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        $arr = Jornada::getAllJornadas();

        return view('beneficiario.create', ["jornadas" => $arr]);
    }
    
    public function edit($id)
    {
        $beneficiarioEdit = Beneficiario::find($id);
        $arr = Jornada::getAllJornadas();

        return view('beneficiario.create', ["jornadas" => $arr, "beneficiario" => $beneficiarioEdit]);
    }

    public function update(Request $request, Beneficiario $beneficiario)
    {
        $data =[
        'nombreBeneficiario', 'curp', 'tipoSangre', 'genero', 'email', 'fechaNacimiento', 'telefono', 'direccion', 'observacion',
        ];

        request()->validate([
            'nombreBeneficiario' => 'required',
            'fechaNacimiento' => 'required',
            'genero' => 'required',
            'curp' => 'required',
            'diagnostico' => 'required',
            'tipoSangre' => 'required',
            'email' => 'required',
            'telefono' => 'required|numeric',
            'municipio' => 'required',
            'observacion' => 'nullable',
            'fecharegistro' => 'nullable', //'required',
        ]);

        $beneficiario->update([
            'nombreBeneficiario'  => $request->input('nombreBeneficiario'),
            'curp' => $request->input('curp'),
            'tipoSangre' => $request->input('tipoSangre'),
            'genero'=> $request->input('genero'),
            'email' => $request->input('email'),
            'fechaNacimiento' => $request->input('fechaNacimiento'),
            'telefono' => $request->input('telefono'),
            'direccion' => $request->input('direccion'),
            'observacion' => $request->input('observacion'),
            //'fecharegistro' => $request->input('fecharegistro')
            ]);

        if ($beneficiario->jornadas->isEmpty())
        {
            $beneficiario->jornadas()->attach($request->input('jornada_id'));
        }
        else
        {
            $jornadaId = $beneficiario->jornadas[0]->pivot->jornada_id;
            $beneficiario->jornadas()->updateExistingPivot($jornadaId, ['jornada_id' => $request->input('jornada_id'),]);
        }
        
        return redirect('beneficiario')->with('nuevo','Beneficiario Editado Exitosamente!');
    }

    public function destroy(Beneficiario $beneficiario)
    {
        $beneficiario->jornadas()->detach();
        $success = $beneficiario->delete();
        
        return redirect('beneficiario/')->with('nuevo','Beneficiario Eliminado Exitosamente!');
    }

    // Buscar un beneficiario a partir del request AJAX.
    public function searchBeneficiarios(Request $request)
    {

        $beneficiarios = Beneficiario::where('nombreBeneficiario', 'like', '%'.$request->get('searchQuest'). '%')
                        ->where('genero', 'like', '%'.$request->get('searchQuestGenero'). '%')
                        ->get();
        
        return json_encode( $beneficiarios );
    }

    // Busca un beneficiario con el request AJAX y el parámetro edad.
    public function searchBeneficiariosAge(Request $request)
    {
        $beneficiarios = Beneficiario::where('nombreBeneficiario', 'like', '%'.$request->get('searchQuest'). '%')
                        ->whereBetween('fechaNacimiento', [$request->get('fechaBegin'), $request->get('fechaEnd')])
                        ->where('genero', 'like', '%'.$request->get('searchQuestGenero'). '%')
                        ->get();
        
        return json_encode( $beneficiarios );
    }

    // Buscar un beneficiario a partir del request AJAX.
    public function searchMunicipio(Request $request)
    {

        $beneficiarios = Beneficiario::where('municipio', 'like', '%'.$request->get('searchQuestMunicipio'). '%')
                        ->where('genero', 'like', '%'.$request->get('searchQuestGenero'). '%')
                        ->get();
        
        return json_encode( $beneficiarios );
    }
}
