<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
</head>
<body style="font-family: 'Segoe UI', sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; color: #333;">
    <div style="width: 100%; max-width: 600px; margin: auto; background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        <div style="background-color: #007bff; color: #ffffff; padding: 20px; text-align: center; border-radius: 8px 8px 0 0;">
            <h2 style="margin: 0;">Welcome to Our Platform!</h2>
        </div>
        <div style="padding: 20px;">
            <h3 style="margin-bottom: 20px; color: #007bff;">Hi <?= esc($name) ?>,</h3>
            <p style="line-height: 1.6;">We're excited to have you on board! Your account has been successfully created. You can now log in and start exploring our services.</p>
            <p style="line-height: 1.6;">Here are some next steps:</p>
            <ul style="line-height: 1.8;">
                <li>Complete your profile</li>
                <li>Explore our features</li>
                <li>Start using the platform</li>
            </ul>
            <a href="<?= base_url('login') ?>" style="display: inline-block; background-color: #28a745; color: #ffffff; text-align: center; padding: 12px 25px; border-radius: 5px; text-decoration: none; font-size: 16px; margin-top: 20px;">Log in Now</a>
        </div>
        <div style="font-size: 12px; text-align: center; padding-top: 20px; color: #888888;">
            <p>&copy; <?= date('Y') ?> Hotelbeds. All rights reserved.</p>
            <div style="margin-top: 10px; text-align: center;">
                <a href="#" style="color: #007bff; text-decoration: none; margin: 0 10px;">Privacy Policy</a> | 
                <a href="#" style="color: #007bff; text-decoration: none; margin: 0 10px;">Terms of Service</a>
            </div>
        </div>
    </div>
</body>
</html>
