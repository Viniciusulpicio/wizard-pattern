# 🎨 UX / UI & Design System

> **Projeto:** Wizard Pattern &bull; Combr Soluções em Nuvem  
> **Categoria:** Requisitos Técnicos Essenciais &bull; Interface & Experiência  
> **Versão:** 2.0.0

---

## 1. Filosofia de Design & Curadoria Simplificada

A interface e experiência do usuário (UX/UI) do **Enterprise Mail Setup Wizard** foram desenvolvidas com inspiração direta no design system minimalista e refinado do quiz da **Manual (Manual.co)**, adaptadas para o contexto e identidade corporativa da **Combr Soluções em Nuvem** ([combr.com.br](https://combr.com.br/)).

### Pilares de UX:
- **Curadoria Simplificada:** A interface foi concebida para simplificar a tomada de decisão técnica por clientes corporativos. Elimina formulários maçantes de TI e jargões excessivos, traduzindo necessidades cotidianas (volume de e-mails, mitigação de ataques, disparo em massa e backup) em configurações técnicas precisas para servidores **AlmaLinux** na **AWS / Oracle Cloud**.
- **Zero Friction (Avanço Automático):** Redução do esforço cognitivo e de cliques; opções de escolha única avançam suavemente (220ms) sem necessidade de clique redundante em "Avançar".
- **Clareza Visual:** Tipografia hierárquica clara, kickers de categoria em caixa alta, descrições técnicas acessíveis e uso de badges semânticas de status.
- **Interatividade Total (Keyboard-First):** Navegação completa possível via teclado (teclas numéricas de 1 a 9, Enter, Esc e Setas).
- **Design 100% Responsivo:** Experiência consistente e fluida em Desktop, Tablets e dispositivos móveis (Mobile-first para decisores em movimento).

---

## 2. Componentes de Interface & Padrões Visuais

### 1. Header Fixo & Indicador de Progresso
- **Logo Combr:** Vetorial (SVG) em alta definição.
- **Botão Contextual `← Voltar`:** Fica oculto no passo inicial (Step 0) e torna-se visível a partir do Step 1, permitindo retorno de tela a qualquer momento.
- **Badge de Estimativa:** Exibe `~2 min` para gerenciar a expectativa de tempo do usuário.
- **Barra de Progresso Linear Contínua:** Barra fina no topo com preenchimento animado em gradiente, calculando a porcentagem de conclusão (`(currentStep / totalSteps) * 100`).
- **Texto de Etapa:** Indicador contextual (ex: `Início do Diagnóstico`, `Etapa 1 de 6`, `Diagnóstico Finalizado`).

### 2. Cards de Seleção Interativos (Radio Tiles e Checkbox Tiles)
- **Estrutura do Card:**
  - Indicador circular (Radio) ou quadrado (Checkbox) com transição de preenchimento.
  - Título da opção com atalho de teclado visual pill (`<kbd class="key-shortcut-pill">1</kbd>`).
  - Badge informativa (`Economia de até 70%`, `Recomendado`, `Enterprise`).
  - Descrição técnica objetiva do pacote ou recurso.
- **Estados Visuais:**
  - `Normal`: Borda neutra sutil com fundo claro.
  - `Hover`: Elevação discreta e realce de borda.
  - `Selected`: Borda azul Combr acentuada, fundo suavemente tintado e indicador ativo preenchido.
  - `Highlight`: Borda com destaque dourado/azul para opções recomendadas.

### 3. Modo de Volume Personalizado (Sliders Dinâmicos)
- Quando o card `Volume Personalizado` é selecionado, um container interativo é aberto suavemente:
  - **Slider 1 (Caixas):** Range de 5 a 2.000 caixas postais.
  - **Slider 2 (Armazenamento):** Range de 10 a 200 GB por caixa.
  - **Display de Cálculo Reativo:** Mostra instantaneamente a capacidade total dimensionada (ex: `1.2 TB Total` ou `750 GB Total`).

### 4. Visualizador de Diagnóstico & JSON Viewer
- **Spotlight Card:** Card de destaque superior com o nome da arquitetura recomendada, tagline e grid com 4 estatísticas centrais (Caixas, Armazenamento, Nível de Segurança e SLA de Continuidade).
- **Abas Técnicas & Code Viewer:** Bloco de código escuro (Dark Theme) com syntax highlighting do Payload JSON v2.0.0.
- **Barra de Ações Rápidas:**
  - 📋 **Copiar Resumo:** Copia o JSON para o Clipboard com feedback visual instantâneo via **Toast Notification**.
  - 💾 **Baixar .json:** Dispara o download automático do arquivo `combr-email-spec-REQ-XXXX.json`.
  - 🚀 **Simular Envio para API:** Envia requisição assíncrona para o endpoint de provisionamento com loading spinner e feedback de status HTTP.
  - 💬 **Falar no WhatsApp:** Link direto para o consultor da Combr com mensagem pré-formatada contendo todos os dados do diagnóstico e ID da requisição.

---

## 3. Guia de Cores & Tokens de Design

| Token | Variável CSS | Valor Hex / Cor | Aplicação |
| :--- | :--- | :--- | :--- |
| **Brand Blue** | `--color-brand-blue` | `#0066FF` | Botões primários, progresso ativo, bordas selecionadas |
| **Brand Dark** | `--color-brand-dark` | `#0F172A` | Títulos principais, header, contrastes fortes |
| **Background** | `--color-bg-body` | `#F8FAFC` | Fundo geral da aplicação |
| **Surface Card** | `--color-surface` | `#FFFFFF` | Fundo de cards de perguntas e containers |
| **Border Neutral** | `--color-border` | `#E2E8F0` | Bordas de cards não selecionados e separadores |
| **Success Green** | `--color-success` | `#10B981` | Badges de segurança e avisos positivos |
| **Text Muted** | `--color-text-muted` | `#64748B` | Subtítulos e instruções secundárias |

---

## 4. Atalhos de Teclado Suportados

| Tecla / Combinação | Ação Executada |
| :--- | :--- |
| **`1` a `9`** | Seleciona o card correspondente à posição numérica na tela |
| **`Enter`** | Avança para o próximo passo ou submete o formulário atual |
| **`ArrowLeft (←)` / `Esc`** | Retorna para a etapa anterior (do Step 1 ao 6) |
