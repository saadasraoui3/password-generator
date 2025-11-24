<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Generator</title>

    <style>
    /* ====== Global Green Calm Style ====== */
    body {
        background: #111d13; /* Carbon Black */
        color: #a1cca5;      /* Celadon */
        font-family: "Poppins", Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        width: 100%;
        max-width: 600px;
        background: #415d43; /* Hunter Green */
        padding: 30px;
        border-radius: 18px;
        border: 1px solid #709775; /* Sage Green */
        box-shadow: 0 0 25px rgba(112, 151, 117, 0.25);
    }

    /* ====== Title ====== */
    h2 {
        text-align: center;
        font-size: 32px;
        margin-bottom: 25px;
        font-weight: 600;
        color: #a1cca5; /* Celadon */
    }

    /* ===== Result Box ===== */
    #result {
        flex: 1;
        background: #111d13; /* Carbon Black */
        padding: 15px;
        border-radius: 10px;
        font-size: 20px;
        letter-spacing: 2px;
        border: 1px solid #709775; /* Sage Green */
        color: #a1cca5; /* Celadon */
    }

    /* ===== Copy Button ===== */
    #copyBtn {
        padding: 12px 15px;
        border: none;
        background: #709775; /* Sage Green */
        color: #111d13; /* Carbon Black text */
        font-weight: bold;
        border-radius: 10px;
        cursor: pointer;
        transition: 0.3s ease;
    }

    #copyBtn:hover {
        transform: scale(1.05);
        background: #8fb996; /* Muted Teal */
        box-shadow: 0 0 12px rgba(143, 185, 150, 0.5);
    }

    /* ===== Range Slider ===== */
    input[type=range] {
        width: 100%;
        height: 6px;
        background: #709775; /* Sage Green */
        border-radius: 5px;
        -webkit-appearance: none;
        cursor: pointer;
    }

    input[type=range]::-webkit-slider-thumb {
        -webkit-appearance: none;
        height: 18px;
        width: 18px;
        background: #a1cca5; /* Celadon */
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 0 8px rgba(161, 204, 165, 0.6);
    }

    /* ===== Checkboxes ===== */
    label {
        font-size: 17px;
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 5px 0;
        color: #a1cca5; /* Celadon */
    }

    input[type=checkbox] {
        transform: scale(1.3);
        accent-color: #8fb996; /* Muted Teal */
    }

    /* ===== Generate Button ===== */
    button[type=submit] {
        margin-top: 10px;
        padding: 14px;
        font-size: 18px;
        border-radius: 12px;
        background: #709775; /* Sage Green */
        border: none;
        cursor: pointer;
        color: #111d13; /* Carbon Black */
        font-weight: 600;
        transition: 0.3s;
        border: 1px solid #8fb996; /* Muted Teal border */
    }

    button[type=submit]:hover {
        transform: scale(1.03);
        background: #8fb996; /* Muted Teal */
        box-shadow: 0 0 10px rgba(143, 185, 150, 0.4);
    }
</style>

</head>

<body>

<div class="container">

    <h2>Générateur de mot de passe</h2>

    <div style="display:flex;align-items:center;gap:10px; margin:10px 0;">
        <div id="result">******</div>

        <button id="copyBtn" type="button">
            📋
        </button>
    </div>

    <form id="form" style="margin-top:20px; display:flex; flex-direction:column; gap:8px;">
        <label style="display:flex;justify-content:space-between; align-items:center;">
            Longueur: <span id="lenVal">12</span>
        </label>

        <input type="range" name="length" id="length" min="4" max="30" value="12">

        <label><input type="checkbox" name="uppercase" checked> Lettres Majuscules</label>
        <label><input type="checkbox" name="lowercase" checked> Lettres Minuscules</label>
        <label><input type="checkbox" name="numbers" checked> Chiffres</label>
        <label><input type="checkbox" name="symbols"> Symboles</label>

        <button type="submit">Générer</button>
    </form>

    <a href="{{ route('secure.index') }}" style="text-decoration: none; color: #a1cca5; margin-top: 20px; display: block; text-align: center">secure</a>

</div>


<script>

    const form = document.getElementById('form');
    const lengthSlider = document.getElementById('length');
    const lenVal = document.getElementById('lenVal');

    lengthSlider.oninput = () => {
        lenVal.textContent = lengthSlider.value;
    };

    form.onsubmit = async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        const response = await fetch('/generate', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        });

        const data = await response.json();
        document.getElementById('result').textContent = data.password;
    };

    const copyBtn = document.getElementById('copyBtn');
    const result = document.getElementById('result');

    copyBtn.onclick = () => {
        const text = result.textContent.trim();

        if (!text || text === '******') return;

        navigator.clipboard.writeText(text).then(() => {
            copyBtn.textContent = "✔️";
            setTimeout(() => copyBtn.textContent = "📋", 1000);
        });
    };

</script>

</body>
</html>
