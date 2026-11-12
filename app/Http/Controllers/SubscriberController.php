<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Notifications\AnonymousNotifiable;
use App\Notifications\CustomEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscriberController extends Controller
{
    /**
     * Display a listing of subscribers.
     */
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $query = Subscription::query();

        if ($search) {
            $query->where('email', 'like', "%{$search}%");
        }

        $subscribers = $query->orderBy('id', 'desc')->paginate(12)->withQueryString();
        $totalCount = Subscription::count();

        return view('dashboard.subscribers', compact('subscribers', 'search', 'totalCount'));
    }

    /**
     * Remove the specified subscriber from storage.
     */
    public function destroy($id)
    {
        $subscriber = Subscription::findOrFail($id);
        $email = $subscriber->email;
        $subscriber->delete();

        return redirect()->route('dashboard_subscribers')
            ->with('status', "Suscriptor {$email} eliminado correctamente.");
    }

    /**
     * Send bulk email / newsletter to all subscribers.
     */
    public function sendNewsletter(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:5000',
            'action_text' => 'nullable|string|max:100',
            'action_url' => 'nullable|url|max:255',
        ], [
            'subject.required' => 'El asunto del boletín es obligatorio.',
            'title.required' => 'El título o saludo es obligatorio.',
            'content.required' => 'El contenido del mensaje es obligatorio.',
            'action_url.url' => 'La URL del botón debe ser un enlace válido (ej: https://lanexsac.com/services).',
        ]);

        $subscribers = Subscription::all();

        if ($subscribers->isEmpty()) {
            return back()->withErrors(['newsletter' => 'No hay suscriptores registrados para enviar el boletín.']);
        }

        $paragraphs = array_filter(
            array_map('trim', explode("\n", $validated['content']))
        );

        $sentCount = 0;
        $errorCount = 0;

        foreach ($subscribers as $subscriber) {
            try {
                $notifiable = new AnonymousNotifiable($subscriber->email);
                $notification = new CustomEmailNotification(
                    $validated['subject'],
                    $validated['title'],
                    $paragraphs,
                    $validated['action_text'] ?? null,
                    $validated['action_url'] ?? null,
                    [
                        "Has recibido este boletín porque estás suscrito a las actualizaciones de LanEx Logistics.",
                        "Express Lane Logistics S.A.C. — Callao, Perú."
                    ],
                    "Atentamente,\nEquipo de LanEx Logistics",
                    'primary'
                );

                $notifiable->notify($notification);
                $sentCount++;
            } catch (\Throwable $e) {
                $errorCount++;
                Log::error("[Newsletter Broadcast Error] Para {$subscriber->email}: " . $e->getMessage());
            }
        }

        return redirect()->route('dashboard_subscribers')
            ->with('status', "¡Boletín enviado exitosamente a {$sentCount} suscriptores!" . ($errorCount > 0 ? " ({$errorCount} fallaron)" : ""));
    }
}
