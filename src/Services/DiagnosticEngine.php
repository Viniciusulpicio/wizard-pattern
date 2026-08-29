<?php

declare(strict_types=1);

namespace Combr\Wizard\Services;

class DiagnosticEngine
{
    /**
     * Process wizard answers and generate comprehensive diagnostic metadata.
     */
    public function evaluate(array $answers): array
    {
        $mailboxesChoice = $answers['mailboxes_volume'] ?? 'business';
        $customBoxes = (int)($answers['custom_mailboxes'] ?? 0);
        $customStorageGB = (int)($answers['custom_storage_gb'] ?? 25);
        $architecture = $answers['hosting_architecture'] ?? 'hybrid_cloud';
        $securityItems = is_array($answers['security_compliance'] ?? null) ? $answers['security_compliance'] : ['dns_authentication', 'antispam_gateway', 'tls_2fa'];
        $backupChoice = $answers['backup_continuity'] ?? 'savemail_immutable';
        $smtpChoice = $answers['smtp_volume'] ?? 'smtp_standard';
        $company = $answers['company_details'] ?? [];

        // 1. Calculate Mailbox & Storage Quantities
        $mailboxCount = match ($mailboxesChoice) {
            'starter' => 10,
            'business' => 35,
            'growth' => 120,
            'enterprise' => 450,
            'custom_volume' => max(1, $customBoxes > 0 ? $customBoxes : 50),
            default => 30
        };

        $storagePerBoxGB = match ($mailboxesChoice) {
            'starter' => 15,
            'business' => 25,
            'growth' => 50,
            'enterprise' => 100,
            'custom_volume' => max(5, $customStorageGB > 0 ? $customStorageGB : 25),
            default => 25
        };

        $totalStorageGB = $mailboxCount * $storagePerBoxGB;

        // 2. Architectural Recommendation
        $architectureDetails = match ($architecture) {
            'hybrid_cloud' => [
                'name' => 'Arquitetura Híbrida Inteligente (Combr HybridCloud)',
                'tagline' => 'Produtividade M365/Google nos postos chave + Cloud Corporativa Combr de alta capacidade',
                'sku' => 'COMBR-ARCH-HYBRID-V2',
                'estimatedSavings' => 'Economia de até 68% em relação a 100% M365/Google',
                'tier' => 'Enterprise Hybrid',
                'targetInfrastructure' => 'Multi-Tenant Cloud + M365/GSuite Connector API'
            ],
            'dedicated_cloud' => [
                'name' => 'Cloud Corporativa Privada (Combr PrivateMail Zimbra/cPanel)',
                'tagline' => 'Ambiente exclusivo sob domínio próprio, controle total e soberania dos dados',
                'sku' => 'COMBR-ARCH-PRIVATEMAIL-V2',
                'estimatedSavings' => 'Excelente custo-benefício e independência total de fornecedores estrangeiros',
                'tier' => 'Dedicated Sovereign Cloud',
                'targetInfrastructure' => 'Dedicated Linux Cluster (Equinix / Ascenty SP Data Center)'
            ],
            'saas_pure' => [
                'name' => 'SaaS Integral Gerenciado (Microsoft 365 / Google Workspace)',
                'tagline' => 'Licenciamento oficial com suporte especializado Combr em português e faturamento em BRL',
                'sku' => 'COMBR-ARCH-SAAS-MANAGED',
                'estimatedSavings' => 'Sem surpresas de variação cambial (Dólar/IOF) e gestão técnica inclusa',
                'tier' => 'Full SaaS Managed',
                'targetInfrastructure' => 'Microsoft Azure / Google Cloud Platform + Combr Care 24x7'
            ],
            'vps_dedicated_cluster' => [
                'name' => 'Cluster VPS / AWS Dedicado Exclusivo Gerenciado',
                'tagline' => 'Servidor isolado com IPs dedicados exclusivos e gestão proativa de reputação',
                'sku' => 'COMBR-ARCH-VPS-DEDICATED',
                'estimatedSavings' => 'Isolamento de tráfego e máxima capacidade para operações críticas',
                'tier' => 'Dedicated High-Compute VPS',
                'targetInfrastructure' => 'AWS EC2 / Combr Bare Metal NVMe + Dedicated IP Pool'
            ],
            default => [
                'name' => 'Arquitetura Híbrida Inteligente Combr',
                'tagline' => 'Nuvem corporativa otimizada',
                'sku' => 'COMBR-ARCH-STANDARD',
                'estimatedSavings' => 'Otimização de custos e desempenho',
                'tier' => 'Standard Cloud',
                'targetInfrastructure' => 'Combr Enterprise Cloud'
            ]
        };

        // 3. Security Score and Protocols Matrix
        $securityScore = 40;
        $activeSecurityProtocols = [];

        if (in_array('dns_authentication', $securityItems, true)) {
            $securityScore += 20;
            $activeSecurityProtocols[] = 'SPF (Sender Policy Framework)';
            $activeSecurityProtocols[] = 'DKIM (DomainKeys Identified Mail - 2048 bit)';
            $activeSecurityProtocols[] = 'DMARC (Domain-based Message Authentication - p=quarantine/reject)';
            $activeSecurityProtocols[] = 'PTR / Reverse DNS Dedicado';
        }
        if (in_array('antispam_gateway', $securityItems, true)) {
            $securityScore += 20;
            $activeSecurityProtocols[] = 'Combr SpamWall Heurístico Multi-Layer (99.8% block rate)';
            $activeSecurityProtocols[] = 'Zero-Day Antivirus & Anti-Ransomware Scanner';
        }
        if (in_array('tls_2fa', $securityItems, true)) {
            $securityScore += 15;
            $activeSecurityProtocols[] = 'TLS 1.3 / Enforced SSL com Perfect Forward Secrecy';
            $activeSecurityProtocols[] = 'MFA / 2FA Obrigatório via Aplicativo TOTP';
        }
        if (in_array('lgpd_audit_logs', $securityItems, true)) {
            $securityScore += 5;
            $activeSecurityProtocols[] = 'Trilha de Auditoria LGPD com Logs de Conexão e Acesso (Retenção 12m)';
        }

        $securityScore = min(100, $securityScore);

        // 4. Backup & Disaster Recovery
        $backupDetails = match ($backupChoice) {
            'savemail_immutable' => [
                'name' => 'SaveMail Pro - Arquivamento Imutável & Retenção Histórica (WORM Storage)',
                'retentionDays' => 1825,
                'immutable' => true,
                'complianceReady' => true,
                'drRpoHours' => 1,
                'drRtoHours' => 2
            ],
            'daily_backup_30d' => [
                'name' => 'Backup Automatizado Diário com Retenção de 30 Dias',
                'retentionDays' => 30,
                'immutable' => false,
                'complianceReady' => false,
                'drRpoHours' => 24,
                'drRtoHours' => 4
            ],
            'multi_region_dr' => [
                'name' => 'Alta Disponibilidade com Replicação Multi-Região (Disaster Recovery Ativo)',
                'retentionDays' => 90,
                'immutable' => true,
                'complianceReady' => true,
                'drRpoHours' => 0.25,
                'drRtoHours' => 0.5
            ],
            default => [
                'name' => 'Backup Nativo Padrão de Servidor',
                'retentionDays' => 7,
                'immutable' => false,
                'complianceReady' => false,
                'drRpoHours' => 48,
                'drRtoHours' => 12
            ]
        };

        // 5. SMTP Relay & Transactional Strategy
        $smtpDetails = match ($smtpChoice) {
            'smtp_standard' => [
                'name' => 'SMTP Transacional Dedicado (Até 50.000 envios/mês)',
                'monthlyQuota' => 50000,
                'dedicatedIp' => true,
                'reputationMonitoring' => true,
                'webhooks' => true
            ],
            'smtp_high_volume' => [
                'name' => 'SMTP Alto Volume & Campanhas (500.000+ envios/mês)',
                'monthlyQuota' => 500000,
                'dedicatedIp' => true,
                'ipWarmingService' => true,
                'reputationMonitoring' => true,
                'webhooks' => true
            ],
            'regular_only' => [
                'name' => 'Pool Padrão para E-mails Pessoais / Colaboradores',
                'monthlyQuota' => 5000,
                'dedicatedIp' => false,
                'reputationMonitoring' => true,
                'webhooks' => false
            ],
            default => [
                'name' => 'Dimensionamento Especial por Consultoria Técnica Combr',
                'monthlyQuota' => 20000,
                'dedicatedIp' => true,
                'reputationMonitoring' => true,
                'webhooks' => true
            ]
        };

        // 6. Domain and DNS Directives
        $domain = !empty($company['domain']) ? trim(strtolower($company['domain'])) : 'empresa.com.br';
        $domain = preg_replace('#^https?://#', '', $domain);
        $domain = rtrim($domain, '/');

        $dnsBlueprint = [
            [
                'type' => 'MX',
                'host' => '@',
                'priority' => 10,
                'value' => 'mx1.cloudmail.combr.com.br.',
                'ttl' => 3600
            ],
            [
                'type' => 'MX',
                'host' => '@',
                'priority' => 20,
                'value' => 'mx2.cloudmail.combr.com.br.',
                'ttl' => 3600
            ],
            [
                'type' => 'TXT',
                'host' => '@',
                'value' => 'v=spf1 include:_spf.combr.com.br ~all',
                'ttl' => 3600,
                'purpose' => 'SPF Validation'
            ],
            [
                'type' => 'TXT',
                'host' => 'default._domainkey',
                'value' => 'v=DKIM1; k=rsa; p=MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0F9combrKey...',
                'ttl' => 3600,
                'purpose' => 'DKIM Cryptographic Signature'
            ],
            [
                'type' => 'TXT',
                'host' => '_dmarc',
                'value' => 'v=DMARC1; p=quarantine; rua=mailto:dmarc-reports@combr.com.br; pct=100; sp=reject',
                'ttl' => 3600,
                'purpose' => 'DMARC Policy Enforcement'
            ],
            [
                'type' => 'CNAME',
                'host' => 'webmail',
                'value' => 'webmail.cloudmail.combr.com.br.',
                'ttl' => 3600,
                'purpose' => 'Webmail Interface Access'
            ],
            [
                'type' => 'CNAME',
                'host' => 'autodiscover',
                'value' => 'autodiscover.cloudmail.combr.com.br.',
                'ttl' => 3600,
                'purpose' => 'Outlook/Mobile Auto-Configuration'
            ]
        ];

        return [
            'status' => 'SUCCESS',
            'evaluatedAt' => date('c'),
            'summary' => [
                'mailboxes' => $mailboxCount,
                'storagePerBoxGB' => $storagePerBoxGB,
                'totalStorageGB' => $totalStorageGB,
                'securityScore' => $securityScore,
                'architecture' => $architectureDetails,
                'backup' => $backupDetails,
                'smtp' => $smtpDetails,
                'activeSecurityProtocols' => $activeSecurityProtocols,
                'dnsBlueprint' => $dnsBlueprint,
                'company' => [
                    'name' => $company['company_name'] ?? 'Empresa Corporativa',
                    'domain' => $domain,
                    'contactName' => $company['contact_name'] ?? 'Gestor de TI',
                    'contactEmail' => $company['contact_email'] ?? 'contato@' . $domain,
                    'contactPhone' => $company['contact_phone'] ?? '(11) 99999-9999',
                    'currentProvider' => $company['current_provider'] ?? 'Não informado'
                ]
            ]
        ];
    }
}
