# 📄 Schema do JSON (v2.0.0)

> **Projeto:** Wizard Pattern &bull; Combr Soluções em Nuvem  
> **Categoria:** Requisitos Técnicos Essenciais &bull; Contratos de Dados & Integração  
> **Versão:** 2.0.0

---

## 1. Visão Geral do Schema

O payload JSON gerado pelo **Wizard Pattern** (`PayloadBuilder.php`) segue a especificação padronizada **v2.0.0**. Este documento funciona como um contrato de dados rígido e unificado para:
- APIs de Provisionamento e Orquestração da Nuvem Combr.
- Disparo de Webhooks para sistemas ERP/CRM.
- Execução automatizada de Playbooks do Ansible e Módulos do Terraform pela equipe de SRE / DevOps.

---

## 2. Estrutura Completa do Payload JSON

```json
{
  "$schema": "https://api.combr.com.br/schemas/email-infrastructure-v2.json",
  "meta": {
    "requestId": "REQ-A5C2A6C2-49CD",
    "version": "2.0.0",
    "environment": "production",
    "generator": "Combr Wizard Pattern Diagnostic Engine",
    "generatedAt": "2026-09-01T22:45:00+00:00",
    "expiresAt": "2026-10-01T22:45:00+00:00",
    "source": "web-interactive-wizard"
  },
  "customer": {
    "organization": "Tech Solutions Brasil Ltda",
    "primaryDomain": "techsolutions.com.br",
    "technicalContact": {
      "name": "Carlos Eduardo Silva",
      "email": "carlos@techsolutions.com.br",
      "phone": "(11) 98765-4321"
    },
    "currentLegacyProvider": "cPanel / Hospedagem Compartilhada"
  },
  "provisioningSpec": {
    "architecture": {
      "sku": "COMBR-ARCH-HYBRID-V2",
      "name": "Arquitetura Híbrida Inteligente (Combr HybridCloud)",
      "tier": "Enterprise Hybrid",
      "targetInfrastructure": "AlmaLinux 9 on AWS EC2 / Oracle Cloud (OCI) + Cloudflare Edge",
      "targetOs": "AlmaLinux 9.4 (Hardened)",
      "cloudProvider": "AWS / Oracle Cloud Infrastructure",
      "hybridRouting": true
    },
    "edgeSecurity": {
      "provider": "Cloudflare Enterprise Edge",
      "wafRulesActive": true,
      "antiDdosMitigation": true,
      "rateLimiting": true,
      "dnsSec": true
    },
    "databaseMonitoring": {
      "supportedEngines": ["MySQL", "PostgreSQL"],
      "monitoringEnabled": true,
      "healthCheckInterval": "60s"
    },
    "sizing": {
      "mailboxCount": 35,
      "storagePerMailboxGB": 25,
      "totalAllocatedStorageGB": 875,
      "storageTier": "NVMe Enterprise High-IOPS",
      "autoExpandQuota": true,
      "maxAttachmentSizeMB": 50
    },
    "security": {
      "securityScore": 95,
      "protocols": {
        "enforceTls13": true,
        "requireMfa": true,
        "spamWallLayer": "HEURISTIC_AI_GATEWAY",
        "antivirusEngine": "ClamAV + Combr Commercial Heuristics",
        "lgpdAuditLogs": true
      },
      "dnsRequirements": [
        { "type": "MX", "host": "@", "priority": 10, "value": "mx1.cloudmail.combr.com.br.", "ttl": 3600 },
        { "type": "MX", "host": "@", "priority": 20, "value": "mx2.cloudmail.combr.com.br.", "ttl": 3600 },
        { "type": "TXT", "host": "@", "value": "v=spf1 include:_spf.combr.com.br ~all", "purpose": "SPF Validation" },
        { "type": "TXT", "host": "default._domainkey", "value": "v=DKIM1; k=rsa; p=MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0F9combrKey...", "purpose": "DKIM Cryptographic Signature" },
        { "type": "TXT", "host": "_dmarc", "value": "v=DMARC1; p=quarantine; rua=mailto:dmarc-reports@combr.com.br; pct=100; sp=reject", "purpose": "DMARC Policy Enforcement" },
        { "type": "CNAME", "host": "webmail", "value": "webmail.cloudmail.combr.com.br.", "purpose": "Webmail Interface Access" },
        { "type": "CNAME", "host": "autodiscover", "value": "autodiscover.cloudmail.combr.com.br.", "purpose": "Outlook/Mobile Auto-Configuration" }
      ]
    },
    "backupAndContinuity": {
      "solution": "SaveMail Pro - Backup em Nuvem WORM & Retenção Histórica",
      "retentionDays": 1825,
      "immutableWormStorage": true,
      "geoReplication": true,
      "targetStorageCloud": "Oracle OCI Object Storage / AWS S3 Glacier",
      "sla": {
        "rpoHours": 1,
        "rtoHours": 2,
        "uptimeGuaranteed": "99.95%"
      }
    },
    "smtpRelay": {
      "service": "SMTP Transacional Dedicado (Até 50.000 envios/mês)",
      "monthlyQuota": 50000,
      "dedicatedIpAssigned": true,
      "ipWarmingRequired": false,
      "reputationMonitoring": true,
      "webhookNotifications": true
    }
  },
  "ansibleDirectives": {
    "playbook": "site-mail-provision.yml",
    "extraVars": {
      "domain_name": "techsolutions.com.br",
      "target_os": "almalinux-9",
      "cloud_provider": "aws",
      "mailboxes_qty": 35,
      "quota_gb": 25,
      "enable_savemail": true,
      "enable_spamwall": true,
      "cloudflare_proxied": true,
      "hybrid_split_domain": true
    }
  },
  "terraformPayload": {
    "module": "combr_enterprise_mail_almalinux",
    "variables": {
      "client_id": "techsolutionsbrasilltda",
      "domain": "techsolutions.com.br",
      "os_distro": "almalinux-9",
      "cloud_platform": "oracle_oci",
      "cluster_tier": "combr-arch-hybrid-v2",
      "storage_capacity_gb": 875,
      "dedicated_ips_count": 1,
      "cloudflare_zone_id": "023e105f4ecef8ad9ca31a8372d0c353"
    }
  }
}
```

---

## 3. Dicionário de Dados do Schema

### Bloco `meta` (Metadados da Requisição)
- `requestId` *(string)*: Identificador único da proposta/orquestração (formato: `REQ-XXXX-XXXX`).
- `version` *(string)*: Versão do contrato JSON (ex: `2.0.0`).
- `environment` *(string)*: Ambiente de destino (`production`, `staging`, `sandbox`).
- `generatedAt` *(string)*: Timestamp ISO 8601 da criação.
- `expiresAt` *(string)*: Timestamp de expiração da proposta (geralmente +30 dias).

### Bloco `customer` (Dados da Organização)
- `organization` *(string)*: Razão social ou nome da empresa.
- `primaryDomain` *(string)*: Domínio corporativo sem protocolo (ex: `empresa.com.br`).
- `technicalContact` *(object)*: Contém `name`, `email` e `phone` do responsável de TI.
- `currentLegacyProvider` *(string)*: Provedor atual para roteiro de migração (ex: `cPanel`, `Locaweb`, `M365`).

### Bloco `provisioningSpec` (Especificação Técnica)
- `architecture`: Contém SKU, nome amigável, tier e flag de roteamento híbrido (`hybridRouting`).
- `sizing`: Quantidade total de caixas postais (`mailboxCount`), cota por caixa (`storagePerMailboxGB`) e armazenamento total calculado (`totalAllocatedStorageGB`).
- `security`: `securityScore` calculado (0 a 100), flags de conformidade (`enforceTls13`, `requireMfa`, `spamWallLayer`, `lgpdAuditLogs`) e a tabela completa de apontamentos DNS (`dnsRequirements`).
- `backupAndContinuity`: Nome da solução de contingência, retenção em dias, flag de WORM imutável e SLAs contratuais (`rpoHours`, `rtoHours`, `uptimeGuaranteed`).
- `smtpRelay`: Estratégia de envio transacional para sistemas integrados, quota mensal e flag de IP dedicado.

### Blocos de Automação (`ansibleDirectives` e `terraformPayload`)
- Variáveis mapeadas e pré-formatadas para serem injetadas diretamente em pipelines CI/CD de infraestrutura como código (IaC).
