# 📑 Índice Geral &bull; Enterprise Mail Setup Wizard &bull; Requisitos Técnicos Essenciais

> **Projeto:** Enterprise Mail Setup Wizard (Gerador de Configuração)  
> **Empresa Parceira:** [Combr Soluções em Nuvem](https://combr.com.br/)  
> **Repositório:** [Viniciusulpicio/wizard-pattern](https://github.com/Viniciusulpicio/wizard-pattern)  
> **Live Demo:** [https://viniciusulpicio.github.io/wizard-pattern/](https://viniciusulpicio.github.io/wizard-pattern/)  
> **Versão:** 2.0.0

Este diretório contém os arquivos de documentação técnica organizados individualmente para importação direta no **Notion**, estruturados sob a ótica de uma **curadoria simplificada** para diagnóstico corporativo.

---

## 🗂️ Documentos Disponíveis para Exportação

| Arquivo | Tópico do Projeto | Descrição |
| :--- | :--- | :--- |
| [`01-mapeamento-de-arquitetura-em-nuvem.md`](file:///home/vinicius/temp/wizard-pattern/docs/notion/01-mapeamento-de-arquitetura-em-nuvem.md) | **Mapeamento de Arquitetura em Nuvem** | Servidores AlmaLinux, topologia multi-cloud (AWS e Oracle OCI), borda Cloudflare, MySQL/PostgreSQL e IaC (Ansible/Terraform). |
| [`02-ux-ui.md`](file:///home/vinicius/temp/wizard-pattern/docs/notion/02-ux-ui.md) | **UX / UI & Curadoria Simplificada** | Design System inspirado na Manual, avanço zero friction (220ms), atalhos de teclado (1-9), tokens e foco em sites institucionais. |
| [`03-schema-do-json.md`](file:///home/vinicius/temp/wizard-pattern/docs/notion/03-schema-do-json.md) | **Schema do JSON (v2.0.0)** | Especificação estruturada do contrato de dados v2.0.0, incluindo AlmaLinux, Cloudflare, AWS/Oracle e diretivas IaC. |
| [`04-wireframes-e-fluxo.md`](file:///home/vinicius/temp/wizard-pattern/docs/notion/04-wireframes-e-fluxo.md) | **Wireframes e Fluxo** | Diagrama de máquina de estados da jornada do usuário (Mermaid) e wireframes em blocos do Step 0 ao Step 7. |
| [`05-regras-de-calculo.md`](file:///home/vinicius/temp/wizard-pattern/docs/notion/05-regras-de-calculo.md) | **Regras de Cálculo** | Algoritmos de dimensionamento de caixas/storage, Security Score (0 a 100), matriz de SLA (RPO/RTO) e quotas de SMTP. |
| [`06-endpoints.md`](file:///home/vinicius/temp/wizard-pattern/docs/notion/06-endpoints.md) | **Endpoints da API REST** | Especificação técnica de `/api/health`, `/api/questions`, `/api/diagnose` e `/api/dispatch` com exemplos cURL e JSON. |

---

## 💡 Como Importar no Notion:
1. Abra o seu espaço de trabalho no **Notion**.
2. Na barra lateral esquerda, clique em **"Import"** (Importar).
3. Selecione a opção **"Markdown & CSV"**.
4. Selecione os arquivos da pasta `docs/notion/` do projeto. O Notion converterá automaticamente cabeçalhos, tabelas, blocos de código e diagramas Mermaid nativamente.
