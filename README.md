# Projeto: Enterprise Mail Setup Wizard (Gerador de Configuração) &bull; Combr Soluções em Nuvem

[![CI - Wizard Pattern Engine](https://github.com/Viniciusulpicio/wizard-pattern/actions/workflows/ci.yml/badge.svg)](https://github.com/Viniciusulpicio/wizard-pattern/actions/workflows/ci.yml)

> **Conceito:** Uma interface interativa (Multi-step form / Wizard) projetada para diagnosticar as necessidades de infraestrutura de e-mail de um cliente corporativo através de uma **curadoria simplificada**. O sistema guia o usuário através de perguntas estratégicas sobre volume, hospedagem e segurança, finalizando com a exportação de um *payload* em JSON pronto para ser consumido por uma API de provisionamento ou equipe de infraestrutura.
> 
> 🏢 **Empresa Parceira:** **[Combr Soluções em Nuvem](https://combr.com.br/)**  
> 🐧 **Sistema Operacional dos Servidores:** **AlmaLinux** (Enterprise Linux estável e de alta segurança)  
> ☁️ **Ferramentas de Nuvem & Infra:** **AWS (Amazon Web Services)** e **Oracle Cloud Infrastructure (OCI)**  
> 🛡️ **Borda & Mitigação de Ataques:** **Cloudflare** (DNS Anycast, WAF, Rate Limiting e Anti-DDoS)  
> 🗄️ **Bancos de Dados Monitorados:** **MySQL** e **PostgreSQL** (para sistemas e sites institucionais)  
> 🌐 **Foco de Atendimento:** Empresas corporativas e sites institucionais (não atende e-commerce)  
> 💾 **Continuidade:** Backup em nuvem de dados e arquivamento WORM (SaveMail Pro)

---

## 🌐 Live Demo Online (GitHub Pages)

👉 **Acesse o protótipo funcional ao vivo:** [https://viniciusulpicio.github.io/wizard-pattern/](https://viniciusulpicio.github.io/wizard-pattern/)

---

## 🏢 Catálogo de Serviços & Contexto Operacional Combr

### 🔹 Serviço Principal: Serviços Gerais Relacionados a E-mails
* **Criação de e-mails profissionais para empresas:** Hospedagem corporativa em nuvem, garantindo soberania nacional, privacidade e alta disponibilidade.
* **Envio de grande volume de e-mails:** Infraestrutura dedicada para disparos em massa e transacionais (relatórios, faturamento, comunicados internos) com gestão ativa de reputação e entregabilidade.
* **Alocação e configuração de servidores:** Preparação e hardening de instâncias em **AlmaLinux** (MTA, Dovecot, Postfix, Zimbra e cPanel Enterprise) na **AWS** e **Oracle Cloud (OCI)**.
* **Monitoramento 24x7 de infraestrutura:** Acompanhamento proativo de métricas de CPU, memória, I/O em storage NVMe e filas de e-mail.
* **Monitoramento de banco de dados:** Sustentação e monitoramento especializado para **MySQL** e **PostgreSQL**.
* **Sites institucionais:** Hospedagem gerenciada e segura para portais institucionais corporativos (sem foco em e-commerce).
* **Backup em nuvem de dados:** Rotinas automatizadas de backup em nuvem e arquivamento imutável de e-mails para fins judiciais e de conformidade.

---

## ⚠️ Dores de Mercado & Soluções da Combr

| Dor do Cliente Corporativo | Solução Proposta pela Combr / Wizard Pattern |
| :--- | :--- |
| **Ataques, phishing e spoofing de domínio:** Tentativas de invasão, ataques de força bruta aos webmails e mensagens forjadas em nome da empresa. | Integração perimetral com **Cloudflare** (WAF, anti-DDoS e rate-limiting) combinada com Gateway Antispam Heurístico com IA e configuração rigorosa de autenticação DNS (**SPF, DKIM 2048-bit, DMARC** e PTR reverso). |
| **Falta de transparência e reporte de atendimento:** Dificuldade em acompanhar o status da infraestrutura, SLA de suporte e saúde das entregas. | **Reporte estruturado ao cliente:** O Wizard emite instantaneamente um diagnóstico transparente com Security Score (0 a 100), volumetria dimensionada, SLAs garantidos e canal direto consultivo via WhatsApp da Combr. |
| **Custos exorbitantes com SaaS puro em dólar:** Faturas caras no Microsoft 365 ou Google Workspace para colaboradores que só precisam de e-mail básico. | **Ambiente Híbrido Inteligente (Combr HybridCloud):** Mantém cargos executivos no M365/Google e equipes operacionais na cloud AlmaLinux Combr, reduzindo custos em até **70%**. |
| **Perda de histórico de e-mails e exigências LGPD:** Risco de perda de mensagens por exclusão acidental ou sequestro de dados por ransomware. | **Backup em Nuvem SaveMail Pro:** Armazenamento externo imutável **WORM** (*Write Once, Read Many*) com retenção de até 5 anos e Disaster Recovery multi-região. |

---

## 💡 Soluções Inovadoras Implementadas

1. **Curadoria Simplificada no Diagnóstico:** Em vez de formulários técnicos burocráticos, o Wizard guia o decisor através de um funil enxuto e intuitivo que traduz necessidades de negócio diretamente em especificações técnicas.
2. **Gerador de Configuração Automatizado (IaC para AlmaLinux):** O diagnóstico compila automaticamente variáveis compatíveis com **Ansible Playbooks** e módulos do **Terraform**, provisionando servidores AlmaLinux na AWS ou Oracle Cloud com um clique.
3. **DNS & Edge Blueprint com Cloudflare:** Geração automática da tabela de apontamentos DNS recomendados, pronta para importação direta na Cloudflare (MX redundante, SPF, DKIM, DMARC, Webmail).
4. **Despacho Assíncrono com Mock de Provisionamento:** Integração pronta para disparo de Webhook para a API oficial de ordens de serviço da Combr.

---

# Requisitos técnicos essenciais

O projeto atende e documenta integralmente os **6 Requisitos Técnicos Essenciais**:

### 1. Mapeamento de arquitetura em nuvem
* **Topologia Modular em 4 Camadas:** Borda com Cloudflare & DNS &bull; Servidores AlmaLinux em nuvem computacional AWS / Oracle OCI &bull; Armazenamento NVMe, Bancos (MySQL/PostgreSQL) e Backup WORM &bull; SMTP Transacional.
* **4 Modelos Arquiteturais Mapeados:**
  1. *Ambiente Híbrido Inteligente* (`COMBR-ARCH-HYBRID-V2`): M365/Google nos postos-chave + Nuvem AlmaLinux Combr (economia de até 70%).
  2. *Cloud Corporativa Privada* (`COMBR-ARCH-PRIVATEMAIL-V2`): Cluster AlmaLinux dedicado Zimbra/cPanel com soberania LGPD em BRL.
  3. *SaaS Integral Gerenciado* (`COMBR-ARCH-SAAS-MANAGED`): 100% Microsoft 365 / Google Workspace faturado em BRL com suporte 24x7.
  4. *Cluster VPS / AWS Dedicado* (`COMBR-ARCH-VPS-DEDICATED`): Instância AlmaLinux em AWS/Oracle com IPs dedicados e filas isoladas.
* 📄 **Documentação detalhada:** [`01-mapeamento-de-arquitetura-em-nuvem.md`](file:///home/vinicius/temp/wizard-pattern/docs/notion/01-mapeamento-de-arquitetura-em-nuvem.md)

### 2. UX/UI
* **Filosofia de Design & Curadoria Simplificada:** Inspirado no quiz da Manual (Manual.co), reduzindo o esforço cognitivo através de cards interativos, tipografia hierárquica e perguntas descomplicadas.
* **Zero Friction (Avanço Automático):** Em perguntas de seleção única, o sistema avança suavemente em 220ms sem requerer clique manual em "Próximo".
* **Navegação Keyboard-First:** Atalhos numéricos (`1` a `9`), `Enter` para avançar e `Esc`/`ArrowLeft` para voltar.
* **Sliders Interativos:** Modo de volume personalizado com cálculo reativo em tempo real de capacidade total (GB/TB).
* 📄 **Documentação detalhada:** [`02-ux-ui.md`](file:///home/vinicius/temp/wizard-pattern/docs/notion/02-ux-ui.md)

### 3. Schema do JSON
* **Contrato Padronizado v2.0.0:** Especificação estruturada em JSON contendo metadados de rastreabilidade (`meta`), dados da empresa (`customer`), especificações técnicas completas (`provisioningSpec` com AlmaLinux, Cloudflare, AWS/Oracle), e diretivas prontas para Ansible e Terraform.
* 📄 **Documentação detalhada:** [`03-schema-do-json.md`](file:///home/vinicius/temp/wizard-pattern/docs/notion/03-schema-do-json.md)

### 4. Wireframes e fluxo
* **Jornada do Usuário em 8 Etapas:** Do Step 0 (Boas-vindas e estimativa) até o Step 7 (Diagnóstico final, JSON Viewer com abas e ações de exportação).
* **Diagrama de Estados Mermaid:** Mapeamento visual das transições, validações e retornos contextuais.
* **Wireframes Conceituais em ASCII:** Detalhamento da anatomia de tela para desktop e mobile.
* 📄 **Documentação detalhada:** [`04-wireframes-e-fluxo.md`](file:///home/vinicius/temp/wizard-pattern/docs/notion/04-wireframes-e-fluxo.md)

### 5. Regras de calculo
* **Dimensionamento de Caixas & Storage:** Fórmula $\text{Total Storage} = \text{Caixas} \times \text{Cota (GB)}$, com conversão inteligente para TB.
* **Algoritmo de Security Score (0 a 100):** Base de 40 pontos com incrementos determinísticos para Autenticação DNS (+20 pts), Gateway Antispam (+20 pts), TLS 1.3 & 2FA (+15 pts) e Logs LGPD (+5 pts).
* **Matriz de SLA e Resiliência:** Mapeamento de RPO (15 min a 48h) e RTO (30 min a 12h) conforme a opção de backup.
* **Quotas de Envio SMTP:** De 5.000 a 500.000+ envios/mês com alocação de IPs aquecidos e monitoramento de reputação.
* 📄 **Documentação detalhada:** [`05-regras-de-calculo.md`](file:///home/vinicius/temp/wizard-pattern/docs/notion/05-regras-de-calculo.md)

### 6. Endpoints
* **API RESTful em PHP 8.1+:** Roteamento com `Bramus\Router`, CORS habilitado e respostas estruturadas em JSON.
* **Rotas Disponíveis:**
  - `GET /api/health` &bull; Verificação de disponibilidade e versão do PHP.
  - `GET /api/questions` &bull; Catálogo completo dos 8 passos e opções do diagnóstico.
  - `POST /api/diagnose` &bull; Processamento das respostas com `DiagnosticEngine` e geração do payload v2.0.0.
  - `POST /api/dispatch` &bull; Simulação ou despacho do payload para webhook de provisionamento.
* 📄 **Documentação detalhada:** [`06-endpoints.md`](file:///home/vinicius/temp/wizard-pattern/docs/notion/06-endpoints.md)

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
