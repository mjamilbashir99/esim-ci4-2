<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP Code</title>
</head>
<body style="font-family: 'Segoe UI', sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; color: #333;">
    <div style="width: 100%; max-width: 600px; margin: auto; background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        <div style="background-color: #007bff; color: #ffffff; padding: 20px; text-align: center; border-radius: 8px 8px 0 0;">
            <h2 style="margin: 0;">Your OTP Verification Code</h2>
        </div>
        <div style="padding: 20px;">
            <p style="line-height: 1.6;">Hi <?= esc($name) ?>,</p>
            <p style="line-height: 1.6;">Thank you for signing up with us! To complete your registration, please verify your email address by entering the OTP below:</p>
            <p style="font-size: 30px; font-weight: bold; color: #007bff; background-color: #f0f8ff; padding: 15px; border-radius: 8px;">
                <?= esc($otp) ?>
            </p>
            <p style="line-height: 1.6;">Once you enter the OTP on the website, your account will be fully verified and activated.</p>
            <p style="line-height: 1.6;">If you didn’t sign up, please ignore this email or contact support.</p>
        </div>
        <div style="font-size: 12px; text-align: center; padding-top: 20px; color: #888888;">
            <p>&copy; <?= date('Y') ?> Hotelbeds. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
