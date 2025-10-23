<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'Adresse email invalide.',
            'subject.required' => 'Le sujet est obligatoire.',
            'message.required' => 'Le message est obligatoire.',
            'message.max' => 'Le message ne peut pas dépasser 2000 caractères.',
        ]);

        try {
            // Save to database
            ContactMessage::create($validated);

            // Send email notification (placeholder for now)
            $this->sendContactNotification($validated);

            Log::info('Contact message received', [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
            ]);

            return back()->with('success', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');

        } catch (\Exception $e) {
            Log::error('Contact form submission failed', [
                'error' => $e->getMessage(),
                'data' => $validated
            ]);

            return back()->withErrors(['general' => 'Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer.']);
        }
    }

    /**
     * Send contact notification email (placeholder)
     */
    private function sendContactNotification(array $data): void
    {
        // TODO: Implement actual email sending
        // For now, just log it
        Log::info('Contact notification email would be sent', [
            'to' => config('mail.admin_email', 'admin@vtcparis.fr'),
            'subject' => 'Nouveau message de contact: ' . $data['subject'],
            'from' => $data['email'],
        ]);
    }
}
