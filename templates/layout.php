<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wizard Pattern &bull; Diagnóstico Interativo</title>
  <meta name="description" content="Protótipo interativo de diagnóstico de infraestrutura corporativa - Wizard Pattern">
  <link rel="icon" type="image/jpeg" href="/assets/images/wizard-pattern-logo.jpeg">
  
  <!-- Typography: Fraunces (Editorial Display), Plus Jakarta Sans (UI) & JetBrains Mono (Tech) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400..700;1,9..144,400&family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Styles -->
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

  <!-- Sticky Minimal Header (Manual Inspired) -->
  <header class="app-header">
    <div class="header-container">
      <div class="header-left">
        <button id="header-back-btn" class="header-back-btn" aria-label="Voltar etapa" style="visibility: hidden;">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
          </svg>
          <span>Voltar</span>
        </button>
        
        <a href="/" class="header-logo-link">
          <img src="/assets/images/wizard-pattern-logo.jpeg" alt="Wizard Pattern" class="header-logo">
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
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
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
    <div class="footer-copy">&copy; <?= date('Y') ?> <strong>Wizard Pattern</strong> &bull; Protótipo de Diagnóstico Interativo</div>
    <div class="footer-links">
      <a href="#" onclick="restartWizard(); return false;">Reiniciar Questionário</a>
      <span class="footer-dot">&bull;</span>
      <span>Protótipo Funcional</span>
    </div>
  </footer>

  <!-- Toast Container -->
  <div id="toast-container" class="toast-container"></div>

  <!-- Interactive Scripts -->
  <script src="/assets/js/wizard.js"></script>
</body>
</html>
