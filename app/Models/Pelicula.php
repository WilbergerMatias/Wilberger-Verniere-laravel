<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Genero;
use App\Models\Funcion;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

  
class Pelicula extends Model
{
    use HasFactory;
    protected $table = 'pelicula';
    protected $fillable = [
        'idGenero',
        'nombre'
    ];

    public function genero():HasOne{
        return $this->HasOne(Genero::class, 'id', 'idGenero');
    }

    public function funciones():HasMany{
        return $this->HasMany(Funcion::class, 'id', 'idPelicula');
    }

    public function titulo(){
        return $this->nombre;
    }

    public static function index()
    {
        return Pelicula::orderBy('id')->paginate(10);
    }

    public static function elementosHabilitados()
    {
        return Pelicula::where('habilitado',true)->get();
    }

    /*
        Agrega una pelicula de la lista de funciones
     */
    public static function agregarPelicula(Request $request)
    {
        $pelicula = new Pelicula;

        $pelicula->nombre     = $request->Nombre;
        $pelicula->idGenero   = $request->Genero;
        
        $pelicula->save();

    }

    public static function editarPelicula(Request $request, $id)
    {
        $pelicula = Pelicula::find($id);

        $pelicula->nombre     = $request->Nombre;
        $pelicula->idGenero   = $request->idGenero;
        
        $pelicula->save();
    }

    public static function habilitarPelicula(Request $request)
    {
        $pelicula = $request->Pelicula;
        $peliculaElem = Pelicula::find($pelicula);
        $peliculaElem->habilitado = true;
        $peliculaElem->save();  
    }

    public static function deshabilitarPelicula(Request $request)
    {
        $pelicula = $request->Pelicula;
        $peliculaElem = Pelicula::find($pelicula);
        $peliculaElem->habilitado = false; 
        $peliculaElem->save();
    }

    public static function nombrePelicula($id)
    {
        $pelicula=Pelicula::find($id);
        return $pelicula->nombre;
    }

}