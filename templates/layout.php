<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($appName) ?></title>
  <meta name="description" content="Diagnóstico interativo de infraestrutura de e-mail corporativo para empresas - Combr Soluções em Nuvem">
  <link rel="icon" type="image/svg+xml" href="/assets/images/logo-combr.svg">
  
  <!-- Typography (Plus Jakarta Sans & JetBrains Mono) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  
  <!-- Styles -->
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

  <!-- Sticky Minimal Header (Manual Inspired) -->
  <header class="app-header">
    <div class="header-container">
      <div class="header-left">
        <button id="header-back-btn" class="header-back-btn" aria-label="Voltar etapa" style="visibility: hidden;">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
          </svg>
          <span>Voltar</span>
        </button>
        
        <a href="/" style="display: flex; align-items: center; text-decoration: none;">
          <img src="/assets/images/logo-combr.svg" alt="Combr Soluções em Nuvem" class="header-logo">
        </a>
      </div>

      <!-- Continuous Linear Progress Bar -->
      <div class="header-center">
        <div class="progress-info">
          <span id="progress-step-text">Início do Diagnóstico</span>
          <span id="progress-target-text">Infraestrutura Corporativa</span>
        </div>
        <div class="progress-bar-track">
          <div id="progress-bar-fill" class="progress-bar-fill" style="width: 5%;"></div>
        </div>
      </div>

      <div class="header-right">
        <div id="time-badge" class="badge-time">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
          <span>~2 min</span>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content Container -->
  <main class="main-wrapper">
    <?php require __DIR__ . '/wizard.php'; ?>
  </main>

  <!-- Footer -->
  <footer class="app-footer">
    <div>&copy; <?= date('Y') ?> <strong><?= htmlspecialchars($companyName) ?></strong> &bull; Infraestrutura, Segurança e Produtividade em Nuvem</div>
    <div class="footer-links">
      <a href="https://combr.com.br" target="_blank" rel="noopener">Portal Oficial</a>
      <a href="https://combr.com.br/suporte" target="_blank" rel="noopener">Suporte & NOC</a>
      <a href="https://combr.com.br/politica-de-privacidade" target="_blank" rel="noopener">LGPD & Privacidade</a>
    </div>
  </footer>

  <!-- Toast Container -->
  <div id="toast-container" class="toast-container"></div>

  <!-- Interactive Scripts -->
  <script src="/assets/js/wizard.js"></script>
</body>
</html>
