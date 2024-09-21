<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boarding Pass</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f3f3;
            padding: 20px;
        }

        .ticket-container {
            margin: 0 40px;
            background-color: #ffffff;
            border: 2px solid #333333;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: space-between;
        }

        .left-section, .right-section {
            width: 48%;
        }

        .left-section {
            border-right: 2px dashed #999999;
            padding-right: 20px;
        }

        .right-section {
            text-align: center;
            display: flex;
        }

        .right-section .qr-code {
            margin: auto;
        }

        .ticket-header {
            text-transform: uppercase;
            color: #333;
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .ticket-info {
            margin-bottom: 20px;
        }

        .ticket-info strong {
            display: block;
            font-size: 18px;
            color: #444;
        }

        .ticket-info span {
            font-size: 16px;
            color: #666;
        }

        .qr-code img {
            margin-top: 20px;
            width: 150px;
            height: 150px;
        }

        .user-info {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .user-info strong {
            font-size: 10px;
            color: #444;
        }

        .user-info span {
            font-size: 10px;
        }

        .footer-note {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="ticket-container">
    <div class="left-section">
        <div class="ticket-header">{{ $eventTitle }}</div>
        <div class="ticket-info">
            <strong>Date:</strong>
            <span>{{ $eventDate }}</span>
        </div>
        <div class="ticket-info">
            <strong>Category:</strong>
            <span>{{ $category }}</span>
        </div>
        <div class="ticket-info">
            <strong>Unique Code:</strong>
            <span>{{ $uniqueCode }}</span>
        </div>
        <div class="ticket-info user-info">
            <strong>User:</strong>
            <span>{{ $userName }}</span>
            <strong>Email:</strong>
            <span>{{ $userEmail }}</span>
        </div>
    </div>

    <div class="right-section">
        <div class="qr-code">
            {{ QrCode::size(200)->generate($uniqueCode) }}
        </div>
    </div>
</div>

<div class="footer-note">
    Please present this boarding pass for admission to the event.
</div>
</body>
</html>
