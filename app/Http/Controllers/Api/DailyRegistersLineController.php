<?
namespace App\Http\Controllers;

use App\Models\DailyRegistersLine;
use App\Models\DailyRegister;
use Illuminate\Http\Request;

class DailyRegistersLineController extends Controller
{
    /**
     * Listar todas las líneas de un registro diario.
     */
    public function index(DailyRegister $dailyRegister)
    {
        $lines = $dailyRegister->lines;
        return response()->json($lines);
    }

    /**
     * Guardar una nueva línea en el registro diario.
     */
    public function store(Request $request, DailyRegister $dailyRegister)
    {
        $validatedData = $request->validate([
            'line' => 'required|integer',
            'account_cataloge_id' => 'required|exists:account_cataloges,id',
            'debit_amount' => 'required|numeric',
            'credit_amount' => 'required|numeric',
        ]);

        $line = $dailyRegister->lines()->create($validatedData);

        return response()->json([
            'message' => 'Línea agregada con éxito',
            'line' => $line
        ]);
    }

    /**
     * Actualizar una línea de registro diario.
     */
    public function update(Request $request, DailyRegister $dailyRegister, DailyRegistersLine $line)
    {
        $validatedData = $request->validate([
            'line' => 'required|integer',
            'account_cataloge_id' => 'required|exists:account_cataloges,id',
            'debit_amount' => 'required|numeric',
            'credit_amount' => 'required|numeric',
        ]);

        $line->update($validatedData);

        return response()->json([
            'message' => 'Línea actualizada con éxito',
            'line' => $line
        ]);
    }

    /**
     * Eliminar una línea de registro diario.
     */
    public function destroy(DailyRegistersLine $line)
    {
        $line->delete();

        return response()->json(['message' => 'Línea eliminada con éxito']);
    }
}
