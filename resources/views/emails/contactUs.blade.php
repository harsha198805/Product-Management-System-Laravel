<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Us Message</title>
    <style>
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            background-color: #f6f6f6;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-wrapper {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .email-header {
            text-align: center;
            background-color: #4CAF50;
            color: white;
            padding: 20px 0;
            border-radius: 8px 8px 0 0;
            border-bottom: 2px solid #3e8e41;
        }

        .email-header h1 {
            font-size: 28px;
            margin: 0;
        }

        .email-body {
            padding: 20px;
            line-height: 1.6;
            color: #555;
        }

        .email-body h2 {
            font-size: 22px;
            color: #333;
        }

        .email-body p {
            margin: 10px 0;
        }

        .info {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 4px;
        }

        .info strong {
            color: #000;
            font-weight: 600;
        }

        .message-box {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 6px;
        }

        .email-footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #888;
            padding-top: 20px;
            border-top: 1px solid #ddd; /* Border at the top of the footer */
        }

        .email-footer a {
            color: #4CAF50;
            text-decoration: none;
        }

        .email-footer a:hover {
            text-decoration: underline;
        }

        .call-to-action {
            text-align: center;
            margin-top: 30px;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            font-size: 16px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 20px;
            border: 2px solid #4CAF50; /* Border for the button */
        }

        .btn:hover {
            background-color: #45a049;
        }

        @media only screen and (max-width: 600px) {
            .email-wrapper {
                width: 100%;
                padding: 10px;
            }

            .email-header h1 {
                font-size: 22px;
            }

            .email-body h2 {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-header">
            <h1>New Contact Us Message</h1>
        </div>

        <div class="email-body">
            <h2>Hello,</h2>
            <p>We have received a new message from the Contact Us form on your website.</p>

            <div class="info">
                <p><strong>Name:</strong> {{ $name??'' }} {{ $lname??''}}</p>
                <p><strong>Email:</strong> {{ $email??'' }}</p>
            </div>

            <p><strong>Message:</strong></p>
            <div class="message-box">
                <p>{{ $bodyMessage??'' }}</p>
            </div>

            <div class="call-to-action">
                <a href="mailto:{{ $email }}" class="btn">Reply to {{ $name??'' }}</a>
            </div>
        </div>

        <div class="email-footer">
            <p>This email was sent automatically by your website's contact form.</p>
        </div>
    </div>
</body>
</html>
