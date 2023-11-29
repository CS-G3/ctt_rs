<!DOCTYPE html>
<html>
<head>
    <title>CTT RS Manager Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        p {
            color: #333;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .credentials {
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <p>{{ $name }}, you are registered as a manager for GCIT (Computational Thinking Test Ranking System) CTT RS.</p>
    <p style="margin-bottom: 20px;">Use the credential below to login:</p>

    <div class="credentials">
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Password:</strong> {{ $password }}</p>
    </div>
</body>
</html>
