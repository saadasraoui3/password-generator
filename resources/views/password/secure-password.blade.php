<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Password Security</title>
    <style>
        body {
            background: #111d13;
            font-family: Poppins, sans-serif;
            color: #a1cca5;
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }

        .box {
            width: 480px;
            padding: 25px;
            background: #415d43;
            border-radius: 15px;
            border: 1px solid #709775;
        }

        input {
            width: 100%;
            padding: 13px;
            font-size: 18px;
            border-radius: 10px;
            border: 1px solid #8fb996;
            background: #111d13;
            color: #a1cca5;
            margin-top: 10px;
        }

        button {
            margin-top: 15px;
            width: 100%;
            padding: 14px;
            background: #709775;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            color: #111d13;
            font-weight: bold;
            cursor: pointer;
        }

        .result {
            background: #111d13;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            border: 1px solid #709775;
            word-wrap: break-word;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Secure Your Password</h2>

    <form action="{{ route('secure.process') }}" method="POST">
        @csrf
        <label>Your Password:</label>
        <input type="text" name="password" value="{{ session('old_password') }}" placeholder="Paste your password here">

        <button type="submit">Secure It</button>
    </form>

    @if (isset($hashed))
    <div class="result">
        <strong>Secure Hash:</strong><br><br>
        {{ $hashed }}
    </div>
@endif
</div>

</body>
</html>
