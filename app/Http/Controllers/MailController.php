<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\Empresa;


class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        $empresa = Empresa::find($request->idEmpresa);
        $attachments = [];
        $attachments[] = $empresa->socios;
        // Send the email

        $subject = $empresa->nombreEmpresa . " - Documentos de los socios";

        $body = $empresa->nombreEmpresa . " - Se adjuntan los documentos de los socios";

        Mail::to('robinson.rodriguez@reor-corporativo.com')->send(new SendMail($subject, $body, $attachments));

        return back()->with('success', 'Se envió el correo electrónico a robinson.rodriguez@reor-corporativo.com');
    }
}
