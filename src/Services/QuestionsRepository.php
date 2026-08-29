<?php

declare(strict_types=1);

namespace Combr\Wizard\Services;

class QuestionsRepository
{
    /**
     * Return the complete list of wizard steps with questions, options, and metadata.
     */
    public function getSteps(): array
    {
        return [
            [
                'stepIndex' => 0,
                'id' => 'intro',
                'category' => 'DIAGNÓSTICO CORPORATIVO',
                'title' => 'Vamos fazer algumas perguntas para dimensionar sua infraestrutura de e-mail ideal',
                'subtitle' => 'Descubra a arquitetura perfeita para garantir segurança, alta entregabilidade e até 70% de economia.',
                'type' => 'intro',
                'meta' => [
                    'estimatedTime' => '2 min',
                    'stages' => [
                        [
                            'index' => 1,
                            'title' => 'Volume & Usuários',
                            'time' => '30 seg',
                            'description' => 'Mapeamento de caixas postais e armazenamento'
                        ],
                        [
                            'index' => 2,
                            'title' => 'Arquitetura, Segurança & Backup',
                            'time' => '1 min',
                            'description' => 'Nuvem híbrida, proteção SPF/DKIM/DMARC e SaveMail'
                        ],
                        [
                            'index' => 3,
                            'title' => 'Payload JSON & Provisionamento',
                            'time' => 'Instantâneo',
                            'description' => 'Exportação técnica para API, SRE e equipe de infraestrutura'
                        ]
                    ]
                ]
            ],
            [
                'stepIndex' => 1,
                'id' => 'mailboxes_volume',
                'category' => 'VOLUME & CONTAS',
                'title' => 'Quantas caixas postais corporativas sua empresa precisa atender?',
                'subtitle' => 'Considere tanto e-mails individuais de colaboradores quanto caixas compartilhadas de setores (ex: financeiro@, suporte@, rh@).',
                'type' => 'single_choice',
                'autoAdvance' => true,
                'options' => [
                    [
                        'id' => 'starter',
                        'title' => '1 a 15 Contas',
                        'description' => 'Ideal para pequenas equipes, startups ou escritórios em estruturação.',
                        'badge' => 'Pequena Equipe',
                        'icon' => 'users',
                        'defaultMailboxes' => 10,
                        'defaultStoragePerBoxGB' => 15
                    ],
                    [
                        'id' => 'business',
                        'title' => '16 a 50 Contas',
                        'description' => 'Empresas em expansão que exigem painel administrativo centralizado e suporte ágil.',
                        'badge' => 'PME em Crescimento',
                        'icon' => 'building',
                        'defaultMailboxes' => 30,
                        'defaultStoragePerBoxGB' => 25
                    ],
                    [
                        'id' => 'growth',
                        'title' => '51 a 200 Contas',
                        'description' => 'Médias empresas com múltiplos departamentos e necessidade de segregação de perfil.',
                        'badge' => 'Média Empresa',
                        'icon' => 'layers',
                        'defaultMailboxes' => 100,
                        'defaultStoragePerBoxGB' => 50
                    ],
                    [
                        'id' => 'enterprise',
                        'title' => '201 a 1.000+ Contas',
                        'description' => 'Corporações que demandam cluster dedicado, múltiplos domínios e SLA de 99.9%.',
                        'badge' => 'Enterprise / Corp',
                        'icon' => 'globe',
                        'defaultMailboxes' => 500,
                        'defaultStoragePerBoxGB' => 100
                    ],
                    [
                        'id' => 'custom_volume',
                        'title' => 'Volume Personalizado (Configuração Livre)',
                        'description' => 'Defina a quantidade exata de caixas e o espaço de armazenamento desejado.',
                        'badge' => 'Personalizado',
                        'icon' => 'sliders',
                        'isCustom' => true
                    ]
                ]
            ],
            [
                'stepIndex' => 2,
                'id' => 'hosting_architecture',
                'category' => 'ARQUITETURA & HOSPEDAGEM',
                'title' => 'Qual modelo de arquitetura melhor atende aos objetivos de TI da sua organização?',
                'subtitle' => 'A Combr oferece desde nuvem híbrida com Microsoft/Google até clusters dedicados em data center Tier III no Brasil.',
                'type' => 'single_choice',
                'autoAdvance' => true,
                'options' => [
                    [
                        'id' => 'hybrid_cloud',
                        'title' => 'Ambiente Híbrido Inteligente (Microsoft 365 / Google + Cloud Combr)',
                        'description' => 'Diretoria/VIPs no M365 ou Google Workspace e equipes operacionais na Cloud Corporativa Combr. Reduz a fatura de licenciamento em até 70%.',
                        'badge' => 'Mais Popular & Econômico',
                        'highlight' => true,
                        'icon' => 'git-merge'
                    ],
                    [
                        'id' => 'dedicated_cloud',
                        'title' => 'Cloud Corporativa Dedicada (Zimbra / cPanel Enterprise)',
                        'description' => 'Ambiente 100% sob seu domínio, webmail responsivo, sincronização CalDAV/CardDAV, alta privacidade e conformidade soberana.',
                        'badge' => 'Alta Performance & Soberania',
                        'icon' => 'cloud-rain'
                    ],
                    [
                        'id' => 'saas_pure',
                        'title' => 'Nuvem SaaS Integral (100% Microsoft 365 ou Google Workspace)',
                        'description' => 'Faturamento unificado em BRL (sem surpresas de IOF/Dólar) com suporte técnico premium especializado Combr em português.',
                        'badge' => 'Produtividade M365/Google',
                        'icon' => 'briefcase'
                    ],
                    [
                        'id' => 'vps_dedicated_cluster',
                        'title' => 'Servidor VPS Linux / AWS Dedicado Exclusivo Gerenciado',
                        'description' => 'IPs dedicados exclusivos, controle total de reputação de saída, filas isoladas de e-mail e gestão completa 24x7 por especialistas Combr.',
                        'badge' => 'Isolamento Total / IP Próprio',
                        'icon' => 'server'
                    ]
                ]
            ],
            [
                'stepIndex' => 3,
                'id' => 'security_compliance',
                'category' => 'SEGURANÇA, DNS & REPUTAÇÃO',
                'title' => 'Quais proteções e requisitos de segurança são fundamentais para sua operação?',
                'subtitle' => 'Selecione todas as camadas que sua equipe de segurança da informação e conformidade exigem.',
                'type' => 'multi_choice',
                'autoAdvance' => false,
                'options' => [
                    [
                        'id' => 'dns_authentication',
                        'title' => 'Autenticação DNS Completa (SPF, DKIM, DMARC e PTR / Reverse DNS)',
                        'description' => 'Blindagem essencial contra falsificação de identidade (spoofing) e garantia de que seus e-mails cheguem à Inbox dos destinatários.',
                        'recommended' => true,
                        'icon' => 'shield-check'
                    ],
                    [
                        'id' => 'antispam_gateway',
                        'title' => 'Gateway Antispam e Antivírus Heurístico Corporativo',
                        'description' => 'Filtro em múltiplas camadas que bloqueia 99.8% de spam, anexos maliciosos, ransomware e ataques de phishing antes de atingirem as caixas.',
                        'recommended' => true,
                        'icon' => 'filter'
                    ],
                    [
                        'id' => 'tls_2fa',
                        'title' => 'Criptografia Forte TLS 1.3 + Autenticação em Dois Fatores (2FA / MFA)',
                        'description' => 'Conexões criptografadas de ponta a ponta e dupla autenticação obrigatória via aplicativo TOTP (Google Authenticator / Microsoft Auth).',
                        'recommended' => true,
                        'icon' => 'lock'
                    ],
                    [
                        'id' => 'lgpd_audit_logs',
                        'title' => 'Conformidade LGPD & Trilha de Auditoria com Logs de Acesso',
                        'description' => 'Registro detalhado de conexões, tentativas de login e histórico de entregas para auditorias jurídicas e de compliance.',
                        'recommended' => false,
                        'icon' => 'file-text'
                    ]
                ]
            ],
            [
                'stepIndex' => 4,
                'id' => 'backup_continuity',
                'category' => 'BACKUP & CONTINUIDADE (SAVEMAIL)',
                'title' => 'Qual é a política necessária de retenção histórica e contingência?',
                'subtitle' => 'O SaveMail da Combr garante arquivamento imutável externo contra ataques de ransomware ou exclusões acidentais.',
                'type' => 'single_choice',
                'autoAdvance' => true,
                'options' => [
                    [
                        'id' => 'savemail_immutable',
                        'title' => 'SaveMail Pro - Arquivamento Imutável & Retenção de 1 a 5 Anos',
                        'description' => 'Cópia externa WORM (Write Once, Read Many) inviolável com busca rápida por remetente/data para segurança jurídica e compliance.',
                        'badge' => 'Máxima Proteção & Compliance',
                        'highlight' => true,
                        'icon' => 'archive'
                    ],
                    [
                        'id' => 'daily_backup_30d',
                        'title' => 'Backup Diário Automatizado com Retenção Operacional de 30 Dias',
                        'description' => 'Snapshots diários que permitem restaurar mensagens ou caixas postais inteiras para qualquer ponto dos últimos 30 dias.',
                        'badge' => 'Padrão Recomendado',
                        'icon' => 'database'
                    ],
                    [
                        'id' => 'multi_region_dr',
                        'title' => 'Alta Disponibilidade com Replicação Multi-Região (Disaster Recovery)',
                        'description' => 'Redundância em dois data centers geograficamente distintos com failover automático e SLA de 99.95%.',
                        'badge' => 'Missão Crítica',
                        'icon' => 'refresh-cw'
                    ],
                    [
                        'id' => 'basic_native',
                        'title' => 'Rotina Básica de Backup Local no Servidor',
                        'description' => 'Backup pontual sem retenção histórica em storage externo secundário.',
                        'badge' => 'Básico',
                        'icon' => 'hard-drive'
                    ]
                ]
            ],
            [
                'stepIndex' => 5,
                'id' => 'smtp_volume',
                'category' => 'SMTP TRANSACIONAL & SISTEMAS',
                'title' => 'Sua organização realiza disparos automatizados por sistemas (ERP, CRM, E-commerce)?',
                'subtitle' => 'Separar o fluxo de mensagens de colaboradores do tráfego transacional de sistemas protege a reputação do seu domínio corporativo.',
                'type' => 'single_choice',
                'autoAdvance' => true,
                'options' => [
                    [
                        'id' => 'regular_only',
                        'title' => 'Somente Troca de E-mails Convencionais (Pessoa para Pessoa)',
                        'description' => 'Uso típico corporativo diário entre colaboradores, clientes e fornecedores sem integrações de software em lote.',
                        'badge' => 'Uso Padrão',
                        'icon' => 'mail'
                    ],
                    [
                        'id' => 'smtp_standard',
                        'title' => 'SMTP Transacional Dedicado (Até 50.000 disparos/mês)',
                        'description' => 'Envio seguro de Notas Fiscais (NFe), boletos, notificações de sistemas, recuperação de senhas e alertas de ERP/CRM.',
                        'badge' => 'Integrado a Sistemas',
                        'icon' => 'send'
                    ],
                    [
                        'id' => 'smtp_high_volume',
                        'title' => 'Alto Volume Transacional & Campanhas (50.000 a 500.000+ envios/mês)',
                        'description' => 'Pool de IPs aquecidos dedicados, gerenciamento de bounce, relatórios de entregabilidade em tempo real e Webhooks.',
                        'badge' => 'Alta Escala',
                        'icon' => 'zap'
                    ],
                    [
                        'id' => 'evaluate_later',
                        'title' => 'Não tenho certeza / Dimensionar na consultoria técnica',
                        'description' => 'Os especialistas da Combr analisarão os logs dos seus sistemas atuais para definir a volumetria exata.',
                        'badge' => 'A Definir',
                        'icon' => 'help-circle'
                    ]
                ]
            ],
            [
                'stepIndex' => 6,
                'id' => 'company_details',
                'category' => 'IDENTIFICAÇÃO CORPORATIVA',
                'title' => 'Informe os dados da sua empresa para gerar a especificação técnica final',
                'subtitle' => 'Estes dados serão incorporados ao payload JSON de provisionamento e ao relatório arquitetural de infraestrutura.',
                'type' => 'form_fields',
                'autoAdvance' => false,
                'fields' => [
                    [
                        'id' => 'company_name',
                        'label' => 'Nome da Empresa / Razão Social',
                        'type' => 'text',
                        'placeholder' => 'Ex: Tech Solutions Brasil Ltda',
                        'required' => true
                    ],
                    [
                        'id' => 'domain',
                        'label' => 'Domínio Corporativo Principal',
                        'type' => 'text',
                        'placeholder' => 'Ex: minhamarca.com.br',
                        'required' => true
                    ],
                    [
                        'id' => 'contact_name',
                        'label' => 'Nome do Solicitante / Gestor de TI',
                        'type' => 'text',
                        'placeholder' => 'Ex: Carlos Eduardo Silva',
                        'required' => true
                    ],
                    [
                        'id' => 'contact_email',
                        'label' => 'E-mail Corporativo de Contato',
                        'type' => 'email',
                        'placeholder' => 'Ex: carlos.silva@minhamarca.com.br',
                        'required' => true
                    ],
                    [
                        'id' => 'contact_phone',
                        'label' => 'Telefone / WhatsApp Comercial',
                        'type' => 'tel',
                        'placeholder' => 'Ex: (11) 98765-4321',
                        'required' => true
                    ],
                    [
                        'id' => 'current_provider',
                        'label' => 'Provedor Atual de E-mail (Opcional)',
                        'type' => 'select',
                        'options' => [
                            'cPanel / Hospedagem Compartilhada',
                            'Locaweb / UOLHost / HostGator',
                            'Microsoft 365 (Office 365)',
                            'Google Workspace (G Suite)',
                            'Servidor Exchange On-Premise',
                            'Zimbra Próprio / Linux VPS',
                            'Outro / Domínio Novo'
                        ],
                        'required' => false
                    ]
                ]
            ],
            [
                'stepIndex' => 7,
                'id' => 'diagnosis_result',
                'category' => 'DIAGNÓSTICO & PROVISIONAMENTO',
                'title' => 'Diagnóstico de Infraestrutura Concluído',
                'subtitle' => 'Aqui está a arquitetura recomendada e o payload JSON formatado para consumo por APIs ou equipe de SRE/DevOps.',
                'type' => 'result'
            ]
        ];
    }

    public function getStepByIndex(int $index): ?array
    {
        $steps = $this->getSteps();
        foreach ($steps as $step) {
            if ($step['stepIndex'] === $index) {
                return $step;
            }
        }
        return null;
    }

    public function getTotalSteps(): int
    {
        return count($this->getSteps());
    }
}
