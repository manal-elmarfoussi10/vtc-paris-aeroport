<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Nouvelle réservation VTC</title>
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
            background: linear-gradient(135deg, #b91c1c, #ef4444);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 30px 20px;
        }
        .booking-details {
            background: #fef2f2;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #b91c1c;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #fecaca;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 600;
            color: #7f1d1d;
        }
        .detail-value {
            color: #4b1d1d;
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
        .booking-id {
            background: #b91c1c;
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
            <h1>Nouvelle réservation confirmée</h1>
            <div class="booking-id">Réservation #{{ $booking->id }}</div>
        </div>
        <div class="content">
            <p>Bonjour,</p>
            <p>Une nouvelle réservation a été effectuée. Voici les informations du client :</p>
            <div class="booking-details">
                <div class="detail-row">
                    <span class="detail-label">Nom :</span>
                    <span class="detail-value">{{ $booking->customer_name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email :</span>
                    <span class="detail-value">{{ $booking->customer_email }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Téléphone :</span>
                    <span class="detail-value">{{ $booking->customer_phone ?? 'Non spécifié' }}</span>
                </div>
            </div>

            <p>Détails du trajet :</p>
            <div class="booking-details">
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
                <div class="detail-row">
                    <span class="detail-label">Véhicule :</span>
                    <span class="detail-value">{{ $booking->vehicle->name ?? 'Non spécifié' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Prix estimé :</span>
                    <span class="detail-value">{{ number_format($booking->price, 2, ',', ' ') }}€</span>
                </div>
            </div>

            @if($booking->child_seat_count > 0 || $booking->meet_greet || $booking->notes)
            <p>Services supplémentaires :</p>
            <div class="booking-details">
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

            <p>Merci,<br/>L'équipe VTC Paris Aéroport</p>
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
