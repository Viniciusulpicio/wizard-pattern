<?php

declare(strict_types=1);

namespace Combr\Wizard\Services;

use Ramsey\Uuid\Uuid;

class PayloadBuilder
{
    /**
     * Build the standardized JSON payload ready for provisioning APIs, DevOps & infrastructure team.
     */
    public function build(array $answers, array $diagnostic): array
    {
        $requestId = 'REQ-' . strtoupper(substr(Uuid::uuid4()->toString(), 0, 13));
        $summary = $diagnostic['summary'] ?? [];
        $company = $summary['company'] ?? [];
        $domain = $company['domain'] ?? 'empresa.com.br';

        return [
            '$schema' => 'https://api.combr.com.br/schemas/email-infrastructure-v2.json',
            'meta' => [
                'requestId' => $requestId,
                'version' => '2.0.0',
                'environment' => 'production',
                'generator' => 'Combr Wizard Pattern Diagnostic Engine',
                'generatedAt' => date('c'),
                'expiresAt' => date('c', strtotime('+30 days')),
                'source' => 'web-interactive-wizard'
            ],
            'customer' => [
                'organization' => $company['name'] ?? 'Cliente Corporativo',
                'primaryDomain' => $domain,
                'technicalContact' => [
                    'name' => $company['contactName'] ?? 'Gestor de TI',
                    'email' => $company['contactEmail'] ?? 'contato@' . $domain,
                    'phone' => $company['contactPhone'] ?? ''
                ],
                'currentLegacyProvider' => $company['currentProvider'] ?? 'cPanel'
            ],
            'provisioningSpec' => [
                'architecture' => [
                    'sku' => $summary['architecture']['sku'] ?? 'COMBR-ARCH-HYBRID-V2',
                    'name' => $summary['architecture']['name'] ?? 'Arquitetura Híbrida Inteligente',
                    'tier' => $summary['architecture']['tier'] ?? 'Enterprise Hybrid',
                    'targetInfrastructure' => $summary['architecture']['targetInfrastructure'] ?? 'Combr Cloud',
                    'hybridRouting' => ($answers['hosting_architecture'] ?? '') === 'hybrid_cloud'
                ],
                'sizing' => [
                    'mailboxCount' => $summary['mailboxes'] ?? 30,
                    'storagePerMailboxGB' => $summary['storagePerBoxGB'] ?? 25,
                    'totalAllocatedStorageGB' => $summary['totalStorageGB'] ?? 750,
                    'storageTier' => 'NVMe Enterprise High-IOPS',
                    'autoExpandQuota' => true,
                    'maxAttachmentSizeMB' => 50
                ],
                'security' => [
                    'securityScore' => $summary['securityScore'] ?? 95,
                    'protocols' => [
                        'enforceTls13' => true,
                        'requireMfa' => in_array('tls_2fa', $answers['security_compliance'] ?? [], true),
                        'spamWallLayer' => in_array('antispam_gateway', $answers['security_compliance'] ?? [], true) ? 'HEURISTIC_AI_GATEWAY' : 'STANDARD',
                        'antivirusEngine' => 'ClamAV + Combr Commercial Heuristics',
                        'lgpdAuditLogs' => in_array('lgpd_audit_logs', $answers['security_compliance'] ?? [], true)
                    ],
                    'dnsRequirements' => $summary['dnsBlueprint'] ?? []
                ],
                'backupAndContinuity' => [
                    'solution' => $summary['backup']['name'] ?? 'SaveMail Pro',
                    'retentionDays' => $summary['backup']['retentionDays'] ?? 1825,
                    'immutableWormStorage' => $summary['backup']['immutable'] ?? true,
                    'geoReplication' => ($answers['backup_continuity'] ?? '') === 'multi_region_dr',
                    'sla' => [
                        'rpoHours' => $summary['backup']['drRpoHours'] ?? 1,
                        'rtoHours' => $summary['backup']['drRtoHours'] ?? 2,
                        'uptimeGuaranteed' => '99.95%'
                    ]
                ],
                'smtpRelay' => [
                    'service' => $summary['smtp']['name'] ?? 'SMTP Transacional',
                    'monthlyQuota' => $summary['smtp']['monthlyQuota'] ?? 50000,
                    'dedicatedIpAssigned' => $summary['smtp']['dedicatedIp'] ?? true,
                    'ipWarmingRequired' => ($answers['smtp_volume'] ?? '') === 'smtp_high_volume',
                    'reputationMonitoring' => true,
                    'webhookNotifications' => $summary['smtp']['webhooks'] ?? true
                ]
            ],
            'ansibleDirectives' => [
                'playbook' => 'site-mail-provision.yml',
                'extraVars' => [
                    'domain_name' => $domain,
                    'mailboxes_qty' => $summary['mailboxes'] ?? 30,
                    'quota_gb' => $summary['storagePerBoxGB'] ?? 25,
                    'enable_savemail' => ($answers['backup_continuity'] ?? '') === 'savemail_immutable',
                    'enable_spamwall' => in_array('antispam_gateway', $answers['security_compliance'] ?? [], true),
                    'hybrid_split_domain' => ($answers['hosting_architecture'] ?? '') === 'hybrid_cloud'
                ]
            ],
            'terraformPayload' => [
                'module' => 'combr_enterprise_mail',
                'variables' => [
                    'client_id' => strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $company['name'] ?? 'client')),
                    'domain' => $domain,
                    'cluster_tier' => strtolower($summary['architecture']['sku'] ?? 'hybrid'),
                    'storage_capacity_gb' => $summary['totalStorageGB'] ?? 750,
                    'dedicated_ips_count' => ($summary['smtp']['dedicatedIp'] ?? false) ? 1 : 0
                ]
            ]
        ];
    }
}
