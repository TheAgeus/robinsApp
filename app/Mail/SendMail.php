<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Database\Eloquent\Collection;

use App\Models\Empresa;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $body, $attachments = [])
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->socios = $attachments[0];
    }

    /**
     * Get the message envelope.
     */

    public function saveBlobToTempFile($blob, $fileName)
    {
        // Directorio temporal para guardar el archivo
        $tempPath = storage_path("app/temp/{$fileName}");

        // Asegurarse de que el directorio exista
        if (!file_exists(dirname($tempPath))) {
            mkdir(dirname($tempPath), 0755, true);
        }

        // Guardar los datos del blob en el archivo temporal
        file_put_contents($tempPath, $blob);

        return $tempPath;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.test',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */


     
     public function build() 
     {
        $email = $this->subject($this->subject)
                    ->view('emails.test')
                    ->with('body', $this->body);

        foreach($this->socios as $socio) {
            $fileName01 = $socio->nombre . " - Comprobante de domicilio.pdf";
            $fileName02 = $socio->nombre . " - Acta de nacimiento.pdf";
            $fileName03 = $socio->nombre . " - INE.pdf";
            $fileName04 = $socio->nombre . " - Acta de matrimonio.pdf";
            $fileName05 = $socio->nombre . " - Constancia de situacion fiscal.pdf";
            #$tempFilePath = $this->saveBlobToTempFile($socio['comprobanteDomicilioPdf'], $fileName);
            
            $email->attachData(
                base64_decode($socio['comprobanteDomicilioPdf']),
                $fileName01, 
                ['mine' => 'application/pdf']
            )->attachData(
                base64_decode($socio['actaNacimientoPdf']),
                $fileName02, 
                ['mine' => 'application/pdf']
            )->attachData(
                base64_decode($socio['inePdf']),
                $fileName03, 
                ['mine' => 'application/pdf']
            )->attachData(
                base64_decode($socio['actaMatrimonioPdf']),
                $fileName04, 
                ['mine' => 'application/pdf']
            )->attachData(
                base64_decode($socio['constanciaSituacionFiscalPdf']),
                $fileName05, 
                ['mine' => 'application/pdf']
            );       
            
        }

        return $email;
     }
    

    public function attachments(): array
    {
        return [];
        /*
        return [Attachment::fromData(fn () => base64_decode($this->socios[0]->comprobanteDomicilioPdf), 'Report.pdf')
        ->withMime('application/pdf')];
         */
    }
}
