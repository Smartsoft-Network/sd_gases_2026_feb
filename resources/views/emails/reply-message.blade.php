<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to your Inquiry</title>
    <style>
        body { font-family: 'Inter', 'Segoe UI', Helvetica, Arial, sans-serif; background-color: #f3f4f6; margin: 0; padding: 0; color: #374151; -webkit-font-smoothing: antialiased; }
        .wrapper { width: 100%; padding: 40px 0; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); border: 1px solid #e5e7eb; }
        .header { background-color: #F43F5C; padding: 40px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 26px; font-weight: 800; letter-spacing: -0.025em; text-transform: uppercase; }
        .content { padding: 48px 40px; }
        .greeting { font-size: 18px; font-weight: 600; color: #111827; margin-bottom: 24px; }
        .reply-section { position: relative; padding: 0 0 40px 0; }
        .reply-text { font-size: 16px; line-height: 1.8; color: #4b5563; margin: 0; white-space: pre-wrap; }
        .signature { margin-top: 40px; padding-top: 32px; border-top: 1px solid #f3f4f6; color: #6b7280; font-size: 15px; }
        .signature-name { color: #111827; font-weight: 700; font-size: 16px; margin-top: 4px; display: block; }
        .original-message-card { margin-top: 56px; padding: 32px; background-color: #f9fafb; border-radius: 12px; border: 1px solid #f1f5f9; }
        .original-header { display: flex; align-items: center; margin-bottom: 16px; }
        .original-label { font-size: 12px; font-weight: 700; text-transform: uppercase; color: #9ca3af; letter-spacing: 0.05em; }
        .original-text { font-size: 14px; color: #6b7280; line-height: 1.6; font-style: italic; border-left: 3px solid #e5e7eb; padding-left: 16px; margin: 0; }
        .footer { padding: 32px 40px; background-color: #f9fafb; border-top: 1px solid #f3f4f6; text-align: center; }
        .footer p { margin: 8px 0; font-size: 13px; color: #9ca3af; line-height: 1.5; }
        .footer a { color: #F43F5C; text-decoration: none; font-weight: 500; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1>{{ config('app.name') }}</h1>
            </div>
            <div class="content">
                <div class="greeting">Dear {{ $messageData->name }},</div>
                
                <div class="reply-section">
                    <p class="reply-text">{!! nl2br(e($messageData->reply)) !!}</p>
                </div>

                <div class="signature">
                    Warm regards,<br>
                    <span class="signature-name">The {{ config('app.name') }} Team</span>
                </div>

                <div class="original-message-card">
                    <div class="original-header">
                        <span class="original-label">Your Previous Inquiry regarding {{ $messageData->subject }}</span>
                    </div>
                    <p class="original-text">"{{ $messageData->message }}"</p>
                </div>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                <p>Visit our website at <a href="{{ url('/') }}">{{ url('/') }}</a></p>
                <p>This is a secure communication from our official contact support.</p>
            </div>
        </div>
    </div>
</body>
</html>
