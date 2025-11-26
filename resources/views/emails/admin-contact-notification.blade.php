<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Nouveau message de contact</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            background-color: #f8fafc;
            line-height: 1.5;
        }
        .container {
            background: white;
            margin: 20px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 12px 12px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content p {
            margin: 10px 0;
        }
        .detail-label {
            font-weight: 600;
            color: #1e40af;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Nouveau message de contact</h1>
        </div>
        <div class="content">
            <p><span class="detail-label">Nom :</span> {{ $data['name'] ?? 'Non spécifié' }}</p>
            <p><span class="detail-label">Email :</span> {{ $data['email'] ?? 'Non spécifié' }}</p>
            <p><span class="detail-label">Téléphone :</span> {{ $data['phone'] ?? 'Non spécifié' }}</p>
            <p><span class="detail-label">Sujet :</span> {{ $data['subject'] ?? 'Non spécifié' }}</p>
            <p><span class="detail-label">Message :</span></p>
            <p>{{ $data['message'] ?? 'Non spécifié' }}</p>
        </div>
    </div>
</body>
</html>
