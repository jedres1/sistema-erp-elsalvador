<?

namespace App\Http\Controllers;

use App\Models\DailyRegister;
use Illuminate\Http\Request;

class DailyRegisterController extends Controller
{
    /**
     * Listar todos los registros diarios.
     */
    public function index()
    {
        $dailyRegisters = DailyRegister::with('lines')->get();
        return response()->json($dailyRegisters);
    }

    /**
     * Guardar un nuevo registro diario.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date_register' => 'required|date',
            'description' => 'required|string|max:200',
            'mount_debit' => 'required|numeric',
            'mount_credit' => 'required|numeric',
            'balance' => 'required|numeric',
            'mayor' => 'required|in:Y,N',
        ]);

        $dailyRegister = DailyRegister::create($validatedData);

        return response()->json([
            'message' => 'Registro diario creado con éxito',
            'daily_register' => $dailyRegister
        ]);
    }

    /**
     * Mostrar un registro diario específico.
     */
    public function show(DailyRegister $dailyRegister)
    {
        return response()->json($dailyRegister);
    }

    /**
     * Actualizar un registro diario existente.
     */
    public function update(Request $request, DailyRegister $dailyRegister)
    {
        $validatedData = $request->validate([
            'date_register' => 'required|date',
            'description' => 'required|string|max:200',
            'mount_debit' => 'required|numeric',
            'mount_credit' => 'required|numeric',
            'balance' => 'required|numeric',
            'mayor' => 'required|in:Y,N',
        ]);

        $dailyRegister->update($validatedData);

        return response()->json([
            'message' => 'Registro diario actualizado con éxito',
            'daily_register' => $dailyRegister
        ]);
    }

    /**
     * Eliminar un registro diario.
     */
    public function destroy(DailyRegister $dailyRegister)
    {
        $dailyRegister->delete();

        return response()->json(['message' => 'Registro diario eliminado con éxito']);
    }
}
