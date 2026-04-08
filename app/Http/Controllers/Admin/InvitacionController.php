<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class InvitacionController extends Controller
{
    public function index(Request $request)
    {
        // Manejar parámetro de items per page
        if ($request->has('perpage')) {
            $perpage = (int) $request->get('perpage');
            if (in_array($perpage, [10, 20, 50, 100])) {
                session(['pagination_perpage' => $perpage]);
            }
        }
        
        $perpage = session('pagination_perpage', 20);
        
        $query = Invitaciones::query();

        // Search by email
        if ($request->filled('q')) {
            $buscar = $request->q;
            $query->where('email', 'like', "%{$buscar}%");
        }

        // Filter by usage status
        if ($request->filled('estado')) {
            $query->where('usado', $request->estado === 'usado');
        }

        $invitaciones = $query->latest()->paginate($perpage)->withQueryString();
        
        return view('admin.invitaciones.index', compact('invitaciones'));
    }

    public function enviar(Request $request)
{
    $request->validate([
        'email' => 'required|email'
    ]);

    // Buscar si ya existe una invitación
    $inv = Invitaciones::where('email', $request->email)->first();

    // Si existe y ya fue usada → no permitir otra invitación
    if ($inv && $inv->usado) {
        return back()->withErrors(['email' => 'Este correo ya se registró anteriormente.']);
    }

    // Si existe pero NO ha sido usada → regenerar token
    if ($inv && !$inv->usado) {
        $inv->token = Str::random(40);
        $inv->save();
    }

    // Si no existe → crear nueva invitación
    if (!$inv) {
        $inv = Invitaciones::create([
            'email' => $request->email,
            'token' => Str::random(40)
        ]);
    }

    // Enviar correo
    $link = url('/register?token=' . $inv->token);

    Mail::raw("Has sido invitado a registrarte. Ingresa aquí: $link", function ($m) use ($request) {
        $m->to($request->email)->subject('Invitación para registro');
    });

    return back()->with('success', 'Invitación enviada correctamente.');
}

}
