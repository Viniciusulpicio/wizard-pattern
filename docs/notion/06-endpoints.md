# 📡 Endpoints da API REST

> **Projeto:** Wizard Pattern &bull; Combr Soluções em Nuvem  
> **Categoria:** Requisitos Técnicos Essenciais &bull; Interface de Programação de Aplicação (API)  
> **Versão:** 2.0.0

---

## 1. Visão Geral da API

A camada de serviços backend é implementada em **PHP 8.1+**, utilizando o roteador [`Bramus\Router`](file:///home/vinicius/temp/wizard-pattern/public/index.php) e os controladores em [`ApiController.php`](file:///home/vinicius/temp/wizard-pattern/src/Controllers/ApiController.php).

### Características Globais da API:
- **Base URL:** `/api`
- **Content-Type:** `application/json; charset=utf-8`
- **CORS:** Suporte completo a requisições Cross-Origin e preflight `OPTIONS` (`Access-Control-Allow-Origin: *`).
- **Padrão de Resposta:** Todas as respostas contêm a chave `status` (`SUCCESS`, `UP`, `ERROR`, `DISPATCHED_SIMULATED`).

---

## 2. Tabela Resumo de Endpoints

| Método HTTP | Rota | Descrição Técnica | Autenticação |
| :--- | :--- | :--- | :---: |
| `GET` | **`/api/health`** | Status de saúde do serviço, versão do PHP e timestamp | Pública |
| `GET` | **`/api/questions`** | Catálogo completo de passos, perguntas, opções e metadados | Pública |
| `POST` | **`/api/diagnose`** | Processa respostas, executa motor de cálculo e gera o Payload v2.0.0 | Pública |
| `POST` | **`/api/dispatch`** | Despacha o Payload para Webhook / API de Provisionamento (com modo simulação) | Pública |

---

## 3. Especificação Detalhada por Endpoint

### 🔹 1. `GET /api/health`
Verifica a disponibilidade da API, integridade do runtime e versão do PHP.

#### Exemplo de Requisição:
```bash
curl -X GET http://localhost:8000/api/health
```

#### Exemplo de Resposta (HTTP 200 OK):
```json
{
  "status": "UP",
  "service": "Combr Wizard Pattern Engine",
  "phpVersion": "8.5.0",
  "timestamp": "2026-09-01T22:50:00+00:00"
}
```

---

### 🔹 2. `GET /api/questions`
Retorna todos os 8 passos estruturados do questionário, incluindo títulos, categorias, opções de escolha, metadados de tempo estimado e ícones.

#### Exemplo de Requisição:
```bash
curl -X GET http://localhost:8000/api/questions
```

#### Exemplo de Resposta (HTTP 200 OK):
```json
{
  "status": "SUCCESS",
  "totalSteps": 8,
  "steps": [
    {
      "stepIndex": 0,
      "id": "intro",
      "category": "DIAGNÓSTICO CORPORATIVO",
      "title": "Vamos fazer algumas perguntas para dimensionar sua infraestrutura de e-mail ideal",
      "type": "intro",
      "meta": {
        "estimatedTime": "2 min",
        "stages": [
          { "index": 1, "title": "Volume & Usuários", "time": "30 seg" }
        ]
      }
    },
    {
      "stepIndex": 1,
      "id": "mailboxes_volume",
      "category": "VOLUME & CONTAS",
      "title": "Quantas caixas postais corporativas sua empresa precisa atender?",
      "type": "single_choice",
      "autoAdvance": true,
      "options": [
        { "id": "starter", "title": "1 a 15 Contas", "badge": "Pequena Equipe", "defaultMailboxes": 10 },
        { "id": "business", "title": "16 a 50 Contas", "badge": "PME em Crescimento", "defaultMailboxes": 30 }
      ]
    }
  ]
}
```

---

### 🔹 3. `POST /api/diagnose`
Recebe o objeto de respostas fornecidas pelo usuário, aciona o `DiagnosticEngine` e o `PayloadBuilder`, retornando tanto o resumo formatado quanto o Payload padronizado v2.0.0.

#### Exemplo de Requisição:
```bash
curl -X POST http://localhost:8000/api/diagnose \
  -H "Content-Type: application/json" \
  -d '{
    "answers": {
      "mailboxes_volume": "business",
      "hosting_architecture": "hybrid_cloud",
      "security_compliance": ["dns_authentication", "antispam_gateway", "tls_2fa"],
      "backup_continuity": "savemail_immutable",
      "smtp_volume": "smtp_standard",
      "company_details": {
        "company_name": "Tech Brasil Ltda",
        "domain": "techbrasil.com.br",
        "contact_name": "Mariana Silva",
        "contact_email": "mariana@techbrasil.com.br",
        "contact_phone": "(11) 98765-4321",
        "current_provider": "cPanel"
      }
    }
  }'
```

#### Exemplo de Resposta (HTTP 200 OK):
```json
{
  "status": "SUCCESS",
  "diagnostic": {
    "status": "SUCCESS",
    "evaluatedAt": "2026-09-01T22:50:00+00:00",
    "summary": {
      "mailboxes": 35,
      "storagePerBoxGB": 25,
      "totalStorageGB": 875,
      "securityScore": 95,
      "architecture": {
        "name": "Arquitetura Híbrida Inteligente (Combr HybridCloud)",
        "sku": "COMBR-ARCH-HYBRID-V2",
        "estimatedSavings": "Economia de até 68% em relação a 100% M365/Google"
      }
    }
  },
  "payload": {
    "$schema": "https://api.combr.com.br/schemas/email-infrastructure-v2.json",
    "meta": {
      "requestId": "REQ-A5C2A6C2-49CD",
      "version": "2.0.0"
    },
    "customer": {
      "organization": "Tech Brasil Ltda",
      "primaryDomain": "techbrasil.com.br"
    },
    "provisioningSpec": { ... }
  }
}
```

---

### 🔹 4. `POST /api/dispatch`
Simula ou despacha o payload gerado para uma URL de Webhook ou API de orquestração de infraestrutura da Combr.

#### Exemplo de Requisição:
```bash
curl -X POST http://localhost:8000/api/dispatch \
  -H "Content-Type: application/json" \
  -d '{
    "simulate": true,
    "payload": {
      "meta": { "requestId": "REQ-A5C2A6C2-49CD" },
      "customer": { "organization": "Tech Brasil Ltda" }
    }
  }'
```

#### Exemplo de Resposta (HTTP 200 OK):
```json
{
  "status": "DISPATCHED_SIMULATED",
  "targetEndpoint": "https://api.combr.com.br/v2/provision/orders",
  "requestId": "REQ-A5C2A6C2-49CD",
  "statusCode": 200,
  "message": "[SIMULATION MODE] Payload validado com sucesso e simulado envio para API de provisionamento.",
  "timestamp": "2026-09-01T22:50:00+00:00"
}
```
