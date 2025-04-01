<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;

class ControllerPdfEmpres extends Controller {

    public function processPdfE($id){
        $empresa = Empresa::find($id);
        if(!$empresa){
            return redirect()->back()->with('error','Empresa não encontrado.');
        }
        $pdf = Pdf::loadView('pdf.empresa', compact('empresa'));

        return $pdf->download("empresa_{$empresa->name}.pdf");
    }

}