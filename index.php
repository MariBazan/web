<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cuenta Streaming</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .container {
      display: flex;
      gap: 20px;
      justify-content: center;
    }

    .form-container,
    .account-info {
      width: 48%;
    }

    textarea {
      width: 100%;
      height: 200px;
      font-size: 16px;
      padding: 10px;
    }

    button {
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
    }

    input, select {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      font-size: 14px;
    }

    h1, h2 {
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Formulario -->
    <div class="form-container">
      <h1>Cuentas de Streaming</h1>
      <form method="POST" action="">
        <label for="email">Correo:</label>
        <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>

        <label for="profile">Perfil:</label>
        <input type="number" id="profile" name="profile" min="1" max="10" placeholder="Número de perfil" required>

        <label for="account-type">Tipo de cuenta:</label>
        <select id="account-type" name="account-type" required>
          <option value="Flujo TV|40">📺 1 MES FLUJO TV (3 dispositivos): Bs 40</option>
          <option value="Plex|35">🎞️ Plex: Bs 35</option>
          <option value="Netflix|25">🍿 Netflix: Bs 25</option>
          <option value="Prime Video|15">🎥 Prime Video: Bs 15</option>
          <option value="Disney+ Premium|23">✨ Disney+ Premium: Bs 23</option>
          <option value="Max|15">🎬 Max: Bs 15</option>
          <option value="YouTube Premium|20">▶️ YouTube Premium: Bs 20</option>
          <option value="Spotify|25">🎵 Spotify: Bs 25</option>
          <option value="Paramount+|15">🌟 Paramount+: Bs 15</option>
          <option value="Crunchyroll|15">🍥 Crunchyroll: Bs 15</option>
          <option value="ViX|25">📡 ViX: Bs 25</option>
          <option value="Tele Latino|35">🌐 Tele Latino: Bs 35</option>
          <option value="MasTv|30">📡 MasTv: Bs 30</option>
        </select>

        <label for="phone">Número de WhatsApp (Bolivia):</label>
        <input type="tel" id="phone" name="phone" placeholder="Ejemplo: 72512345" pattern="[6-7][0-9]{7}" required>

        <label for="key">Clave:</label>
        <input type="text" id="key" name="key" placeholder="Ingresa la clave" required>

        <button type="submit" name="generate">Generar Cuenta</button>
      </form>
    </div>

    <!-- Información de la cuenta -->
    <?php if (isset($_POST['generate'])): ?>
      <?php
        $mensaje="Buenas, le entregamos sus cuentas, estimado/a.";
        $mensaje1="Esperamos poder servirle nuevamente. ¡Gracias por confiar en nosotros!";
        $email = $_POST['email'];
        $password = $_POST['password'];
        $profile = $_POST['profile'];
        $phone = $_POST['phone'];
        $key = $_POST['key'];
        list($accountType, $price) = explode('|', $_POST['account-type']);

        // Calcula la vigencia (inicio y fin) con el formato correcto
        $startDate = date("d/m/Y");
        $endDate = date("d/m/Y", strtotime("+30 days"));

        // Genera la información de la cuenta
        $accountDetails = "\n$mensaje\n\nCuenta de $accountType:\nCorreo: $email\nContraseña: $password\nPerfil: $profile\n(Si gusta puede colocar su nombre)\nClave: $key\nInicio: $startDate\nFin: $endDate\n¡Listo para disfrutar de $accountType!\n\n$mensaje1";
        
        // Generar enlace de WhatsApp
        $encodedMessage = urlencode($accountDetails);
        $whatsappLink = "https://wa.me/591$phone?text=$encodedMessage";
      ?>
      <div class="account-info">
        <h2>Cuenta Generada:</h2>
        <textarea id="account-details" readonly><?= $accountDetails ?></textarea>
        <button onclick="copyToClipboard()">Copiar Cuenta</button>
        <a href="<?= $whatsappLink ?>" target="_blank" style="display:block; margin-top:10px; text-align:center; text-decoration:none; background-color:green; color:white; padding:10px 15px; border-radius:5px;">Enviar por WhatsApp</a>
      </div>
    <?php endif; ?>
  </div>

  <script>
    function copyToClipboard() {
      const accountDetails = document.getElementById('account-details');
      accountDetails.select();
      accountDetails.setSelectionRange(0, 99999);
      document.execCommand('copy');
      alert('¡Cuenta copiada al portapapeles!');
    }
  </script>
</body>
</html>
