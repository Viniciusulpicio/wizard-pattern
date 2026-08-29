<!-- Step 0: Intro & Overview -->
<div class="step-pane active" data-step="0">
  <span class="step-kicker">DIAGNÓSTICO CORPORATIVO</span>
  <h1 class="step-title">Vamos fazer algumas perguntas para dimensionar sua infraestrutura de e-mail ideal</h1>
  <p class="step-subtitle">Descubra a arquitetura perfeita para garantir alta segurança, entregabilidade blindada e até 70% de economia operacional.</p>

  <div class="intro-hero-card">
    <div class="intro-stages-list">
      <div class="intro-stage-item current">
        <div class="stage-number">1</div>
        <div class="stage-content">
          <div class="stage-header-row">
            <div class="stage-title">Volume de Contas & Usuários</div>
            <div class="stage-time">30 seg</div>
          </div>
          <div class="stage-desc">Mapeamento de caixas postais, cotas individuais e armazenamento total.</div>
        </div>
      </div>

      <div class="intro-stage-item">
        <div class="stage-number">2</div>
        <div class="stage-content">
          <div class="stage-header-row">
            <div class="stage-title">Arquitetura, Segurança & Backup</div>
            <div class="stage-time">1 min</div>
          </div>
          <div class="stage-desc">Nuvem híbrida inteligente, autenticação SPF/DKIM/DMARC e SaveMail.</div>
        </div>
      </div>

      <div class="intro-stage-item">
        <div class="stage-number">3</div>
        <div class="stage-content">
          <div class="stage-header-row">
            <div class="stage-title">Payload JSON & Provisionamento</div>
            <div class="stage-time">Instantâneo</div>
          </div>
          <div class="stage-desc">Geração de especificação técnica pronta para consumo por APIs ou equipe de infraestrutura.</div>
        </div>
      </div>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--color-border); padding-top: 1.5rem;">
      <div style="font-size: 0.8125rem; color: var(--color-text-muted);">
        🔒 Diagnóstico confidencial em conformidade com a LGPD
      </div>
      <button class="btn-primary" onclick="startWizard()">
        <span>Iniciar Diagnóstico</span>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <line x1="5" y1="12" x2="19" y2="12"></line>
          <polyline points="12 5 19 12 12 19"></polyline>
        </svg>
      </button>
    </div>
  </div>
</div>

<!-- Step 1: Mailboxes Volume -->
<div class="step-pane" data-step="1">
  <span class="step-kicker">VOLUME & CONTAS</span>
  <h1 class="step-title">Quantas caixas postais corporativas sua organização precisa atender?</h1>
  <p class="step-subtitle">Considere tanto e-mails individuais de colaboradores quanto caixas compartilhadas de departamentos (ex: financeiro@, suporte@, rh@).</p>

  <div class="options-grid">
    <div class="option-card" data-option="starter" onclick="selectSingleOption('mailboxes_volume', 'starter', true)">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">1 a 15 Contas <span class="key-shortcut-pill">1</span></div>
          <span class="option-badge">Pequena Equipe</span>
        </div>
        <div class="option-desc">Ideal para pequenas equipes, consultorias ou escritórios em estruturação (15 GB / conta).</div>
      </div>
    </div>

    <div class="option-card selected" data-option="business" onclick="selectSingleOption('mailboxes_volume', 'business', true)">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">16 a 50 Contas <span class="key-shortcut-pill">2</span></div>
          <span class="option-badge">PME em Crescimento</span>
        </div>
        <div class="option-desc">Empresas em expansão que exigem painel administrativo centralizado e suporte ágil (25 GB / conta).</div>
      </div>
    </div>

    <div class="option-card" data-option="growth" onclick="selectSingleOption('mailboxes_volume', 'growth', true)">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">51 a 200 Contas <span class="key-shortcut-pill">3</span></div>
          <span class="option-badge">Média Empresa</span>
        </div>
        <div class="option-desc">Médias empresas com múltiplos departamentos e necessidade de segregação de perfil (50 GB / conta).</div>
      </div>
    </div>

    <div class="option-card" data-option="enterprise" onclick="selectSingleOption('mailboxes_volume', 'enterprise', true)">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">201 a 1.000+ Contas <span class="key-shortcut-pill">4</span></div>
          <span class="option-badge">Enterprise / Corp</span>
        </div>
        <div class="option-desc">Corporações que demandam cluster dedicado, múltiplos domínios e SLA dedicado (100 GB / conta).</div>
      </div>
    </div>

    <div class="option-card" data-option="custom_volume" onclick="selectSingleOption('mailboxes_volume', 'custom_volume', false)">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">Volume Personalizado (Configuração Livre) <span class="key-shortcut-pill">5</span></div>
          <span class="option-badge">Sliders Livres</span>
        </div>
        <div class="option-desc">Defina a quantidade exata de caixas e o espaço de armazenamento desejado.</div>
      </div>
    </div>
  </div>

  <!-- Custom Volume Interactive Sliders Box -->
  <div id="custom-volume-box" class="custom-volume-box">
    <div class="custom-controls-grid">
      <div class="custom-field-group">
        <div style="display: flex; justify-content: space-between;">
          <span class="custom-label">Quantidade de Caixas Postais</span>
          <span id="custom-mailbox-val" class="range-value-display">50 caixas</span>
        </div>
        <input id="custom-mailbox-slider" type="range" min="5" max="2000" step="5" value="50" class="range-slider">
      </div>

      <div class="custom-field-group">
        <div style="display: flex; justify-content: space-between;">
          <span class="custom-label">Armazenamento por Caixa</span>
          <span id="custom-storage-val" class="range-value-display">25 GB / caixa</span>
        </div>
        <input id="custom-storage-slider" type="range" min="10" max="200" step="5" value="25" class="range-slider">
      </div>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem; border-top: 1px solid var(--color-border); padding-top: 1rem;">
      <div style="font-size: 0.9375rem; font-weight: 700; color: var(--color-text-main);">
        Capacidade Dimensionada: <span id="custom-total-calc" style="color: var(--color-primary);">1.2 TB Total</span>
      </div>
      <button class="btn-primary" onclick="goToStep(2)">
        <span>Confirmar Volume</span>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
      </button>
    </div>
  </div>
</div>

<!-- Step 2: Architecture & Hosting Model -->
<div class="step-pane" data-step="2">
  <span class="step-kicker">ARQUITETURA & HOSPEDAGEM</span>
  <h1 class="step-title">Qual arquitetura melhor se alinha à estratégia de TI da sua empresa?</h1>
  <p class="step-subtitle">A Combr oferece desde nuvem híbrida inteligente até clusters dedicados com soberania total em data center Tier III no Brasil.</p>

  <div class="options-grid">
    <div class="option-card highlight selected" data-option="hybrid_cloud" onclick="selectSingleOption('hosting_architecture', 'hybrid_cloud', true)">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">Ambiente Híbrido Inteligente (Microsoft 365 / Google + Cloud Combr) <span class="key-shortcut-pill">1</span></div>
          <span class="option-badge" style="background: #DBEAFE; color: #1E40AF;">Economia de até 70%</span>
        </div>
        <div class="option-desc">Diretoria e postos chave no M365/Google Workspace e equipes operacionais na Cloud Corporativa Combr de alta capacidade.</div>
      </div>
    </div>

    <div class="option-card" data-option="dedicated_cloud" onclick="selectSingleOption('hosting_architecture', 'dedicated_cloud', true)">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">Cloud Corporativa Dedicada (Zimbra / cPanel Enterprise) <span class="key-shortcut-pill">2</span></div>
          <span class="option-badge">Soberania & Custo Fixo</span>
        </div>
        <div class="option-desc">Ambiente 100% sob seu domínio, webmail moderno, sincronização móvel, alta privacidade e conformidade soberana nacional.</div>
      </div>
    </div>

    <div class="option-card" data-option="saas_pure" onclick="selectSingleOption('hosting_architecture', 'saas_pure', true)">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">Nuvem SaaS Integral (100% Microsoft 365 ou Google Workspace) <span class="key-shortcut-pill">3</span></div>
          <span class="option-badge">Produtividade Total</span>
        </div>
        <div class="option-desc">Faturamento oficial em BRL (sem surpresas de IOF/Dólar) com suporte técnico premium Combr em português 24x7.</div>
      </div>
    </div>

    <div class="option-card" data-option="vps_dedicated_cluster" onclick="selectSingleOption('hosting_architecture', 'vps_dedicated_cluster', true)">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">Cluster VPS / AWS Dedicado Exclusivo Gerenciado <span class="key-shortcut-pill">4</span></div>
          <span class="option-badge">IP Próprio & Isolamento</span>
        </div>
        <div class="option-desc">IPs dedicados exclusivos, controle total de reputação de saída, filas isoladas de e-mail e gestão proativa de infraestrutura.</div>
      </div>
    </div>
  </div>
</div>

<!-- Step 3: Security & Compliance (Multi Select) -->
<div class="step-pane" data-step="3">
  <span class="step-kicker">SEGURANÇA, DNS & REPUTAÇÃO</span>
  <h1 class="step-title">Quais camadas de segurança e conformidade são prioritárias?</h1>
  <p class="step-subtitle">Selecione todos os requisitos técnicos necessários para a proteção e conformidade das comunicações da sua organização.</p>

  <div class="options-grid">
    <div class="option-card multi-choice selected" data-option="dns_authentication" onclick="toggleMultiOption('security_compliance', 'dns_authentication')">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">Autenticação DNS Completa (SPF, DKIM, DMARC e PTR / Reverse DNS) <span class="key-shortcut-pill">1</span></div>
          <span class="option-badge" style="background: #D1FAE5; color: #065F46;">Recomendado</span>
        </div>
        <div class="option-desc">Blindagem contra falsificação de identidade (anti-spoofing) e garantia de máxima entregabilidade na caixa de entrada.</div>
      </div>
    </div>

    <div class="option-card multi-choice selected" data-option="antispam_gateway" onclick="toggleMultiOption('security_compliance', 'antispam_gateway')">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">Gateway Antispam e Antivírus Heurístico Corporativo <span class="key-shortcut-pill">2</span></div>
          <span class="option-badge" style="background: #D1FAE5; color: #065F46;">Recomendado</span>
        </div>
        <div class="option-desc">Filtro em múltiplas camadas que bloqueia 99.8% de spam, anexos maliciosos, ransomware e phishing antes de atingir os usuários.</div>
      </div>
    </div>

    <div class="option-card multi-choice selected" data-option="tls_2fa" onclick="toggleMultiOption('security_compliance', 'tls_2fa')">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">Criptografia TLS 1.3 + Autenticação em Dois Fatores (2FA / MFA) <span class="key-shortcut-pill">3</span></div>
          <span class="option-badge" style="background: #D1FAE5; color: #065F46;">Recomendado</span>
        </div>
        <div class="option-desc">Conexões criptografadas de ponta a ponta e dupla autenticação obrigatória via aplicativo TOTP (Google / Microsoft Authenticator).</div>
      </div>
    </div>

    <div class="option-card multi-choice" data-option="lgpd_audit_logs" onclick="toggleMultiOption('security_compliance', 'lgpd_audit_logs')">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">Conformidade LGPD & Trilha de Auditoria com Logs de Acesso <span class="key-shortcut-pill">4</span></div>
          <span class="option-badge">Auditoria</span>
        </div>
        <div class="option-desc">Registro detalhado de conexões, tentativas de login e histórico de entregas para auditorias jurídicas e conformidade regulatória.</div>
      </div>
    </div>
  </div>

  <div class="wizard-action-bar">
    <div style="font-size: 0.875rem; color: var(--color-text-muted);">
      Você pode selecionar múltiplas opções
    </div>
    <button class="btn-primary" onclick="goToStep(4)">
      <span>Continuar para Backup</span>
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="9 18 15 12 9 6"></polyline>
      </svg>
    </button>
  </div>
</div>

<!-- Step 4: Backup & Continuity (SaveMail) -->
<div class="step-pane" data-step="4">
  <span class="step-kicker">BACKUP & CONTINUIDADE (SAVEMAIL)</span>
  <h1 class="step-title">Qual é a necessidade de retenção histórica e contingência de dados?</h1>
  <p class="step-subtitle">O SaveMail da Combr garante arquivamento imutável externo com busca instantânea contra ataques de ransomware ou exclusões indevidas.</p>

  <div class="options-grid">
    <div class="option-card highlight selected" data-option="savemail_immutable" onclick="selectSingleOption('backup_continuity', 'savemail_immutable', true)">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">SaveMail Pro - Arquivamento Imutável & Retenção de 1 a 5 Anos <span class="key-shortcut-pill">1</span></div>
          <span class="option-badge" style="background: #DBEAFE; color: #1E40AF;">Segurança Jurídica</span>
        </div>
        <div class="option-desc">Cópia externa WORM inviolável com busca ultra-rápida por remetente/data para auditorias legais e proteção total contra perda de dados.</div>
      </div>
    </div>

    <div class="option-card" data-option="daily_backup_30d" onclick="selectSingleOption('backup_continuity', 'daily_backup_30d', true)">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">Backup Automatizado Diário com Retenção de 30 Dias <span class="key-shortcut-pill">2</span></div>
          <span class="option-badge">Padrão Operacional</span>
        </div>
        <div class="option-desc">Snapshots diários que permitem restaurar mensagens ou caixas postais inteiras para qualquer ponto dos últimos 30 dias.</div>
      </div>
    </div>

    <div class="option-card" data-option="multi_region_dr" onclick="selectSingleOption('backup_continuity', 'multi_region_dr', true)">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">Alta Disponibilidade com Replicação Multi-Região (Disaster Recovery) <span class="key-shortcut-pill">3</span></div>
          <span class="option-badge">Missão Crítica</span>
        </div>
        <div class="option-desc">Redundância síncrona em dois data centers geograficamente distintos com failover automático e SLA de 99.95%.</div>
      </div>
    </div>

    <div class="option-card" data-option="basic_native" onclick="selectSingleOption('backup_continuity', 'basic_native', true)">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">Rotina Básica de Backup Local no Servidor <span class="key-shortcut-pill">4</span></div>
          <span class="option-badge">Básico</span>
        </div>
        <div class="option-desc">Backup diário padrão sem retenção histórica em storage externo secundário.</div>
      </div>
    </div>
  </div>
</div>

<!-- Step 5: Transactional SMTP & Systems -->
<div class="step-pane" data-step="5">
  <span class="step-kicker">SMTP TRANSACIONAL & SISTEMAS</span>
  <h1 class="step-title">Sua organização realiza disparos automatizados por sistemas (ERP, CRM, E-commerce)?</h1>
  <p class="step-subtitle">Separar o tráfego corporativo de colaboradores do envio de sistemas em lote protege a reputação do seu domínio.</p>

  <div class="options-grid">
    <div class="option-card" data-option="regular_only" onclick="selectSingleOption('smtp_volume', 'regular_only', true)">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">Somente Troca de E-mails Convencionais (Pessoa para Pessoa) <span class="key-shortcut-pill">1</span></div>
          <span class="option-badge">Uso Padrão</span>
        </div>
        <div class="option-desc">Uso típico corporativo diário entre colaboradores, clientes e fornecedores sem integrações de software em lote.</div>
      </div>
    </div>

    <div class="option-card selected" data-option="smtp_standard" onclick="selectSingleOption('smtp_volume', 'smtp_standard', true)">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">SMTP Transacional Dedicado (Até 50.000 disparos/mês) <span class="key-shortcut-pill">2</span></div>
          <span class="option-badge" style="background: #DBEAFE; color: #1E40AF;">ERP / CRM / NFe</span>
        </div>
        <div class="option-desc">Envio seguro de Notas Fiscais (NFe), boletos bancários, notificações de sistemas, recuperação de senhas e alertas de ERP/CRM.</div>
      </div>
    </div>

    <div class="option-card" data-option="smtp_high_volume" onclick="selectSingleOption('smtp_volume', 'smtp_high_volume', true)">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">Alto Volume Transacional & Campanhas (50.000 a 500.000+ envios/mês) <span class="key-shortcut-pill">3</span></div>
          <span class="option-badge">Alta Escala</span>
        </div>
        <div class="option-desc">Pool de IPs aquecidos dedicados, gerenciamento de bounce, relatórios de entregabilidade em tempo real e Webhooks.</div>
      </div>
    </div>

    <div class="option-card" data-option="evaluate_later" onclick="selectSingleOption('smtp_volume', 'evaluate_later', true)">
      <div class="option-indicator"><div class="option-indicator-inner"></div></div>
      <div class="option-body">
        <div class="option-header-row">
          <div class="option-title">Não tenho certeza / Dimensionar na consultoria técnica <span class="key-shortcut-pill">4</span></div>
          <span class="option-badge">A Definir</span>
        </div>
        <div class="option-desc">Os especialistas da Combr analisarão os logs dos seus sistemas atuais para dimensionar a volumetria exata.</div>
      </div>
    </div>
  </div>
</div>

<!-- Step 6: Company & Domain Details Form -->
<div class="step-pane" data-step="6">
  <span class="step-kicker">IDENTIFICAÇÃO CORPORATIVA</span>
  <h1 class="step-title">Informe os dados da sua empresa para gerar a especificação técnica final</h1>
  <p class="step-subtitle">Estes dados serão incorporados ao payload JSON de provisionamento e ao relatório arquitetural de infraestrutura.</p>

  <form id="company-form" onsubmit="event.preventDefault(); submitCompanyDetails();">
    <div class="form-grid">
      <div class="form-group">
        <label class="form-label" for="input-company-name">Nome da Empresa / Razão Social *</label>
        <input id="input-company-name" type="text" class="form-input" placeholder="Ex: Tech Brasil Soluções Ltda" required>
      </div>

      <div class="form-group">
        <label class="form-label" for="input-domain">Domínio Corporativo Principal *</label>
        <input id="input-domain" type="text" class="form-input" placeholder="Ex: techbrasil.com.br" required>
      </div>

      <div class="form-group">
        <label class="form-label" for="input-contact-name">Nome do Solicitante / Gestor de TI *</label>
        <input id="input-contact-name" type="text" class="form-input" placeholder="Ex: Carlos Eduardo Silva" required>
      </div>

      <div class="form-group">
        <label class="form-label" for="input-contact-email">E-mail Corporativo de Contato *</label>
        <input id="input-contact-email" type="email" class="form-input" placeholder="Ex: carlos.silva@techbrasil.com.br" required>
      </div>

      <div class="form-group">
        <label class="form-label" for="input-contact-phone">Telefone / WhatsApp Comercial *</label>
        <input id="input-contact-phone" type="tel" class="form-input" placeholder="Ex: (11) 98765-4321" required>
      </div>

      <div class="form-group">
        <label class="form-label" for="input-current-provider">Provedor Atual de E-mail</label>
        <select id="input-current-provider" class="form-select">
          <option value="cPanel">cPanel / Hospedagem Compartilhada</option>
          <option value="Locaweb / UOLHost / HostGator">Locaweb / UOLHost / HostGator</option>
          <option value="Microsoft 365">Microsoft 365 (Office 365)</option>
          <option value="Google Workspace">Google Workspace (G Suite)</option>
          <option value="Exchange On-Premise">Exchange On-Premise</option>
          <option value="Zimbra / VPS Próprio">Zimbra / VPS Próprio</option>
          <option value="Domínio Novo">Domínio Novo / Sem Provedor</option>
        </select>
      </div>
    </div>

    <div class="wizard-action-bar">
      <div style="font-size: 0.875rem; color: var(--color-text-muted);">
        * Todos os campos marcados são necessários para a especificação técnica.
      </div>
      <button type="submit" class="btn-primary">
        <span>Gerar Diagnóstico & Payload</span>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <line x1="5" y1="12" x2="19" y2="12"></line>
          <polyline points="12 5 19 12 12 19"></polyline>
        </svg>
      </button>
    </div>
  </form>
</div>

<!-- Step 7: Diagnostic Result & Standardized JSON Payload -->
<div class="step-pane" data-step="7">
  <!-- Loading State -->
  <div id="result-loading" style="display: none; text-align: center; padding: 4rem 1rem;">
    <div style="font-size: 2.5rem; margin-bottom: 1rem; animation: spin 1s linear infinite;">⚙️</div>
    <h2 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 0.5rem;">Processando Diagnóstico Arquitetural...</h2>
    <p style="color: var(--color-text-muted);">Calculando dimensionamento de caixas, matriz de DNS e diretivas de provisionamento.</p>
  </div>

  <!-- Content State -->
  <div id="result-content">
    <div class="result-header-badge">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"></polyline>
      </svg>
      <span>Diagnóstico & Especificação Concluídos</span>
    </div>

    <!-- Spotlight Recommendation Card -->
    <div class="spotlight-card">
      <div class="spotlight-kicker">ARQUITETURA RECOMENDADA PELA COMBR</div>
      <h2 id="diag-arch-title" class="spotlight-title">Arquitetura Híbrida Inteligente (Combr HybridCloud)</h2>
      <p id="diag-arch-tagline" class="spotlight-desc">Produtividade M365/Google nos postos chave + Cloud Corporativa Combr de alta capacidade com redução drástica de custos.</p>

      <div class="spotlight-stats-grid">
        <div class="stat-item">
          <span id="diag-stat-mailboxes" class="stat-value">35 Caixas</span>
          <span class="stat-label">Caixas Postais</span>
        </div>
        <div class="stat-item">
          <span id="diag-stat-storage" class="stat-value">875 GB</span>
          <span class="stat-label">Storage NVMe</span>
        </div>
        <div class="stat-item">
          <span id="diag-stat-security" class="stat-value">95/100</span>
          <span class="stat-label">Score Segurança</span>
        </div>
        <div class="stat-item">
          <span id="diag-stat-sla" class="stat-value">RPO 1h</span>
          <span class="stat-label">Continuidade SaveMail</span>
        </div>
      </div>
    </div>

    <!-- Interactive Tabs (JSON / Ansible / DNS) -->
    <div class="tabs-container">
      <div class="tabs-nav">
        <button class="tab-btn active" data-tab="json" onclick="switchResultTab('json')">
          📦 Payload de Provisionamento (JSON)
        </button>
        <button class="tab-btn" data-tab="ansible" onclick="switchResultTab('ansible')">
          🛠️ Ansible / Terraform Directives
        </button>
        <button class="tab-btn" data-tab="dns" onclick="switchResultTab('dns')">
          🌐 Apontamentos DNS Recomendados
        </button>
      </div>

      <!-- Tab 1: JSON Payload -->
      <div id="tab-json" class="tab-content active">
        <div class="code-viewer-wrapper">
          <div class="code-viewer-header">
            <span class="code-badge">payload.json &bull; Schema v2.0.0</span>
            <div class="code-actions">
              <button class="btn-code-action" onclick="copyJsonPayload()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                  <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                </svg>
                <span>Copiar JSON</span>
              </button>
              <button class="btn-code-action" onclick="downloadJsonPayload()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                  <polyline points="7 10 12 15 17 10"></polyline>
                  <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                <span>Baixar .json</span>
              </button>
            </div>
          </div>
          <pre class="code-block"><code id="json-payload-code">Carregando payload JSON...</code></pre>
        </div>
      </div>

      <!-- Tab 2: Ansible / Terraform -->
      <div id="tab-ansible" class="tab-content">
        <div class="code-viewer-wrapper">
          <div class="code-viewer-header">
            <span class="code-badge">playbook-vars.yml</span>
            <div class="code-actions">
              <button class="btn-code-action" onclick="navigator.clipboard.writeText(document.getElementById('ansible-code').textContent); showToast('Diretivas Ansible copiadas!', 'success');">
                <span>Copiar YAML</span>
              </button>
            </div>
          </div>
          <pre class="code-block"><code id="ansible-code">Carregando variáveis Ansible...</code></pre>
        </div>
      </div>

      <!-- Tab 3: DNS Blueprint -->
      <div id="tab-dns" class="tab-content">
        <div style="overflow-x: auto;">
          <table class="dns-table">
            <thead>
              <tr>
                <th>Tipo</th>
                <th>Host / Nome</th>
                <th>Destino / Valor</th>
                <th>Finalidade & Prioridade</th>
              </tr>
            </thead>
            <tbody id="dns-records-tbody">
              <!-- Dynamically populated -->
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Final Action Buttons -->
    <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: space-between; align-items: center;">
      <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
        <button id="btn-test-dispatch" class="btn-secondary" onclick="testApiDispatch()">
          <span>🚀 Simular Envio para API de Provisionamento</span>
        </button>
        <button class="btn-secondary" onclick="restartWizard()">
          <span>🔄 Refazer Diagnóstico</span>
        </button>
      </div>

      <a id="btn-whatsapp-cta" href="https://wa.me/5511999999999" target="_blank" rel="noopener" class="btn-primary btn-whatsapp" style="text-decoration: none;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
          <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
        </svg>
        <span>Falar com Especialista Combr</span>
      </a>
    </div>
  </div>
</div>
