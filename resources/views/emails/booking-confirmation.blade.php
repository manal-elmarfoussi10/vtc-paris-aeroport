<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de réservation VTC</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            background-color: #f8fafc;
        }
        .container {
            background: white;
            margin: 20px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
        }
        .content {
            padding: 30px 20px;
        }
        .booking-details {
            background: #f8fafc;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #3b82f6;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 600;
            color: #374151;
        }
        .detail-value {
            color: #1f2937;
        }
        .status-badge {
            display: inline-block;
            background: #10b981;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .important-info {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
        .important-info h3 {
            margin: 0 0 10px 0;
            color: #92400e;
            font-size: 16px;
        }
        .important-info p {
            margin: 0;
            color: #78350f;
        }
        .contact-info {
            background: #eff6ff;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }
        .contact-info h3 {
            margin: 0 0 15px 0;
            color: #1e40af;
        }
        .contact-item {
            margin: 10px 0;
        }
        .contact-label {
            font-weight: 600;
            color: #374151;
        }
        .contact-value {
            color: #1f2937;
        }
        .footer {
            background: #f9fafb;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer p {
            margin: 0;
            color: #6b7280;
            font-size: 14px;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: white;
            margin-bottom: 10px;
        }
        .booking-id {
            background: #1e40af;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            font-family: monospace;
            font-size: 14px;
            display: inline-block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">VTC Paris Aéroport</div>
            <h1>Confirmation de réservation</h1>
            <p>Votre réservation a été confirmée avec succès</p>
            <div class="booking-id">Réservation #{{ $booking->id }}</div>
        </div>

        <div class="content">
            <p>Bonjour <strong>{{ $booking->customer_name }}</strong>,</p>

            <p>Nous avons le plaisir de vous confirmer votre réservation de chauffeur privé. Voici les détails de votre trajet :</p>

            <div class="booking-details">
                <h3 style="margin: 0 0 15px 0; color: #1e40af;">📍 Détails du trajet</h3>

                <div class="detail-row">
                    <span class="detail-label">Départ :</span>
                    <span class="detail-value">{{ $booking->pickup_address }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Destination :</span>
                    <span class="detail-value">{{ $booking->dropoff_address }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Date & heure :</span>
                    <span class="detail-value">{{ $booking->pickup_time->format('d/m/Y à H:i') }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Passagers :</span>
                    <span class="detail-value">{{ $booking->pax }} personne(s)</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Bagages :</span>
                    <span class="detail-value">{{ $booking->luggage }}</span>
                </div>

                @if($booking->flight_number)
                <div class="detail-row">
                    <span class="detail-label">Numéro de vol :</span>
                    <span class="detail-value">{{ $booking->flight_number }}</span>
                </div>
                @endif

                <div class="detail-row">
                    <span class="detail-label">Véhicule :</span>
                    <span class="detail-value">{{ $booking->vehicle->name ?? 'Non spécifié' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Prix estimé :</span>
                    <span class="detail-value" style="font-weight: bold; color: #1e40af;">{{ number_format($booking->price, 2, ',', ' ') }}€</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Statut :</span>
                    <span class="detail-value"><span class="status-badge">Confirmée</span></span>
                </div>
            </div>

            @if($booking->child_seat_count > 0 || $booking->meet_greet || $booking->notes)
            <div class="booking-details">
                <h3 style="margin: 0 0 15px 0; color: #1e40af;">📋 Services supplémentaires</h3>

                @if($booking->child_seat_count > 0)
                <div class="detail-row">
                    <span class="detail-label">Sièges enfant :</span>
                    <span class="detail-value">{{ $booking->child_seat_count }}</span>
                </div>
                @endif

                @if($booking->meet_greet)
                <div class="detail-row">
                    <span class="detail-label">Accueil personnalisé :</span>
                    <span class="detail-value">Oui</span>
                </div>
                @endif

                @if($booking->notes)
                <div class="detail-row">
                    <span class="detail-label">Notes spéciales :</span>
                    <span class="detail-value">{{ $booking->notes }}</span>
                </div>
                @endif
            </div>
            @endif

            <div class="important-info">
                <h3>⚠️ Informations importantes</h3>
                <p>• Votre chauffeur vous contactera 30 minutes avant l'heure de prise en charge</p>
                <p>• Veuillez être prêt 5 minutes avant l'heure prévue</p>
                <p>• En cas d'urgence, contactez-nous au +33 1 23 45 67 89</p>
                <p>• Les modifications sont possibles jusqu'à 2 heures avant le départ</p>
            </div>

            <div class="contact-info">
                <h3>📞 Besoin d'aide ?</h3>
                <div class="contact-item">
                    <span class="contact-label">Téléphone :</span>
                    <span class="contact-value">+33 1 23 45 67 89</span>
                </div>
                <div class="contact-item">
                    <span class="contact-label">Email :</span>
                    <span class="contact-value">contact@vtc-paris-aeroport.fr</span>
                </div>
                <div class="contact-item">
                    <span class="contact-label">Site web :</span>
                    <span class="contact-value">www.vtc-paris-aeroport.fr</span>
                </div>
            </div>

            <p style="text-align: center; color: #6b7280; font-size: 14px; margin-top: 30px;">
                Merci d'avoir choisi VTC Paris Aéroport pour votre déplacement.<br>
                Nous vous souhaitons un excellent voyage !
            </p>
        </div>

        <div class="footer">
            <p>&copy; 2024 VTC Paris Aéroport. Tous droits réservés.</p>
            <p style="margin-top: 10px; font-size: 12px;">
                Cet email a été envoyé automatiquement. Merci de ne pas y répondre directement.
            </p>
        </div>
    </div>
</body>
</html>
