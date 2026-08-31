# Wizard Pattern &bull; Combr Soluções em Nuvem

[![CI - Wizard Pattern Engine](https://github.com/Viniciusulpicio/wizard-pattern/actions/workflows/ci.yml/badge.svg)](https://github.com/Viniciusulpicio/wizard-pattern/actions/workflows/ci.yml)

> **Uma interface interativa (Multi-step form / Wizard)** desenvolvida em **PHP com Composer (vendor)** para diagnosticar as necessidades de infraestrutura de e-mail de clientes corporativos.
> Inspirada no design system minimalista e refinado do quiz da Manual, adaptada para a identidade e catálogo de serviços da **[Combr Soluções em Nuvem](https://combr.com.br/)**.

---

## 🌐 Live Demo Online (GitHub Pages)

👉 **Acesse o site ao vivo:** [https://viniciusulpicio.github.io/wizard-pattern/](https://viniciusulpicio.github.io/wizard-pattern/)

---

## 🚀 Funcionalidades Principais

1. **Design System & UX Inspirado no Quiz da Manual**:
   - Header fixo com logo SVG da Combr, botão de retorno contextual (`← Voltar`), badge de estimativa (`~2 min`) e **barra de progresso linear contínua**.
   - Cards de seleção interativos (Radio e Checkbox Tiles) com atalhos numéricos (`1` a `9`), indicador de status ativo e descrições técnicas claras.
   - **Zero Friction (Avanço Automático)** em opções de escolha única (transição de 220ms).
   - Modo de **Volume Personalizado** com Sliders dinâmicos e cálculo em tempo real de capacidade total (GB/TB).
   - 100% responsivo para Desktop, Tablet e Mobile.

2. **Motor de Diagnóstico Arquitetural (`DiagnosticEngine`)**:
   - Mapeamento e dimensionamento inteligente de caixas postais e quotas de armazenamento em NVMe.
   - Recomendações personalizadas:
     - **Ambiente Híbrido Inteligente (Combr HybridCloud)**: M365/Google nos postos-chave + Cloud Corporativa Combr (economia de até 70%).
     - **Cloud Corporativa Privada (Zimbra / cPanel Enterprise)**: Soberania nacional e domínio exclusivo.
     - **SaaS Integral Gerenciado**: Microsoft 365 / Google Workspace faturado em BRL com suporte 24x7.
     - **Cluster VPS / AWS Dedicado**: IPs dedicados exclusivos e isolamento total de filas.
   - **Cálculo de Score de Segurança (0 a 100)**: SPF, DKIM (2048 bit), DMARC (`p=quarantine/reject`), TLS 1.3, 2FA/MFA e LGPD.
   - **Continuidade & Backup SaveMail**: Cold storage imutável WORM e Disaster Recovery.
   - **SMTP Transacional**: Dimensionamento para envio de Notas Fiscais (NFe), ERPs e CRMs.

3. **Exportação & Integração de Payload JSON**:
   - **Schema v2.0.0 Padronizado**: Estruturado para consumo direto por APIs de orquestração, equipe de SRE, DevOps ou ERP.
   - **Visualizador Interativo com Abas**:
     - 📦 Payload JSON com syntax highlighting.
     - 🛠️ Variáveis prontas para Playbooks do **Ansible** e módulos do **Terraform**.
     - 🌐 Tabela de apontamentos **DNS recomendados** (MX, SPF, DKIM, DMARC, CNAMEs).
   - **Ações Rápidas**:
     - 📋 Copiar JSON para o Clipboard com 1 clique (feedback toast).
     - 💾 Download do arquivo `.json` de especificação.
     - 🚀 Simulação de disparo de Webhook / Provisioning API (com retorno HTTP 200 Mock).
     - 💬 Envio direto do resumo para consultores no WhatsApp da Combr.

---

## 📂 Estrutura de Diretórios

```
/home/vinicius/temp/wizard-pattern/
├── composer.json                  # Gerenciamento de dependências e autoloading PSR-4
├── composer.lock
├── vendor/                        # Dependências instaladas via Composer
├── .env.example / .env            # Configurações de ambiente e endpoints
├── README.md                      # Documentação técnica do projeto
├── src/
│   ├── Config/
│   │   └── AppConfig.php          # Singleton de configuração e variáveis de ambiente
│   ├── Services/
│   │   ├── QuestionsRepository.php # Catálogo de etapas, perguntas, opções e metadados
│   │   ├── DiagnosticEngine.php    # Motor de avaliação e cálculo de dimensionamento/score
│   │   ├── PayloadBuilder.php      # Construtor do payload JSON padronizado v2.0.0
│   │   └── WebhookDispatcher.php   # Despachante de webhooks para API de provisionamento
│   └── Controllers/
│       ├── HomeController.php      # Renderização da interface web
│       └── ApiController.php       # Endpoints REST (/api/questions, /api/diagnose, /api/dispatch, /api/health)
├── public/
│   ├── index.php                  # Entrypoint com roteamento Bramus\Router
│   └── assets/
│       ├── css/
│       │   └── style.css          # Design System inspirado em Manual + Combr
│       ├── js/
│       │   └── wizard.js          # Motor frontend (estado, navegação, atalhos, cópia, download)
│       └── images/
│           └── logo-combr.svg     # Logotipo SVG da Combr Soluções em Nuvem
├── templates/
│   ├── layout.php                 # Template base HTML (Header, Progresso, Footer)
│   └── wizard.php                 # Panes e componentes interativos das etapas
└── tests/
    └── DiagnosticEngineTest.php   # Testes unitários do motor de diagnóstico e payload
```

---

## 🛠️ Como Executar o Projeto

### Pré-requisitos
- **PHP 8.1+** (Testado no PHP 8.5)
- **Composer**

### 1. Instalação das dependências
```bash
cd /home/vinicius/temp/wizard-pattern
composer install
```

### 2. Iniciar o servidor embutido do PHP
```bash
composer start
# Ou diretamente:
php -S 0.0.0.0:8000 -t public
```
Acesse no navegador: **`http://localhost:8000`**

### 3. Executar os testes automatizados
```bash
composer test
# Ou diretamente:
php tests/DiagnosticEngineTest.php
```

---

## 📡 Endpoints da API REST

| Método | Rota | Descrição |
| :--- | :--- | :--- |
| `GET` | `/api/health` | Status de saúde do serviço e versão do PHP |
| `GET` | `/api/questions` | Lista completa dos steps, perguntas e opções em JSON |
| `POST` | `/api/diagnose` | Recebe as respostas do usuário e retorna o diagnóstico + Payload JSON |
| `POST` | `/api/dispatch` | Simula ou envia o payload gerado para a API de provisionamento |

---

## 📄 Exemplo de Payload JSON Gerado

```json
{
  "$schema": "https://api.combr.com.br/schemas/email-infrastructure-v2.json",
  "meta": {
    "requestId": "REQ-A5C2A6C2-49CD",
    "version": "2.0.0",
    "environment": "production",
    "generator": "Combr Wizard Pattern Diagnostic Engine",
    "generatedAt": "2026-08-29T00:54:19+00:00"
  },
  "customer": {
    "organization": "Acme Logística e Comércio S/A",
    "primaryDomain": "acmelogistica.com.br",
    "technicalContact": {
      "name": "Mariana Silva",
      "email": "mariana@acmelogistica.com.br",
      "phone": "(11) 98765-4321"
    },
    "currentLegacyProvider": "Exchange On-Premise"
  },
  "provisioningSpec": {
    "architecture": {
      "sku": "COMBR-ARCH-HYBRID-V2",
      "name": "Arquitetura Híbrida Inteligente (Combr HybridCloud)",
      "tier": "Enterprise Hybrid",
      "hybridRouting": true
    },
    "sizing": {
      "mailboxCount": 35,
      "storagePerMailboxGB": 25,
      "totalAllocatedStorageGB": 875,
      "storageTier": "NVMe Enterprise High-IOPS"
    },
    "security": {
      "securityScore": 95,
      "protocols": {
        "enforceTls13": true,
        "requireMfa": true,
        "spamWallLayer": "HEURISTIC_AI_GATEWAY"
      }
    }
  }
}
```
