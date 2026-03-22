<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f9fafb; margin: 0; padding: 0; color: #1f2937; }
        .wrapper { width: 100%; padding: 40px 0; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); border: 1px solid #e5e7eb; }
        .header { background-color: #F43F5C; padding: 32px 40px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; font-weight: 700; letter-spacing: -0.025em; }
        .content { padding: 40px; }
        .section-title { font-size: 14px; font-weight: 600; text-transform: uppercase; color: #6b7280; margin-bottom: 16px; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb; padding-bottom: 8px; }
        .info-grid { display: table; width: 100%; margin-bottom: 32px; }
        .info-row { display: table-row; }
        .info-label { display: table-cell; width: 100px; font-weight: 600; color: #4b5563; padding: 8px 0; font-size: 14px; }
        .info-value { display: table-cell; color: #111827; padding: 8px 0; font-size: 14px; }
        .message-container { background-color: #f3f4f6; border-radius: 8px; padding: 24px; border-left: 4px solid #F43F5C; }
        .message-text { font-size: 15px; line-height: 1.6; color: #374151; white-space: pre-wrap; margin: 0; }
        .footer { padding: 32px 40px; background-color: #f9fafb; border-top: 1px solid #e5e7eb; text-align: center; }
        .footer p { margin: 0; font-size: 13px; color: #9ca3af; }
        .btn-container { text-align: center; margin-top: 32px; }
        .btn { display: inline-block; background-color: #F43F5C; color: #ffffff !important; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; transition: background-color 0.2s; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1>New Message from {{ config('app.name') }}</h1>
            </div>
            <div class="content">
                <div class="section-title">Sender Information</div>
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">Name</div>
                        <div class="info-value">{{ $messageData->name }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $messageData->email }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Phone</div>
                        <div class="info-value">{{ $messageData->phone ?? 'N/A' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Subject</div>
                        <div class="info-value">{{ $messageData->subject }}</div>
                    </div>
                </div>

                <div class="section-title">Message Content</div>
                <div class="message-container">
                    <p class="message-text">{{ $messageData->message }}</p>
                </div>

                <div class="btn-container">
                    <a href="{{ url('/admin/messages/' . $messageData->id) }}" class="btn">View in Admin Panel</a>
                </div>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                <p>This is an automated notification from your website contact form.</p>
            </div>
        </div>
    </div>
</body>
</html>
