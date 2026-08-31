/**
 * Wizard Pattern - Frontend Interactive Engine
 * Inspired by Manual Quiz + Combr Soluções em Nuvem
 */

(function () {
  'use strict';

  // Global State
  const state = {
    currentStepIndex: 0,
    totalSteps: 8, // 0 to 7
    answers: {
      mailboxes_volume: 'business',
      custom_mailboxes: 50,
      custom_storage_gb: 25,
      hosting_architecture: 'hybrid_cloud',
      security_compliance: ['dns_authentication', 'antispam_gateway', 'tls_2fa'],
      backup_continuity: 'savemail_immutable',
      smtp_volume: 'smtp_standard',
      company_details: {
        company_name: '',
        domain: '',
        contact_name: '',
        contact_email: '',
        contact_phone: '',
        current_provider: ''
      }
    },
    diagnosticData: null,
    payloadData: null,
    isSubmitting: false
  };

  // DOM Elements
  const elements = {
    backBtn: document.getElementById('header-back-btn'),
    stepIndicator: document.getElementById('progress-step-text'),
    progressBarFill: document.getElementById('progress-bar-fill'),
    timeBadge: document.getElementById('time-badge'),
    stepPanes: document.querySelectorAll('.step-pane'),
    toastContainer: document.getElementById('toast-container')
  };

  // Initialize
  function init() {
    bindEvents();
    renderStep(0);
  }

  // Bind Listeners
  function bindEvents() {
    // Header Back Button
    if (elements.backBtn) {
      elements.backBtn.addEventListener('click', () => {
        if (state.currentStepIndex > 0) {
          goToStep(state.currentStepIndex - 1);
        }
      });
    }

    // Keyboard Shortcuts (1-9 for options, Enter to proceed)
    window.addEventListener('keydown', (e) => {
      // Don't intercept if typing in an input
      if (['INPUT', 'SELECT', 'TEXTAREA'].includes(document.activeElement?.tagName)) {
        return;
      }

      const activePane = document.querySelector(`.step-pane[data-step="${state.currentStepIndex}"]`);
      if (!activePane) return;

      // Number keys 1-9
      const num = parseInt(e.key, 10);
      if (!isNaN(num) && num >= 1 && num <= 9) {
        const cards = activePane.querySelectorAll('.option-card');
        if (cards[num - 1]) {
          cards[num - 1].click();
        }
      }

      // Enter key
      if (e.key === 'Enter') {
        const primaryBtn = activePane.querySelector('.btn-primary');
        if (primaryBtn && !primaryBtn.disabled) {
          primaryBtn.click();
        }
      }

      // Escape / Backspace / ArrowLeft
      if (e.key === 'ArrowLeft' || e.key === 'Escape') {
        if (state.currentStepIndex > 0 && state.currentStepIndex < 7) {
          goToStep(state.currentStepIndex - 1);
        }
      }
    });

    // Custom Volume Controls
    const mailboxSlider = document.getElementById('custom-mailbox-slider');
    const storageSlider = document.getElementById('custom-storage-slider');
    const mailboxVal = document.getElementById('custom-mailbox-val');
    const storageVal = document.getElementById('custom-storage-val');
    const totalCalcVal = document.getElementById('custom-total-calc');

    function updateCustomCalc() {
      if (!mailboxSlider || !storageSlider) return;
      const boxes = parseInt(mailboxSlider.value, 10);
      const storage = parseInt(storageSlider.value, 10);
      state.answers.custom_mailboxes = boxes;
      state.answers.custom_storage_gb = storage;
      
      if (mailboxVal) mailboxVal.textContent = `${boxes} caixas`;
      if (storageVal) storageVal.textContent = `${storage} GB / caixa`;
      if (totalCalcVal) {
        const totalGB = boxes * storage;
        if (totalGB >= 1000) {
          totalCalcVal.textContent = `${(totalGB / 1000).toFixed(1)} TB Total`;
        } else {
          totalCalcVal.textContent = `${totalGB} GB Total`;
        }
      }
    }

    if (mailboxSlider && storageSlider) {
      mailboxSlider.addEventListener('input', updateCustomCalc);
      storageSlider.addEventListener('input', updateCustomCalc);
      updateCustomCalc();
    }
  }

  // Navigation Logic
  window.goToStep = function(stepIndex) {
    if (stepIndex < 0 || stepIndex >= state.totalSteps) return;

    // Trigger Diagnosis computation when entering Result Step (Step 7)
    if (stepIndex === 7) {
      generateDiagnosisAndPayload();
    }

    state.currentStepIndex = stepIndex;
    renderStep(stepIndex);
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  function renderStep(stepIndex) {
    // Update Panes Visibility
    elements.stepPanes.forEach(pane => {
      const paneStep = parseInt(pane.getAttribute('data-step'), 10);
      if (paneStep === stepIndex) {
        pane.classList.add('active');
      } else {
        pane.classList.remove('active');
      }
    });

    // Update Header Back Button
    if (elements.backBtn) {
      elements.backBtn.style.visibility = stepIndex === 0 ? 'hidden' : 'visible';
    }

    // Update Progress Bar
    const progressPercent = stepIndex === 0 ? 5 : Math.round((stepIndex / (state.totalSteps - 1)) * 100);
    if (elements.progressBarFill) {
      elements.progressBarFill.style.width = `${progressPercent}%`;
    }

    // Update Step Text
    if (elements.stepIndicator) {
      if (stepIndex === 0) {
        elements.stepIndicator.textContent = 'Início do Diagnóstico';
      } else if (stepIndex === 7) {
        elements.stepIndicator.textContent = 'Diagnóstico Finalizado';
      } else {
        elements.stepIndicator.textContent = `Etapa ${stepIndex} de ${state.totalSteps - 2}`;
      }
    }
  }

  // Handle Single Choice Selection
  window.selectSingleOption = function (stepId, optionId, autoAdvance = true) {
    state.answers[stepId] = optionId;

    const activePane = document.querySelector(`.step-pane[data-step="${state.currentStepIndex}"]`);
    if (activePane) {
      const cards = activePane.querySelectorAll('.option-card');
      cards.forEach(card => {
        if (card.getAttribute('data-option') === optionId) {
          card.classList.add('selected');
        } else {
          card.classList.remove('selected');
        }
      });
    }

    // Toggle Custom Volume Box if selected
    if (stepId === 'mailboxes_volume') {
      const customBox = document.getElementById('custom-volume-box');
      if (customBox) {
        if (optionId === 'custom_volume') {
          customBox.classList.add('active');
          return; // Don't auto-advance on custom mode
        } else {
          customBox.classList.remove('active');
        }
      }
    }

    if (autoAdvance) {
      setTimeout(() => {
        goToStep(state.currentStepIndex + 1);
      }, 220);
    }
  };

  // Handle Multi Choice Selection (Security & Compliance)
  window.toggleMultiOption = function (stepId, optionId) {
    if (!Array.isArray(state.answers[stepId])) {
      state.answers[stepId] = [];
    }

    const arr = state.answers[stepId];
    const idx = arr.indexOf(optionId);
    if (idx > -1) {
      arr.splice(idx, 1);
    } else {
      arr.push(optionId);
    }

    const activePane = document.querySelector(`.step-pane[data-step="${state.currentStepIndex}"]`);
    if (activePane) {
      const targetCard = activePane.querySelector(`.option-card[data-option="${optionId}"]`);
      if (targetCard) {
        if (arr.includes(optionId)) {
          targetCard.classList.add('selected');
        } else {
          targetCard.classList.remove('selected');
        }
      }
    }
  };

  // Form Submission (Company Details)
  window.submitCompanyDetails = function () {
    const form = document.getElementById('company-form');
    if (!form) {
      goToStep(7);
      return;
    }

    const companyName = document.getElementById('input-company-name')?.value.trim() || 'Minha Empresa Ltda';
    const domain = document.getElementById('input-domain')?.value.trim() || 'empresa.com.br';
    const contactName = document.getElementById('input-contact-name')?.value.trim() || 'Gestor de TI';
    const contactEmail = document.getElementById('input-contact-email')?.value.trim() || `contato@${domain}`;
    const contactPhone = document.getElementById('input-contact-phone')?.value.trim() || '(11) 98765-4321';
    const currentProvider = document.getElementById('input-current-provider')?.value || 'cPanel';

    state.answers.company_details = {
      company_name: companyName,
      domain: domain,
      contact_name: contactName,
      contact_email: contactEmail,
      contact_phone: contactPhone,
      current_provider: currentProvider
    };

    goToStep(7);
  };

  // Generate Diagnosis & Standardized JSON Payload
  
  // Client-side fallback engine for static hosting (e.g. GitHub Pages)
  function calculateClientSideDiagnosis(answers) {
    const mailboxesChoice = answers.mailboxes_volume || 'business';
    const customBoxes = parseInt(answers.custom_mailboxes || 0, 10);
    const customStorageGB = parseInt(answers.custom_storage_gb || 25, 10);
    const architecture = answers.hosting_architecture || 'hybrid_cloud';
    const securityItems = Array.isArray(answers.security_compliance) ? answers.security_compliance : ['dns_authentication', 'antispam_gateway', 'tls_2fa'];
    const backupChoice = answers.backup_continuity || 'savemail_immutable';
    const smtpChoice = answers.smtp_volume || 'smtp_standard';
    const company = answers.company_details || {};

    let mailboxCount = 35;
    let storagePerBoxGB = 25;
    if (mailboxesChoice === 'starter') { mailboxCount = 10; storagePerBoxGB = 15; }
    else if (mailboxesChoice === 'business') { mailboxCount = 35; storagePerBoxGB = 25; }
    else if (mailboxesChoice === 'growth') { mailboxCount = 120; storagePerBoxGB = 50; }
    else if (mailboxesChoice === 'enterprise') { mailboxCount = 450; storagePerBoxGB = 100; }
    else if (mailboxesChoice === 'custom_volume') {
      mailboxCount = customBoxes > 0 ? customBoxes : 50;
      storagePerBoxGB = customStorageGB > 0 ? customStorageGB : 25;
    }
    const totalStorageGB = mailboxCount * storagePerBoxGB;

    let archName = 'Arquitetura Híbrida Inteligente (Combr HybridCloud)';
    let archTagline = 'Produtividade M365/Google nos postos chave + Cloud Corporativa Combr de alta capacidade';
    let archSku = 'COMBR-ARCH-HYBRID-V2';
    let archSavings = 'Economia de até 68% em relação a 100% M365/Google';
    let archTier = 'Enterprise Hybrid';

    if (architecture === 'dedicated_cloud') {
      archName = 'Cloud Corporativa Privada (Combr PrivateMail Zimbra/cPanel)';
      archTagline = 'Ambiente exclusivo sob domínio próprio, controle total e soberania dos dados';
      archSku = 'COMBR-ARCH-PRIVATEMAIL-V2';
      archSavings = 'Excelente custo-benefício e independência total de fornecedores estrangeiros';
      archTier = 'Dedicated Sovereign Cloud';
    } else if (architecture === 'saas_pure') {
      archName = 'SaaS Integral Gerenciado (Microsoft 365 / Google Workspace)';
      archTagline = 'Licenciamento oficial com suporte especializado Combr em português e faturamento em BRL';
      archSku = 'COMBR-ARCH-SAAS-MANAGED';
      archSavings = 'Sem surpresas de variação cambial (Dólar/IOF) e gestão técnica inclusa';
      archTier = 'Full SaaS Managed';
    } else if (architecture === 'vps_dedicated_cluster') {
      archName = 'Cluster VPS / AWS Dedicado Exclusivo Gerenciado';
      archTagline = 'Servidor isolado com IPs dedicados exclusivos e gestão proativa de reputação';
      archSku = 'COMBR-ARCH-VPS-DEDICATED';
      archSavings = 'Isolamento de tráfego e máxima capacidade para operações críticas';
      archTier = 'Dedicated High-Compute VPS';
    }

    let securityScore = 40;
    const activeProtocols = [];
    if (securityItems.includes('dns_authentication')) {
      securityScore += 20;
      activeProtocols.push('SPF', 'DKIM (2048 bit)', 'DMARC', 'PTR / Reverse DNS');
    }
    if (securityItems.includes('antispam_gateway')) {
      securityScore += 20;
      activeProtocols.push('Combr SpamWall Heurístico (99.8% block rate)', 'Zero-Day Antivirus');
    }
    if (securityItems.includes('tls_2fa')) {
      securityScore += 15;
      activeProtocols.push('TLS 1.3 Enforced SSL', 'MFA / 2FA Obrigatório TOTP');
    }
    if (securityItems.includes('lgpd_audit_logs')) {
      securityScore += 5;
      activeProtocols.push('Trilha de Auditoria LGPD');
    }
    securityScore = Math.min(100, securityScore);

    let backupName = 'SaveMail Pro - Arquivamento Imutável & Retenção Histórica (WORM)';
    let retentionDays = 1825;
    let rpoHours = 1;
    if (backupChoice === 'daily_backup_30d') {
      backupName = 'Backup Diário com Retenção de 30 Dias';
      retentionDays = 30;
      rpoHours = 24;
    } else if (backupChoice === 'multi_region_dr') {
      backupName = 'Alta Disponibilidade Multi-Região (Disaster Recovery)';
      retentionDays = 90;
      rpoHours = 0.25;
    }

    let smtpName = 'SMTP Transacional Dedicado (Até 50.000 envios/mês)';
    let smtpQuota = 50000;
    if (smtpChoice === 'smtp_high_volume') {
      smtpName = 'SMTP Alto Volume & Campanhas (500.000+ envios/mês)';
      smtpQuota = 500000;
    } else if (smtpChoice === 'regular_only') {
      smtpName = 'Pool Padrão para Colaboradores';
      smtpQuota = 5000;
    }

    const domain = (company.domain || 'empresa.com.br').replace(/^https?:///, '').replace(//$/, '');
    const requestId = 'REQ-' + Math.random().toString(36).substring(2, 8).toUpperCase() + '-' + Math.random().toString(36).substring(2, 6).toUpperCase();

    const dnsBlueprint = [
      { type: 'MX', host: '@', priority: 10, value: 'mx1.cloudmail.combr.com.br.', ttl: 3600 },
      { type: 'MX', host: '@', priority: 20, value: 'mx2.cloudmail.combr.com.br.', ttl: 3600 },
      { type: 'TXT', host: '@', value: 'v=spf1 include:_spf.combr.com.br ~all', purpose: 'SPF Validation' },
      { type: 'TXT', host: 'default._domainkey', value: 'v=DKIM1; k=rsa; p=MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0F9combrKey...', purpose: 'DKIM Cryptographic Signature' },
      { type: 'TXT', host: '_dmarc', value: 'v=DMARC1; p=quarantine; rua=mailto:dmarc-reports@combr.com.br; pct=100; sp=reject', purpose: 'DMARC Policy Enforcement' },
      { type: 'CNAME', host: 'webmail', value: 'webmail.cloudmail.combr.com.br.', purpose: 'Webmail Interface Access' },
      { type: 'CNAME', host: 'autodiscover', value: 'autodiscover.cloudmail.combr.com.br.', purpose: 'Outlook/Mobile Auto-Configuration' }
    ];

    const diagnostic = {
      status: 'SUCCESS',
      summary: {
        mailboxes: mailboxCount,
        storagePerBoxGB: storagePerBoxGB,
        totalStorageGB: totalStorageGB,
        securityScore: securityScore,
        architecture: {
          name: archName,
          tagline: archTagline,
          sku: archSku,
          estimatedSavings: archSavings,
          tier: archTier
        },
        backup: {
          name: backupName,
          retentionDays: retentionDays,
          drRpoHours: rpoHours
        },
        smtp: {
          name: smtpName,
          monthlyQuota: smtpQuota,
          dedicatedIp: true,
          webhooks: true
        },
        activeSecurityProtocols: activeProtocols,
        dnsBlueprint: dnsBlueprint,
        company: {
          name: company.company_name || 'Empresa Corporativa',
          domain: domain,
          contactName: company.contact_name || 'Gestor de TI',
          contactEmail: company.contact_email || ('contato@' + domain),
          contactPhone: company.contact_phone || '(11) 98765-4321',
          currentProvider: company.current_provider || 'cPanel'
        }
      }
    };

    const payload = {
      '$schema': 'https://api.combr.com.br/schemas/email-infrastructure-v2.json',
      meta: {
        requestId: requestId,
        version: '2.0.0',
        environment: 'production',
        generator: 'Combr Wizard Pattern Diagnostic Engine',
        generatedAt: new Date().toISOString(),
        source: 'web-interactive-wizard'
      },
      customer: {
        organization: company.company_name || 'Cliente Corporativo',
        primaryDomain: domain,
        technicalContact: {
          name: company.contact_name || 'Gestor de TI',
          email: company.contact_email || ('contato@' + domain),
          phone: company.contact_phone || ''
        },
        currentLegacyProvider: company.current_provider || 'cPanel'
      },
      provisioningSpec: {
        architecture: {
          sku: archSku,
          name: archName,
          tier: archTier,
          hybridRouting: architecture === 'hybrid_cloud'
        },
        sizing: {
          mailboxCount: mailboxCount,
          storagePerMailboxGB: storagePerBoxGB,
          totalAllocatedStorageGB: totalStorageGB,
          storageTier: 'NVMe Enterprise High-IOPS'
        },
        security: {
          securityScore: securityScore,
          protocols: {
            enforceTls13: true,
            requireMfa: securityItems.includes('tls_2fa'),
            spamWallLayer: securityItems.includes('antispam_gateway') ? 'HEURISTIC_AI_GATEWAY' : 'STANDARD'
          },
          dnsRequirements: dnsBlueprint
        },
        backupAndContinuity: {
          solution: backupName,
          retentionDays: retentionDays,
          immutableWormStorage: backupChoice === 'savemail_immutable'
        }
      },
      ansibleDirectives: {
        playbook: 'site-mail-provision.yml',
        extraVars: {
          domain_name: domain,
          mailboxes_qty: mailboxCount,
          quota_gb: storagePerBoxGB,
          enable_savemail: backupChoice === 'savemail_immutable',
          enable_spamwall: securityItems.includes('antispam_gateway'),
          hybrid_split_domain: architecture === 'hybrid_cloud'
        }
      },
      terraformPayload: {
        module: 'combr_enterprise_mail',
        variables: {
          client_id: (company.company_name || 'client').toLowerCase().replace(/[^a-z0-9]/g, ''),
          domain: domain,
          cluster_tier: archSku.toLowerCase(),
          storage_capacity_gb: totalStorageGB,
          dedicated_ips_count: 1
        }
      }
    };

    return { diagnostic, payload };
  }

  async function generateDiagnosisAndPayload() {
    const resultLoading = document.getElementById('result-loading');
    const resultContent = document.getElementById('result-content');

    if (resultLoading) resultLoading.style.display = 'block';
    if (resultContent) resultContent.style.display = 'none';

    try {
      try {
        const response = await fetch('/api/diagnose', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ answers: state.answers })
        });
        if (response.ok) {
          const data = await response.json();
          if (data.status === 'SUCCESS') {
            state.diagnosticData = data.diagnostic;
            state.payloadData = data.payload;
            renderResultsView();
            return;
          }
        }
      } catch (e) {}

      // Seamless fallback for GitHub Pages (Static hosting)
      const fallback = calculateClientSideDiagnosis(state.answers);
      state.diagnosticData = fallback.diagnostic;
      state.payloadData = fallback.payload;
      renderResultsView();
    } catch (err) {
      console.error('Diagnosis API error:', err);
      showToast('Falha na comunicação com o servidor.', 'error');
    } finally {
      if (resultLoading) resultLoading.style.display = 'none';
      if (resultContent) resultContent.style.display = 'block';
    }
  }

  // Render Result Cards and Payload Tabs
  function renderResultsView() {
    const diag = state.diagnosticData?.summary;
    const payload = state.payloadData;
    if (!diag || !payload) return;

    // Update Spotlight Card
    const titleEl = document.getElementById('diag-arch-title');
    const taglineEl = document.getElementById('diag-arch-tagline');
    const savingsEl = document.getElementById('diag-arch-savings');
    const mailboxesEl = document.getElementById('diag-stat-mailboxes');
    const storageEl = document.getElementById('diag-stat-storage');
    const securityScoreEl = document.getElementById('diag-stat-security');
    const drSlaEl = document.getElementById('diag-stat-sla');

    if (titleEl) titleEl.textContent = diag.architecture.name;
    if (taglineEl) taglineEl.textContent = diag.architecture.tagline;
    if (savingsEl) savingsEl.textContent = diag.architecture.estimatedSavings;
    if (mailboxesEl) mailboxesEl.textContent = `${diag.mailboxes} Caixas`;
    if (storageEl) storageEl.textContent = `${diag.totalStorageGB >= 1000 ? (diag.totalStorageGB / 1000).toFixed(1) + ' TB' : diag.totalStorageGB + ' GB'}`;
    if (securityScoreEl) securityScoreEl.textContent = `${diag.securityScore}/100`;
    if (drSlaEl) drSlaEl.textContent = diag.backup.drRpoHours ? `RPO ${diag.backup.drRpoHours}h` : '99.95%';

    // Populate JSON Code Viewers
    const jsonCodeBlock = document.getElementById('json-payload-code');
    if (jsonCodeBlock) {
      jsonCodeBlock.textContent = JSON.stringify(payload, null, 2);
    }

    const ansibleCodeBlock = document.getElementById('ansible-code');
    if (ansibleCodeBlock) {
      const ansibleYaml = `# Ansible Mail Provisioning Playbook Directives
# Auto-generated by Combr Wizard Pattern (${payload.meta.requestId})
---
- hosts: mail_clusters
  vars:
    domain_name: "${diag.company.domain}"
    mailboxes_quantity: ${diag.mailboxes}
    storage_quota_gb: ${diag.storagePerBoxGB}
    architecture_sku: "${diag.architecture.sku}"
    enable_savemail_worm: ${payload.ansibleDirectives.extraVars.enable_savemail ? 'true' : 'false'}
    enable_ai_spamwall: ${payload.ansibleDirectives.extraVars.enable_spamwall ? 'true' : 'false'}
    enforce_tls_13: true
    dkim_selector: "default"
  roles:
    - combr.cloudmail.provisioning
    - combr.security.spamwall
    - combr.savemail.archiver`;
      ansibleCodeBlock.textContent = ansibleYaml;
    }

    // Populate DNS Table
    const dnsTbody = document.getElementById('dns-records-tbody');
    if (dnsTbody && Array.isArray(diag.dnsBlueprint)) {
      dnsTbody.innerHTML = diag.dnsBlueprint.map(record => `
        <tr>
          <td><span class="dns-type-badge">${record.type}</span></td>
          <td><code>${record.host}</code></td>
          <td style="font-family: var(--font-mono); font-size: 0.8125rem; word-break: break-all;">${record.value}</td>
          <td>${record.purpose || (record.priority ? `Prioridade ${record.priority}` : 'DNS Padrão')}</td>
        </tr>
      `).join('');
    }

    // Update WhatsApp CTA Link
    const waBtn = document.getElementById('btn-whatsapp-cta');
    if (waBtn) {
      const msg = encodeURIComponent(
        `Olá Combr Soluções em Nuvem! Concluí o diagnóstico de infraestrutura de e-mail no Wizard Pattern.\n\n` +
        `🏢 *Empresa:* ${diag.company.name} (${diag.company.domain})\n` +
        `📦 *Plano Recomendado:* ${diag.architecture.name}\n` +
        `👥 *Caixas:* ${diag.mailboxes} | *Storage:* ${diag.totalStorageGB} GB\n` +
        `🛡️ *Score de Segurança:* ${diag.securityScore}/100\n` +
        `🆔 *ID da Especificação:* ${payload.meta.requestId}\n\n` +
        `Gostaria de falar com um especialista sobre o provisionamento.`
      );
      waBtn.href = `https://wa.me/5511999999999?text=${msg}`;
    }
  }

  // Switch Tabs in Result Screen
  window.switchResultTab = function (tabId) {
    document.querySelectorAll('.tab-btn').forEach(btn => {
      if (btn.getAttribute('data-tab') === tabId) {
        btn.classList.add('active');
      } else {
        btn.classList.remove('active');
      }
    });

    document.querySelectorAll('.tab-content').forEach(content => {
      if (content.id === `tab-${tabId}`) {
        content.classList.add('active');
      } else {
        content.classList.remove('active');
      }
    });
  };

  // Copy JSON Payload to Clipboard
  window.copyJsonPayload = function () {
    if (!state.payloadData) return;
    const jsonStr = JSON.stringify(state.payloadData, null, 2);
    navigator.clipboard.writeText(jsonStr).then(() => {
      showToast('Payload JSON copiado para a área de transferência!', 'success');
    }).catch(() => {
      showToast('Não foi possível copiar automaticamente.', 'error');
    });
  };

  // Download JSON Payload File
  window.downloadJsonPayload = function () {
    if (!state.payloadData) return;
    const jsonStr = JSON.stringify(state.payloadData, null, 2);
    const blob = new Blob([jsonStr], { type: 'application/json' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `combr-email-spec-${state.payloadData.meta.requestId}.json`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
    showToast('Arquivo JSON baixado com sucesso!', 'success');
  };

  // Test Provisioning API Webhook Dispatch (Simulation)
  window.testApiDispatch = async function () {
    const btn = document.getElementById('btn-test-dispatch');
    if (btn) {
      btn.disabled = true;
      btn.innerHTML = '<span class="spinner"></span> Enviando Payload...';
    }

    try {
      const response = await fetch('/api/dispatch', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          payload: state.payloadData,
          simulate: true
        })
      });

      const resData = await response.json();
      if (resData.status.startsWith('DISPATCHED')) {
        showToast(`API Response HTTP ${resData.statusCode}: Ordem enfileirada no cluster!`, 'success');
      } else {
        showToast('Payload processado com sucesso.', 'info');
      }
    } catch (err) {
      showToast('Erro ao testar envio para API.', 'error');
    } finally {
      if (btn) {
        btn.disabled = false;
        btn.innerHTML = '🚀 Simular Envio para API de Provisionamento';
      }
    }
  };

  // Restart Wizard
  window.restartWizard = function () {
    goToStep(0);
  };

  // Toast Notification Helper
  function showToast(message, type = 'info') {
    if (!elements.toastContainer) return;
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
      <span style="font-size: 1.1rem;">${type === 'success' ? '✅' : type === 'error' ? '⚠️' : 'ℹ️'}</span>
      <span>${message}</span>
    `;
    elements.toastContainer.appendChild(toast);

    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateY(10px)';
      toast.style.transition = 'all 200ms ease';
      setTimeout(() => toast.remove(), 200);
    }, 3500);
  }

  // Public helper to start wizard
  window.startWizard = function () {
    goToStep(1);
  };

  // Run on DOM Ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
