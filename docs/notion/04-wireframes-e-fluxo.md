# 📐 Wireframes e Fluxo de Navegação

> **Projeto:** Wizard Pattern &bull; Combr Soluções em Nuvem  
> **Categoria:** Requisitos Técnicos Essenciais &bull; Arquitetura de Informação & Wireframes  
> **Versão:** 2.0.0

---

## 1. Diagrama de Fluxo de Estados (User Journey)

O fluxo do usuário é composto por 8 etapas (Step 0 ao 7), organizadas de forma linear e progressiva para maximizar a conversão e precisão do diagnóstico.

```mermaid
stateDiagram-v2
    [*] --> Step0: Acesso à aplicação

    state "Step 0: Intro & Overview" as Step0 {
        Hero: Apresentação da Solução
        Time: Estimativa (~2 min)
        Stages: 3 Fases do Diagnóstico
        BtnStart: Iniciar Questionário
    }

    state "Step 1: Volume & Contas" as Step1 {
        Starter: 1 a 15 contas (15 GB)
        Business: 16 a 50 contas (25 GB)
        Growth: 51 a 200 contas (50 GB)
        Enterprise: 201 a 1000+ contas (100 GB)
        Custom: Sliders Interativos (5 a 2000 cx)
    }

    state "Step 2: Arquitetura & Hospedagem" as Step2 {
        Hybrid: Ambiente Híbrido (M365/Google + Combr)
        Private: Cloud Privada (Zimbra/cPanel)
        SaaS: SaaS Integral (100% M365/Google)
        VPS: Cluster VPS / AWS Dedicado
    }

    state "Step 3: Segurança & Compliance" as Step3 {
        DNS: SPF, DKIM, DMARC, PTR
        SpamWall: Gateway Antispam AI (99.8%)
        TLS_MFA: TLS 1.3 + 2FA TOTP
        LGPD: Trilha de Auditoria & Logs
    }

    state "Step 4: Backup & Continuidade" as Step4 {
        SaveMail: SaveMail Pro (WORM 5 anos)
        Daily: Backup Diário (30 dias)
        MultiDR: Alta Disponibilidade Multi-Região
        Basic: Rotina Local Básica
    }

    state "Step 5: SMTP Transacional" as Step5 {
        Regular: Somente P2P Convencional
        Standard: Transacional Dedicado (50k/mês)
        HighVol: Alto Volume (500k+/mês)
        Later: Dimensionar em Consultoria
    }

    state "Step 6: Identificação Corporativa" as Step6 {
        Form: Nome da Empresa
        Domain: Domínio Corporativo
        Contact: Nome do Solicitante
        Email: E-mail Corporativo
        Phone: WhatsApp / Telefone
        Provider: Provedor Atual
    }

    state "Step 7: Diagnóstico & Provisionamento" as Step7 {
        Loading: Processamento com Spinner
        Spotlight: Resumo da Recomendação & Stats
        CodeViewer: Abas JSON / Ansible / Terraform / DNS
        Actions: Copiar / Baixar / API / WhatsApp
    }

    Step0 --> Step1: Clique / Enter
    Step1 --> Step2: Seleção (Auto-advance 220ms)
    Step2 --> Step3: Seleção (Auto-advance 220ms)
    Step3 --> Step4: Clique Continuar (Multi-select)
    Step4 --> Step5: Seleção (Auto-advance 220ms)
    Step5 --> Step6: Seleção (Auto-advance 220ms)
    Step6 --> Step7: Submissão do Formulário
    Step7 --> Step0: Refazer Questionário
```

---

## 2. Wireframes Conceituais das Etapas

### 🖥️ Estrutura Global do Header & Barra de Progresso
```text
+-------------------------------------------------------------------------------+
|  [Logo Combr]        [<- Voltar]   [Barra: =============> 60%]     (~2 min)   |
+-------------------------------------------------------------------------------+
```

---

### 🖥️ Wireframe: Step 0 (Intro & Overview)
```text
+-------------------------------------------------------------------------------+
|                                [ LOGO BOX ]                                   |
|                         DIAGNÓSTICO ARQUITETURAL                              |
|          Descubra a infraestrutura de e-mail ideal para sua empresa           |
|  Responda a perguntas rápidas para receber uma recomendação personalizada.   |
|                                                                               |
|  +-------------------------------------------------------------------------+  |
|  | (1) Volume de Contas & Usuários                   [30 seg]              |  |
|  |     Mapeamento de caixas postais, cotas individuais e storage total.   |  |
|  |                                                                         |  |
|  | (2) Arquitetura, Segurança & Backup               [1 min]               |  |
|  |     Nuvem híbrida, proteção SPF/DKIM/DMARC e SaveMail WORM.             |  |
|  |                                                                         |  |
|  | (3) Recomendação & Especificação                  [Instantâneo]         |  |
|  |     Relatório técnico com JSON formatado para orquestração e SRE.       |  |
|  |                                                                         |  |
|  | [🔒 Respostas salvas localmente]              [ Iniciar Questionário -> ]|  |
|  +-------------------------------------------------------------------------+  |
+-------------------------------------------------------------------------------+
```

---

### 🖥️ Wireframe: Step 1 (Volume & Sliders Livres)
```text
+-------------------------------------------------------------------------------+
|  VOLUME & CONTAS                                                              |
|  Quantas caixas postais corporativas sua empresa precisa atender?             |
|                                                                               |
|  +-------------------------------------------------------------------------+  |
|  | [ ( ) ] 1 a 15 Contas [ 1 ]                            [Pequena Equipe] |  |
|  +-------------------------------------------------------------------------+  |
|  | [ (o) ] 16 a 50 Contas [ 2 ]                           [PME Crescimento]|  |
|  +-------------------------------------------------------------------------+  |
|  | [ ( ) ] 51 a 200 Contas [ 3 ]                          [Média Empresa]  |  |
|  +-------------------------------------------------------------------------+  |
|  | [ ( ) ] 201 a 1.000+ Contas [ 4 ]                      [Enterprise]     |  |
|  +-------------------------------------------------------------------------+  |
|  | [ ( ) ] Volume Personalizado (Sliders Livres) [ 5 ]    [Personalizado]  |  |
|  |         +-------------------------------------------------------------+ |  |
|  |         | Caixas Postais: [===========o==============]  50 caixas      | |  |
|  |         | Cota por Caixa: [=====o====================]  25 GB / conta  | |  |
|  |         | Capacidade Dimensionada: 1.25 TB Total                      | |  |
|  |         +-------------------------------------------------------------+ |  |
|  +-------------------------------------------------------------------------+  |
|                                                                               |
|  [Selecione uma opção]                          [ Continuar para Arquitetura ]|
+-------------------------------------------------------------------------------+
```

---

### 🖥️ Wireframe: Step 7 (Resultado & Diagnóstico Técnico)
```text
+-------------------------------------------------------------------------------+
|  [ ✓ Recomendação Concluída ]                                                 |
|                                                                               |
|  +-------------------------------------------------------------------------+  |
|  | ARQUITETURA RECOMENDADA                                                 |  |
|  | Arquitetura Híbrida Inteligente (Combr HybridCloud)                     |  |
|  | Diretoria no M365/Google + Operação na Cloud Combr (Até 70% de economia)|  |
|  |                                                                         |  |
|  | [ 35 Caixas ]    [ 875 GB Total ]    [ Score: 95/100 ]    [ RPO: 1h ]   |  |
|  +-------------------------------------------------------------------------+  |
|                                                                               |
|  +-------------------------------------------------------------------------+  |
|  | [especificacao-dimensionada.json]     [ 📋 Copiar JSON ] [ 💾 Baixar .json ]|
|  |-------------------------------------------------------------------------|  |
|  | {                                                                       |  |
|  |   "$schema": "https://api.combr.com.br/schemas/email-infra-v2.json",    |  |
|  |   "meta": { "requestId": "REQ-A5C2A6C2-49CD", "version": "2.0.0" },     |  |
|  |   "customer": { "organization": "Tech Solutions", ... },                |  |
|  |   "provisioningSpec": { ... }                                           |  |
|  | }                                                                       |  |
|  +-------------------------------------------------------------------------+  |
|                                                                               |
|  [ ↺ Refazer Questionário ]                            [ 💬 Falar no WhatsApp ]|
+-------------------------------------------------------------------------------+
```
