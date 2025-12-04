<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Application Update</title>
  </head>
  <body>
    <p>Dear {{ $application->name }},</p>

    <p>Thank you for applying to our company. After careful review we regret to inform you that your application was not successful.</p>

    @if(!empty($messageText))
      <p>{{ $messageText }}</p>
    @endif

    <p>We appreciate your interest and encourage you to apply for future openings that match your experience.</p>

    <p>Best regards,<br/>The Company</p>
  </body>
  </html>
