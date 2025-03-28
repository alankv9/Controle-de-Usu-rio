<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;


class ControllerPdf extends Controller
{
    public function processPdf($id){
        $user = User::find($id);
        if(!$user){
            return redirect()->black()->with('error','Usuário não encontrado.');
        }
        $pdf = Pdf::loadView('pdf.usuario', compact('user'));

        return $pdf->download("usuario_{$user->name}.pdf");
    }
}
