<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

![PHP Logo](https://upload.wikimedia.org/wikipedia/commons/2/27/PHP-logo.svg)

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# Sistema de Ocorrências - PHP Estruturado

## 📋 Descrição

Sistema completo de gerenciamento de ocorrências desenvolvido em PHP estruturado, com interface responsiva e funcionalidades avançadas para controle de clientes, agentes, atendimentos, rondas periódicas, ocorrências veiculares, vigilância veicular e prestadores de serviços.

## 🚀 Características Principais

### ✅ **Funcionalidades Implementadas**
- **Sistema de Autenticação** - Login seguro com níveis de acesso (Admin/Usuário)
- **CRUD Completo** - Para todas as 7 entidades do sistema
- **Interface Responsiva** - Design azul e branco, compatível com desktop e mobile
- **Sistema de Upload** - Upload seguro de arquivos com validações
- **Relatórios** - Exportação em PDF e Excel para todas as entidades
- **Validações** - Client-side e server-side robustas
- **Geolocalização** - Integração com APIs de localização
- **Máscaras Automáticas** - Para CNPJ, CPF, telefone, CEP, placas

### 📊 **Entidades Gerenciadas**
1. **Clientes** - Gestão completa de empresas clientes
2. **Agentes** - Controle de agentes de segurança
3. **Atendimentos** - Registro de atendimentos realizados
4. **Rondas Periódicas** - Controle de rondas de segurança
5. **Ocorrências Veiculares** - Registro de ocorrências com veículos
6. **Vigilância Veicular** - Monitoramento de veículos
7. **Prestadores** - Gestão de prestadores de serviços (apenas admin)

## 🛠️ Tecnologias Utilizadas

- **Backend**: PHP 7.4+ (estruturado)
- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 5
- **Banco de Dados**: MySQL 5.7+
- **Bibliotecas**: 
  - FontAwesome (ícones)
  - Chart.js (gráficos)
  - ViaCEP API (busca de endereços)
  - DomPDF (geração de PDF)
  - PhpSpreadsheet (geração de Excel)

## 📁 Estrutura do Projeto

```
sistema-ocorrencias-php-estruturado/
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── app.js
├── controllers/
│   ├── AgenteController.php
│   ├── AtendimentoController.php
│   ├── ClienteController.php
│   ├── OcorrenciaVeicularController.php
│   ├── PrestadorController.php
│   ├── RelatorioController.php
│   ├── RondaPeriodicaController.php
│   └── VigilanciaVeicularController.php
├── database/
│   ├── create_tables.sql
│   ├── install.php
│   └── install_db.php
├── includes/
│   ├── auth.php
│   ├── config.php
│   ├── database.php
│   ├── export.php
│   ├── router.php
│   ├── upload.php
│   └── validation.php
├── models/
│   ├── AgenteModel.php
│   ├── AtendimentoModel.php
│   ├── ClienteModel.php
│   ├── OcorrenciaVeicularModel.php
│   ├── PrestadorModel.php
│   ├── RondaPeriodicaModel.php
│   ├── TabelaPrestadorModel.php
│   └── VigilanciaVeicularModel.php
├── public/
│   ├── agentes.php
│   ├── atendimentos.php
│   ├── clientes.php
│   ├── dashboard.php
│   ├── index.php
│   ├── login.php
│   ├── logout.php
│   ├── ocorrencias.php
│   ├── prestadores.php
│   ├── register.php
│   ├── relatorios.php
│   ├── rondas.php
│   ├── upload.php
│   └── vigilancia.php
├── routes/
│   └── web.php
├── uploads/
│   ├── documents/
│   ├── images/
│   ├── temp/
│   ├── .htaccess
│   └── index.php
├── views/
│   ├── agentes/
│   │   ├── create.php
│   │   ├── edit.php
│   │   ├── index.php
│   │   └── show.php
│   ├── atendimentos/
│   │   ├── create.php
│   │   ├── edit.php
│   │   ├── index.php
│   │   └── show.php
│   ├── clientes/
│   │   ├── create.php
│   │   ├── edit.php
│   │   ├── index.php
│   │   └── show.php
│   ├── includes/
│   │   ├── footer.php
│   │   ├── header.php
│   │   ├── navbar.php
│   │   └── sidebar.php
│   ├── ocorrencias/
│   │   ├── create.php
│   │   ├── edit.php
│   │   ├── index.php
│   │   └── show.php
│   ├── prestadores/
│   │   ├── create.php
│   │   ├── edit.php
│   │   ├── index.php
│   │   └── show.php
│   ├── relatorios/
│   │   └── index.php
│   ├── rondas/
│   │   ├── create.php
│   │   ├── edit.php
│   │   ├── index.php
│   │   └── show.php
│   └── vigilancia/
│       ├── create.php
│       ├── edit.php
│       ├── index.php
│       └── show.php
└── README.md
```

## ⚙️ Instalação

### Pré-requisitos
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache/Nginx)
- Extensões PHP: mysqli, pdo, gd, zip

### Passo a Passo

1. **Extrair o arquivo**
   ```bash
   unzip sistema-ocorrencias-php-estruturado.zip
   cd sistema-ocorrencias-php-estruturado
   ```

2. **Configurar o banco de dados**
   - Edite o arquivo `includes/config.php` com suas credenciais MySQL
   ```php
   define("DB_HOST", "localhost");
   define("DB_NAME", "sistema_ocorrencias");
   define("DB_USER", "seu_usuario");
   define("DB_PASS", "sua_senha");
   ```

3. **Instalar o banco de dados**
   ```bash
   # Via navegador
   http://seu-dominio/database/install_db.php
   
   # Ou via linha de comando
   cd database && php install_db.php
   ```

4. **Configurar permissões**
   ```bash
   chmod 755 uploads/
   chmod 755 uploads/documents/
   chmod 755 uploads/images/
   chmod 755 uploads/temp/
   ```

5. **Acessar o sistema**
   - URL: `http://seu-dominio/public/`
   - Será redirecionado automaticamente para login

## 👤 Usuários Padrão

O sistema cria automaticamente os seguintes usuários:

### Administrador
- **Email**: admin@sistema.com
- **Senha**: password
- **Nível**: Administrador (acesso completo)

### Usuário Normal
- **Email**: usuario@sistema.com
- **Senha**: password
- **Nível**: Usuário (acesso limitado)

## 🔐 Níveis de Acesso

### Administrador
- ✅ Acesso completo a todas as funcionalidades
- ✅ Gerenciamento de prestadores
- ✅ Relatórios avançados
- ✅ Configurações do sistema

### Usuário
- ✅ Clientes, Agentes, Atendimentos
- ✅ Rondas, Ocorrências, Vigilância
- ✅ Relatórios básicos
- ❌ Prestadores (apenas visualização)

## 📊 Funcionalidades Detalhadas

### Sistema de Clientes
- Cadastro completo com CNPJ, endereço, contatos
- Validação automática de CNPJ
- Busca automática de endereço por CEP
- Status: Ativo, Inativo, Suspenso
- Pessoa de contato adicional

### Sistema de Agentes
- Cadastro com CPF, RG, endereço
- Controle de status e disponibilidade
- Informações de contato e emergência
- Histórico de atividades

### Sistema de Atendimentos
- Registro detalhado de atendimentos
- Geolocalização automática
- Upload de fotos e documentos
- Controle de tempo e quilometragem
- Status de pagamento

### Sistema de Rondas Periódicas
- Programação de rondas recorrentes
- Controle de horários e rotas
- Relatórios de eficiência
- Integração com GPS

### Sistema de Ocorrências Veiculares
- Registro de acidentes e infrações
- Dados completos do veículo
- Fotos e documentos anexos
- Acompanhamento de processos

### Sistema de Vigilância Veicular
- Monitoramento de veículos
- Alertas e notificações
- Histórico de movimentação
- Relatórios de segurança

### Sistema de Prestadores
- Cadastro de empresas parceiras
- Controle de contratos
- Avaliação de desempenho
- Gestão financeira

## 📈 Sistema de Relatórios

### Relatórios Disponíveis
- **Clientes**: Lista completa com filtros
- **Agentes**: Relatório de performance
- **Atendimentos**: Estatísticas detalhadas
- **Rondas**: Eficiência e cobertura
- **Ocorrências**: Análise de incidentes
- **Vigilância**: Monitoramento de segurança
- **Prestadores**: Avaliação de parceiros

### Formatos de Exportação
- **PDF**: Relatórios formatados para impressão
- **Excel**: Dados estruturados para análise
- **Filtros**: Por data, status, cliente, etc.

## 🔧 Configurações Avançadas

### Upload de Arquivos
- **Tipos permitidos**: JPG, PNG, PDF, DOC, DOCX
- **Tamanho máximo**: 5MB por arquivo
- **Validações**: Tipo MIME, extensão, tamanho
- **Segurança**: Proteção contra uploads maliciosos

### Validações Implementadas
- **CNPJ**: Validação completa com dígitos verificadores
- **CPF**: Algoritmo oficial da Receita Federal
- **CEP**: Integração com API ViaCEP
- **Placas**: Formato brasileiro (ABC-1234)
- **Telefones**: Máscaras automáticas

### Segurança
- **Senhas**: Hash seguro com password_hash()
- **Sessões**: Controle de timeout e regeneração
- **SQL Injection**: Prepared statements
- **XSS**: Sanitização de dados
- **CSRF**: Tokens de proteção

## 🚀 Deploy em Produção

### Servidor Web
1. Configure o DocumentRoot para a pasta `public/`
2. Habilite mod_rewrite (Apache) ou configuração similar (Nginx)
3. Configure SSL/HTTPS para segurança

### Banco de Dados
1. Crie um usuário específico com privilégios limitados
2. Configure backup automático
3. Otimize índices para performance

### Segurança
1. Altere as senhas padrão imediatamente
2. Configure firewall adequado
3. Mantenha PHP e MySQL atualizados
4. Configure logs de auditoria

## 🐛 Solução de Problemas

### Problemas Comuns

**Erro de conexão com banco**
- Verifique credenciais em `includes/config.php`
- Confirme se MySQL está rodando
- Teste conexão manualmente

**Upload não funciona**
- Verifique permissões da pasta `uploads/`
- Confirme configurações PHP (upload_max_filesize)
- Verifique espaço em disco

**Páginas em branco**
- Ative display_errors no PHP
- Verifique logs de erro do servidor
- Confirme sintaxe dos arquivos PHP

**Login não funciona**
- Verifique se o banco foi instalado corretamente
- Confirme se os usuários padrão foram criados
- Teste credenciais manualmente no banco

## 📞 Suporte

### Logs do Sistema
- **PHP**: Verifique error_log do PHP
- **MySQL**: Consulte logs do MySQL
- **Servidor**: Logs do Apache/Nginx

### Informações Técnicas
- **Versão**: 1.0.0
- **Compatibilidade**: PHP 7.4+, MySQL 5.7+
- **Licença**: Proprietária
- **Encoding**: UTF-8

## 🔄 Atualizações Futuras

### Funcionalidades Planejadas
- [ ] API REST para integração
- [ ] Aplicativo mobile
- [ ] Notificações push
- [ ] Dashboard em tempo real
- [ ] Integração com WhatsApp
- [ ] Backup automático

### Melhorias Técnicas
- [ ] Cache de consultas
- [ ] Otimização de performance
- [ ] Testes automatizados
- [ ] Documentação da API
- [ ] Containerização Docker

---

## 📄 Licença

Este sistema é proprietário e seu uso está sujeito aos termos de licença específicos.

## 👨‍💻 Desenvolvimento

Sistema desenvolvido com foco em:
- **Performance**: Consultas otimizadas e cache inteligente
- **Segurança**: Validações robustas e proteções avançadas
- **Usabilidade**: Interface intuitiva e responsiva
- **Manutenibilidade**: Código limpo e bem documentado
- **Escalabilidade**: Arquitetura preparada para crescimento

---

**© 2025 Sistema de Ocorrências - Todos os direitos reservados**

