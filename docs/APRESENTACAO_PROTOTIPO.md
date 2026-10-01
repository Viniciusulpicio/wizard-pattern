# 📊 Apresentação do Protótipo &bull; Enterprise Mail Setup Wizard
**Gerador de Configuração & Diagnóstico de Infraestrutura em Nuvem**

> Estrutura completa de **10 slides** focada 100% na **solução técnica, curadoria simplificada, arquitetura e protótipo funcional**, incluindo:
> - **Conteúdo Visual e Textual do Slide**
> - **Elementos Visuais / Destaques Recomendados**
> - **Roteiro de Fala (Speaker Notes)** objetivo e direto ao ponto.

---

## 📑 Índice dos Slides

1. [Slide 1: Capa &bull; Enterprise Mail Setup Wizard](#slide-1-capa--enterprise-mail-setup-wizard)
2. [Slide 2: O Problema & O Desafio Técnico de Qualificação](#slide-2-o-problema--o-desafio-técnico-de-qualificação)
3. [Slide 3: A Solução &bull; Curadoria Simplificada & Inteligência](#slide-3-a-solução--curadoria-simplificada--inteligência)
4. [Slide 4: UX / UI & Padrão Zero Friction (Design System)](#slide-4-ux--ui--padrão-zero-friction-design-system)
5. [Slide 5: Fluxo da Aplicação & Jornada do Usuário (Steps 0 a 7)](#slide-5-fluxo-da-aplicação--jornada-do-usuário-steps-0-a-7)
6. [Slide 6: Mapeamento de Arquitetura em Nuvem & Servidores AlmaLinux](#slide-6-mapeamento-de-arquitetura-em-nuvem--servidores-almalinux)
7. [Slide 7: Motor de Diagnóstico & Regras de Cálculo](#slide-7-motor-de-diagnóstico--regras-de-cálculo)
8. [Slide 8: Schema do JSON v2.0.0 & Automação IaC](#slide-8-schema-do-json-v200--automação-iac)
9. [Slide 9: Endpoints da API REST & Integração de Provisionamento](#slide-9-endpoints-da-api-rest--integração-de-provisionamento)
10. [Slide 10: Demonstração ao Vivo (Live Demo) & Resultados](#slide-10-demonstração-ao-vivo-live-demo--resultados)

---

<!-- SLIDE 1 -->
## Slide 1: Capa &bull; Enterprise Mail Setup Wizard

### 🎯 Título & Subtítulo
- **Título Principal:** ENTERPRISE MAIL SETUP WIZARD
- **Subtítulo:** Gerador Inteligente de Configuração e Diagnóstico de Infraestrutura de E-mail Corporativo
- **Contexto:** Disciplina de Fábrica de Projetos Ágeis II &bull; Turma B &bull; 2026
- **Apresentador(es) / Integrantes:** Victor Hugo, Pedro Lucas, Henzo Katsumuto, Luiz Seisdedo, Danilo Dezani, Vinicius Sulpicio, Bruno Viera
- **Badges:** `Protótipo Funcional` | `Curadoria Simplificada` | `AlmaLinux` | `Multi-Cloud AWS & Oracle`

### 🖼️ Elementos Visuais do Slide
- Mockup de alta definição da interface rodando em desktop e mobile.
- Destaques visuais: Badges de tecnologia (AlmaLinux, AWS, Oracle Cloud, Cloudflare, PHP 8).

### 🎙️ Roteiro de Fala (Speaker Notes)
> *"Olá a todos! Hoje vamos apresentar o **Enterprise Mail Setup Wizard**, um gerador interativo de configuração e diagnóstico de infraestrutura em nuvem. Nossa missão foi desenvolver uma ferramenta de curadoria simplificada que resolve o gargalo de qualificação técnica e comercial, transformando um processo burocrático que levava dias em uma experiência fluida de menos de 2 minutos."*

---

<!-- SLIDE 2 -->
## Slide 2: O Problema & O Desafio Técnico de Qualificação

### 🎯 Título & Tópicos
- **Título:** O Cenário Atual: Gargalos no Dimensionamento de E-mails
- **Dores Críticas Mapeadas:**
  - **1. Dimensionamento Lento e Burocrático:** Formulários maçantes de TI e reuniões longas para coletar requisitos simples de caixas e contas.
  - **2. Ataques Recorrentes e Fragilidade de Borda:** Ataques diários de força bruta contra webmails, tentativas de phishing e ausência de autenticação SPF, DKIM e DMARC.
  - **3. Faturas Excessivas em Dólar:** Empresas pagando licenças completas de M365 ou Google Workspace para 100% da equipe, quando a maioria precisa apenas de e-mail profissional.
  - **4. Desconexão entre Comercial e DevOps:** Propostas aprovadas que não geram configurações prontas para provisionamento em servidores.

### 🖼️ Elementos Visuais do Slide
- Diagrama comparativo: *Processo Manual Tradicional (Planilhas + Dias)* vs. *Setup Wizard (2 Minutos + JSON Pronto)*.
- Ícones de impacto: 💸 Custo Alto em Dólar | ⚠️ Risco de Ataques | ⏳ Lentidão Operacional.

### 🎙️ Roteiro de Fala (Speaker Notes)
> *"Dimensionar e-mails corporativos hoje é um processo cheio de atritos. O cliente corporativo preenche formulários longos, a equipe técnica perde tempo calculando cotas manualmente e, no final, muitas empresas acabam com planos caros em dólar ou vulneráveis a ataques de força bruta e spoofing. Além disso, a proposta comercial não se comunicava com a engenharia de infraestrutura. Identificamos aí a oportunidade exata para automação."*

---

<!-- SLIDE 3 -->
## Slide 3: A Solução &bull; Curadoria Simplificada & Inteligência

### 🎯 Título & Tópicos
- **Título:** A Solução: Curadoria Simplificada & Automação
- **Proposta de Valor:**
  - **Curadoria Descomplicada:** O sistema faz perguntas diretas sobre a necessidade do negócio (quantidade de caixas, volume de envio, exigências de segurança e retenção de backup).
  - **Diagnóstico Arquitetural Instantâneo:** Motor que dimensiona a infraestrutura em tempo real e calcula o índice de segurança.
  - **Economia Estratégica de até 70%:** Recomendação automática de ambiente híbrido inteligente (postos-chave no M365/Google + operação na nuvem corporativa).
  - **Saída Pronta para Engenharia:** Exportação de contrato de dados JSON v2.0.0 compatível com automação IaC para servidores AlmaLinux na AWS e Oracle Cloud.

### 🖼️ Elementos Visuais do Slide
- Diagrama dos 3 pilares da solução:
  1. *Entrada Simples* (Perguntas guiadas sem jargões)
  2. *Motor de Decisão* (DiagnosticEngine)
  3. *Saída Técnica* (JSON v2.0 + Playbooks Ansible + DNS Blueprint)

### 🎙️ Roteiro de Fala (Speaker Notes)
> *"Nossa resposta é o Enterprise Mail Setup Wizard com curadoria simplificada. O gestor responde perguntas objetivas em uma linguagem clara. Por trás da tela, nosso motor matemático analisa as variáveis, seleciona a melhor topologia de nuvem, calcula o espaço de armazenamento e já gera a configuração completa para a equipe de infraestrutura."*

---

<!-- SLIDE 4 -->
## Slide 4: UX / UI & Padrão Zero Friction (Design System)

### 🎯 Título & Tópicos
- **Título:** UX / UI: Design System Focado em Zero Friction
- **Diferenciais da Interface:**
  - **Inspiração no Quiz da Manual:** Design minimalista, elegante, com tipografia legível e contraste balanceado.
  - **Avanço Automático (Zero Friction):** Em perguntas de seleção única, o sistema avança suavemente em 220ms sem exigir clique manual em 'Próximo'.
  - **Navegação Keyboard-First:** Usuários experientes podem navegar e selecionar opções usando atalhos numéricos (`1` a `9`), `Enter` e `Esc`.
  - **Transparência do Processo:** Barra de progresso linear contínua e indicador de tempo estimado (`~2 min`).
  - **Sliders Interativos:** Opção de volume personalizado com sliders reativos e conversão em tempo real de Gigabytes para Terabytes.

### 🖼️ Elementos Visuais do Slide
- Captura de tela dos cards com badges de atalho de teclado (`[ 1 ]`, `[ 2 ]`) e do slider interativo de storage.

### 🎙️ Roteiro de Fala (Speaker Notes)
> *"Na experiência do usuário, eliminamos qualquer fricção cognitiva. Inspiramo-nos no padrão moderno de quiz da Manual: ao escolher uma opção de escolha única, o wizard avança sozinho em 220 milissegundos. Usuários avançados podem responder tudo pelo teclado com as teclas de 1 a 9, e adicionamos sliders reativos que calculam a capacidade total em Terabytes em tempo real."*

---

<!-- SLIDE 5 -->
## Slide 5: Fluxo da Aplicação & Jornada do Usuário (Steps 0 a 7)

### 🎯 Título & Tópicos
- **Título:** A Jornada do Usuário em 8 Etapas
- **O Funil de Diagnóstico:**
  - **Step 0:** Boas-vindas e contextualização (~2 min).
  - **Step 1:** Volume & Contas (1-15, 16-50, 51-200, 201+ ou Sliders Livres).
  - **Step 2:** Arquitetura & Hospedagem (Híbrido, Privado, SaaS ou VPS Dedicado).
  - **Step 3:** Segurança, DNS & Reputação (SPF/DKIM/DMARC, Cloudflare/WAF, TLS 1.3/2FA, LGPD).
  - **Step 4:** Backup & Continuidade (SaveMail WORM 5 anos, Diário 30d, DR Multi-Região).
  - **Step 5:** SMTP Transacional & Envio em Massa (5k, 50k, 500k+/mês).
  - **Step 6:** Identificação Corporativa (Empresa, domínio corporativo, contato de TI e provedor atual).
  - **Step 7:** Diagnóstico Final & Entrega da Especificação Técnica.

### 🖼️ Elementos Visuais do Slide
- Fluxograma horizontal com ícones conceituais das etapas 0 a 7.
- Wireframe conceitual em ASCII do Header e do painel de resultados.

### 🎙️ Roteiro de Fala (Speaker Notes)
> *"A jornada do usuário é linear e composta por 8 passos. Começamos pelo volume de caixas, passamos pelo modelo de hospedagem, ativamos proteções contra ataques na borda, selecionamos a política de backup e definimos o volume de envio por sistemas. Essa cadência garante 100% de precisão sem cansar o usuário."*

---

<!-- SLIDE 6 -->
## Slide 6: Mapeamento de Arquitetura em Nuvem & Servidores AlmaLinux

### 🎯 Título & Tópicos
- **Título:** Engenharia de Nuvem: Topologia AlmaLinux & Multi-Cloud
- **As 4 Camadas de Infraestrutura:**
  - **Camada 1 (Borda & Mitigação):** **Cloudflare** (WAF, proteção anti-DDoS, rate-limiting e DNS Anycast) + Gateway Antispam Heurístico com IA.
  - **Camada 2 (Servidores em Nuvem):** Instâncias corporativas em **AlmaLinux** rodando em **AWS** ou **Oracle Cloud (OCI)**.
  - **Camada 3 (Armazenamento, Bancos & Backup):** Storage NVMe de alta performance, monitoramento de bancos **MySQL e PostgreSQL** para sites institucionais, e backup WORM imutável.
  - **Camada 4 (Mensageria Transacional):** Pool de IPs dedicados e aquecidos para disparos de alto volume.
- **Os 4 Modelos Arquiteturais Mapeados:**
  1. *Ambiente Híbrido Inteligente* (`COMBR-ARCH-HYBRID-V2`): M365/Google + Cloud AlmaLinux (economia de até 70%).
  2. *Cloud Privada* (`COMBR-ARCH-PRIVATEMAIL-V2`): Cluster AlmaLinux dedicado Zimbra/cPanel com soberania LGPD.
  3. *SaaS Gerenciado* (`COMBR-ARCH-SAAS-MANAGED`): 100% Microsoft 365 / Google Workspace em BRL.
  4. *Cluster VPS Dedicado* (`COMBR-ARCH-VPS-DEDICATED`): Instância AlmaLinux dedicada em AWS/Oracle com IPs próprios.

### 🖼️ Elementos Visuais do Slide
- Diagrama arquitetural Mermaid em 4 camadas destacando AlmaLinux, AWS, Oracle OCI e Cloudflare.

### 🎙️ Roteiro de Fala (Speaker Notes)
> *"Na arquitetura em nuvem, estruturamos a solução em quatro camadas robustas. A primeira camada é a borda da Cloudflare que bloqueia ataques de força bruta e DDoS. A segunda camada são servidores em AlmaLinux na AWS ou Oracle Cloud. A terceira camada gerencia o storage NVMe, o monitoramento de bancos MySQL e PostgreSQL e o backup WORM. E a quarta camada isola o tráfego de e-mails em massa."*

---

<!-- SLIDE 7 -->
## Slide 7: Motor de Diagnóstico & Regras de Cálculo

### 🎯 Título & Tópicos
- **Título:** Inteligência do Protótipo: Motor de Cálculo
- **Algoritmos do `DiagnosticEngine`:**
  - **Cálculo de Capacidade:** $\text{Storage Total} = \text{Caixas} \times \text{Cota (GB)}$, com conversão inteligente para Terabytes.
  - **Security Score Dinâmico (0 a 100):** Base inicial de 40 pontos com incrementos determinísticos:
    - *Autenticação DNS (SPF + DKIM 2048b + DMARC + PTR):* **+20 pts**
    - *Gateway Antispam Heurístico & WAF Cloudflare:* **+20 pts**
    - *TLS 1.3 & 2FA/MFA Obrigatório:* **+15 pts**
    - *Trilha de Auditoria LGPD & Retenção de Logs:* **+5 pts**
  - **Matriz de Resiliência:** Mapeamento de RPO (15 min a 48h) e RTO (30 min a 12h) conforme o plano de contingência.

### 🖼️ Elementos Visuais do Slide
- Gauge circular com o *Security Score* (ex: 95/100).
- Tabela resumida das fórmulas e incrementos de pontuação.

### 🎙️ Roteiro de Fala (Speaker Notes)
> *"O DiagnosticEngine é o motor de regras do sistema. Ele calcula dinamicamente a volumetria e avalia o nível de conformidade através de um Security Score de 0 a 100. Se o cliente ativa autenticação SPF, DKIM e DMARC, ganha 20 pontos; com antispam e WAF, mais 20 pontos; com TLS e 2FA, 15 pontos. Isso dá ao cliente um diagnóstico imediato, transparente e quantitativo."*

---

<!-- SLIDE 8 -->
## Slide 8: Schema do JSON v2.0.0 & Automação IaC

### 🎯 Título & Tópicos
- **Título:** Automação SRE: Schema JSON v2.0.0 & IaC
- **Entregas Técnicas do Painel Final:**
  - **Payload JSON Padronizado (v2.0.0):** Contrato estruturado com blocos `meta`, `customer`, `provisioningSpec` e variáveis para infraestrutura.
  - **Pronto para IaC (Infrastructure as Code):** Gera variáveis compatíveis com Playbooks do **Ansible** (`site-mail-provision.yml`) e módulos do **Terraform** para provisionar instâncias **AlmaLinux** na AWS ou Oracle Cloud.
  - **Blueprint DNS com Cloudflare:** Registros MX, SPF, DKIM e DMARC gerados dinamicamente para o painel de DNS.
  - **Barra de Ações Rápidas de 1 Clique:**
    - 📋 Copiar JSON com feedback Toast instantâneo.
    - 💾 Baixar o arquivo `.json` de especificação técnica.
    - 🚀 Simular envio para API de provisionamento via Webhook (HTTP 200 Mock).
    - 💬 Chamar consultor no WhatsApp com proposta pré-formatada.

### 🖼️ Elementos Visuais do Slide
- Trecho estilizado do JSON v2.0 em Dark Mode com syntax highlighting.
- Ícones das 4 ações rápidas: Copiar, Baixar, Webhook, WhatsApp.

### 🎙️ Roteiro de Fala (Speaker Notes)
> *"O diagnóstico não é um simples texto na tela. Ele gera um contrato de dados JSON versão 2.0 pronto para engenharia. A equipe de DevOps recebe diretamente as variáveis para rodar Playbooks do Ansible ou módulos do Terraform em AlmaLinux. E na própria tela de resultado, o usuário pode copiar o resumo, baixar o arquivo JSON ou chamar o consultor no WhatsApp com a proposta pronta."*

---

<!-- SLIDE 9 -->
## Slide 9: Endpoints da API REST & Integração de Provisionamento

### 🎯 Título & Tópicos
- **Título:** Arquitetura de Software: API RESTful em PHP 8.1+
- **Especificação dos Endpoints REST:**
  - `GET /api/health` &bull; Monitoramento de disponibilidade e versão do runtime.
  - `GET /api/questions` &bull; Catálogo completo dos 8 passos e opções do diagnóstico em JSON.
  - `POST /api/diagnose` &bull; Processamento determinístico das respostas e emissão do payload v2.0.0.
  - `POST /api/dispatch` &bull; Despacho ou simulação de ordem de serviço para webhook de provisionamento.
- **Padrões de Engenharia:** Roteamento com `Bramus\Router`, injeção de dependências, CORS habilitado e testes unitários automatizados cobrindo 100% dos cenários.

### 🖼️ Elementos Visuais do Slide
- Tabela dos 4 endpoints com métodos HTTP (`GET`/`POST`), rotas e códigos de status.
- Exemplo de requisição cURL e resposta HTTP 200 OK.

### 🎙️ Roteiro de Fala (Speaker Notes)
> *"No backend, adotamos uma arquitetura limpa em PHP moderno com rotas RESTful. Temos endpoints para checagem de saúde, catálogo de perguntas, processamento do diagnóstico e despacho de webhooks. Toda a suíte de testes unitários está automatizada e validando as regras de dimensionamento e a integridade do JSON gerado."*

---

<!-- SLIDE 10 -->
## Slide 10: Demonstração ao Vivo (Live Demo) & Resultados

### 🎯 Título & Tópicos
- **Título:** Demonstração ao Vivo, Ganhos & Resultados
- **Ganhos Comprovados pelo Protótipo:**
  - ⚡ **Velocidade:** Redução do ciclo de qualificação e dimensionamento de 3 a 5 dias para **menos de 2 minutos**.
  - 💰 **Eficiência de Custo:** Economia de até **70%** na fatura de e-mail corporativo ao adotar o modelo híbrido.
  - 🛡️ **Segurança Proativa:** Mitigação de ataques com Cloudflare e blindagem de reputação.
- **Acesso ao Protótipo Funcional:**
  - 🌐 **Live Demo Online:** [https://viniciusulpicio.github.io/wizard-pattern/](https://viniciusulpicio.github.io/wizard-pattern/)
  - 🖥️ **Ambiente Local:** `http://localhost:8000`
  - 🧪 **API Health Check:** `http://localhost:8000/api/health`
- **Agradecimentos & Espaço para Perguntas:**
  - Obrigado a todos! Estamos prontos para a demonstração prática e dúvidas.

### 🖼️ Elementos Visuais do Slide
- Screenshot da tela final de diagnóstico com o JSON Viewer e o Spotlight Card.
- QR Code apontando para a Live Demo no GitHub Pages.
- Links do repositório no GitHub.

### 🎙️ Roteiro de Fala (Speaker Notes)
> *"Para concluir, o Enterprise Mail Setup Wizard demonstra na prática como design inteligente e automação em nuvem transformam processos tradicionais de TI. Reduzimos o tempo de dimensionamento de dias para 2 minutos e entregamos uma solução pronta para provisionamento em AlmaLinux na AWS ou Oracle Cloud. O protótipo está 100% funcional online no GitHub Pages e agora abrimos para demonstração ao vivo e perguntas!"*
