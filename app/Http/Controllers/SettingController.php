<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Notifications\AnonymousNotifiable;
use App\Notifications\CustomEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SettingController extends Controller
{
    /**
     * Show the settings configuration view.
     */
    public function index()
    {
        $settings = [
            'quote_notification_email' => Setting::get('quote_notification_email', 'diegopevi05@gmail.com'),
            'claims_notification_email' => Setting::get('claims_notification_email', 'diegopevi05@gmail.com'),
            'contact_notification_email' => Setting::get('contact_notification_email', 'diegopevi05@gmail.com'),
            'company_phone' => Setting::get('company_phone', '+51 987 654 321'),
            'company_whatsapp' => Setting::get('company_whatsapp', '+51 987 654 321'),
            'company_address' => Setting::get('company_address', 'Av. Elmer Faucett s/n, Callao, Lima - Perú'),
        ];

        return view('dashboard.config', compact('settings'));
    }

    /**
     * Update system notification and contact settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'quote_notification_email' => 'required|string',
            'claims_notification_email' => 'required|string',
            'contact_notification_email' => 'required|string',
            'company_phone' => 'nullable|string|max:50',
            'company_whatsapp' => 'nullable|string|max:50',
            'company_address' => 'nullable|string|max:255',
        ], [
            'quote_notification_email.required' => 'El correo para cotizaciones es obligatorio.',
            'claims_notification_email.required' => 'El correo para libro de reclamaciones es obligatorio.',
            'contact_notification_email.required' => 'El correo para contacto es obligatorio.',
        ]);

        // Validate each comma-separated email list
        $emailFields = [
            'quote_notification_email' => 'Cotizaciones',
            'claims_notification_email' => 'Libro de Reclamaciones',
            'contact_notification_email' => 'Formulario de Contacto',
        ];

        foreach ($emailFields as $field => $label) {
            $raw = $request->input($field, '');
            $parts = preg_split('/[,;\s]+/', (string) $raw, -1, PREG_SPLIT_NO_EMPTY);
            if (empty($parts)) {
                return back()->withInput()->withErrors([
                    $field => "Debe ingresar al menos un correo válido para {$label}.",
                ]);
            }
            foreach ($parts as $email) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    return back()->withInput()->withErrors([
                        $field => "El valor '{$email}' no es un correo electrónico válido en {$label}.",
                    ]);
                }
            }
        }

        Setting::set('quote_notification_email', $request->quote_notification_email, 'notifications');
        Setting::set('claims_notification_email', $request->claims_notification_email, 'notifications');
        Setting::set('contact_notification_email', $request->contact_notification_email, 'notifications');

        if ($request->has('company_phone')) {
            Setting::set('company_phone', $request->company_phone, 'general');
        }
        if ($request->has('company_whatsapp')) {
            Setting::set('company_whatsapp', $request->company_whatsapp, 'general');
        }
        if ($request->has('company_address')) {
            Setting::set('company_address', $request->company_address, 'general');
        }

        return redirect()->route('dashboard_settings')
            ->with('status', '¡Configuración de correos guardada exitosamente!');
    }

    /**
     * Send an immediate test notification to verify delivery.
     */
    public function testEmail(Request $request)
    {
        $request->validate([
            'type' => 'required|in:quote,claims,contact',
        ]);

        $type = $request->input('type');
        $settingKey = $type . '_notification_email';
        $emails = Setting::getEmails($settingKey, env('APP_ADMIN_EMAIL', 'diegopevi05@gmail.com'));

        if (empty($emails)) {
            return back()->withErrors(['test' => 'No hay correos válidos configurados para esta sección.']);
        }

        $titles = [
            'quote' => 'Cotizaciones Web',
            'claims' => 'Libro de Reclamaciones Virtual',
            'contact' => 'Formulario de Contacto Web',
        ];

        $title = $titles[$type] ?? 'Notificaciones LanEx';

        try {
            foreach ($emails as $email) {
                $notifiable = new AnonymousNotifiable($email);
                $notification = new CustomEmailNotification(
                    "🧪 [Prueba de Configuración] {$title} — LanEx",
                    "¡Hola! Notificación de prueba del panel de LanEx",
                    [
                        "Este es un correo de prueba generado desde la sección de Configuración del panel de administración.",
                        "Canal verificado: {$title}.",
                        "Destinatario configurado: {$email}.",
                        "Fecha y hora: " . now()->format('d/m/Y H:i:s') . " (Hora del servidor).",
                        "Si recibiste este mensaje, significa que el canal de notificaciones está correctamente enlazado y listo para recibir envíos reales de clientes."
                    ],
                    "Ir al Panel de LanEx",
                    route('dashboard_settings'),
                    [
                        "LanEx Logistics — Sistema de Notificaciones Centralizado."
                    ],
                    "Atentamente,\nEquipo de Operaciones LanEx",
                    'primary'
                );

                $notifiable->notify($notification);
            }

            return back()->with('status', "¡Correo de prueba enviado con éxito a: " . implode(', ', $emails) . "!");
        } catch (\Throwable $e) {
            Log::error('[Test Email Error] ' . $e->getMessage(), ['exception' => $e]);
            return back()->withErrors([
                'test' => 'Ocurrió un error al enviar el correo de prueba: ' . $e->getMessage()
            ]);
        }
    }
}
