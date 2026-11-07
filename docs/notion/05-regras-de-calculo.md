# 🧮 Regras de Cálculo & Motor de Diagnóstico

> **Projeto:** Wizard Pattern &bull; Combr Soluções em Nuvem  
> **Categoria:** Requisitos Técnicos Essenciais &bull; Lógica de Negócio & Algoritmos  
> **Versão:** 2.0.0

---

## 1. Visão Geral do Motor de Cálculo

O processamento matemático e a tomada de decisão algorítmica são executados pela classe [`DiagnosticEngine.php`](file:///home/vinicius/temp/wizard-pattern/src/Services/DiagnosticEngine.php) no backend PHP, com espelhamento determinístico em JavaScript (`calculateClientSideDiagnosis` em [`wizard.js`](file:///home/vinicius/temp/wizard-pattern/public/assets/js/wizard.js)) para suporte a ambientes estáticos (GitHub Pages).

---

## 2. Regra 1: Dimensionamento de Caixas e Armazenamento

A capacidade de armazenamento total alocada é calculada pela fórmula:

$$\text{Total Storage (GB)} = \text{Mailbox Count} \times \text{Storage Per Box (GB)}$$

### Tabela de Mapeamento por Plano:

| Plano Selecionado (`mailboxes_volume`) | Quantidade de Caixas (`mailboxCount`) | Cota por Caixa (`storagePerBoxGB`) | Armazenamento Total Alocado (`totalStorageGB`) |
| :--- | :---: | :---: | :---: |
| **`starter`** (Pequena Equipe) | 10 contas | 15 GB | **150 GB** |
| **`business`** (PME em Crescimento) | 35 contas | 25 GB | **875 GB** |
| **`growth`** (Média Empresa) | 120 contas | 50 GB | **6.000 GB (6,0 TB)** |
| **`enterprise`** (Corporativo) | 450 contas | 100 GB | **45.000 GB (45,0 TB)** |
| **`custom_volume`** (Sliders Livres) | $\max(1, \text{input\_boxes})$ | $\max(5, \text{input\_storage\_gb})$ | $\text{boxes} \times \text{storage}$ |

> ℹ️ **Conversão Visual:** Valores $\ge 1.000\text{ GB}$ são automaticamente convertidos e exibidos em **Terabytes (TB)** na interface (ex: `1.2 TB Total`).

---

## 3. Regra 2: Algoritmo de Security Score (0 a 100)

O índice de segurança (*Security Score*) mensura o grau de conformidade e blindagem da infraestrutura. O cálculo parte de uma pontuação base de **40 pontos** e acumula pontos conforme os protocolos ativados:

$$\text{SecurityScore} = \min\Big(100,\; 40 + \Delta_{\text{DNS}} + \Delta_{\text{Antispam}} + \Delta_{\text{TLS/MFA}} + \Delta_{\text{LGPD}}\Big)$$

```
[ Base Score: 40 pts ]
       │
       ├── (+) 20 pts ──> dns_authentication (SPF + DKIM 2048-bit + DMARC + PTR)
       │
       ├── (+) 20 pts ──> antispam_gateway (Combr SpamWall Heurístico 99.8% + AV)
       │
       ├── (+) 15 pts ──> tls_2fa (TLS 1.3 Enforce + 2FA/MFA TOTP Obrigatório)
       │
       └── (+) 5 pts  ──> lgpd_audit_logs (Trilha de Auditoria & Retenção 12m)
       │
       ▼
[ Score Final: até 100/100 ]
```

### Matriz de Pontuação e Protocolos Ativados:

| Protocolo / Checkbox | Incremento | Protocolos e Recursos Adicionados ao Diagnóstico |
| :--- | :---: | :--- |
| **`dns_authentication`** | `+20` | &bull; SPF (Sender Policy Framework)<br>&bull; DKIM (DomainKeys Identified Mail - 2048 bit)<br>&bull; DMARC (`p=quarantine/reject`)<br>&bull; PTR / Reverse DNS Dedicado |
| **`antispam_gateway`** | `+20` | &bull; Combr SpamWall Heurístico Multi-Layer (99.8% block rate)<br>&bull; Zero-Day Antivirus & Anti-Ransomware Scanner |
| **`tls_2fa`** | `+15` | &bull; TLS 1.3 / Enforced SSL com Perfect Forward Secrecy<br>&bull; MFA / 2FA Obrigatório via Aplicativo TOTP |
| **`lgpd_audit_logs`** | `+5` | &bull; Trilha de Auditoria LGPD com Logs de Conexão e Acesso (Retenção 12m) |

---

## 4. Regra 3: Política de Backup, Continuidade & SLA

O motor atribui métricas de **RPO** (*Recovery Point Objective*), **RTO** (*Recovery Time Objective*) e tempo de retenção:

| Opção de Backup | Nome do Serviço | Retenção Histórica | RPO | RTO | WORM Imutável |
| :--- | :--- | :---: | :---: | :---: | :---: |
| **`savemail_immutable`** | SaveMail Pro - Arquivamento Imutável | 1.825 dias (5 anos) | **1 hora** | **2 horas** | Sim (WORM) |
| **`daily_backup_30d`** | Backup Diário Automatizado | 30 dias | **24 horas** | **4 horas** | Não |
| **`multi_region_dr`** | Alta Disponibilidade Multi-Região | 90 dias | **15 min** (0.25h) | **30 min** (0.5h) | Sim |
| **`basic_native`** | Backup Nativo de Servidor | 7 dias | **48 horas** | **12 horas** | Não |

---

## 5. Regra 4: Quotas de Envio SMTP Transacional

| Opção Selecionada | Quota Mensal de Envios | IP Dedicado Exclusivo | Monitoramento de Reputação | Webhooks de Eventos |
| :--- | :---: | :---: | :---: | :---: |
| **`regular_only`** | 5.000 envios/mês | Não (Pool compartilhado) | Sim | Não |
| **`smtp_standard`** | 50.000 envios/mês | **Sim** | Sim | **Sim** |
| **`smtp_high_volume`** | 500.000+ envios/mês | **Sim (Pool Aquecido)** | Sim | **Sim** |
| **`evaluate_later`** | 20.000 envios/mês | **Sim** | Sim | **Sim** |

---

## 6. Regra 5: Higienização de Domínio & Geração de Blueprint DNS

A normalização de domínio executa remoção de protocolos e barras residuais:
```php
$domain = !empty($company['domain']) ? trim(strtolower($company['domain'])) : 'empresa.com.br';
$domain = preg_replace('#^https?://#', '', $domain);
$domain = rtrim($domain, '/');
```

Com o domínio saneado, o Blueprint DNS gera registros padrão para MX primário (`priority: 10`), MX secundário (`priority: 20`), SPF include `_spf.combr.com.br`, chave pública DKIM 2048-bit, política DMARC estrita (`p=quarantine; sp=reject`), Webmail e Autodiscover CNAME.
