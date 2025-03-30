# Projeto Integrador 1

## Descrição

Este é um projeto de aplicação web funcional, desenvolvido como parte do Projeto Integrador 1. O objetivo é aplicar conhecimentos adquiridos para solucionar uma necessidade real da sociedade.

---

## Instalação e Configuração

### **1. Requisitos**

- [XAMPP](https://www.apachefriends.org/) (para Windows) ou [LAMPP](https://www.apachefriends.org/) (para Linux)
- PHP 8 ou superior
- MySQL
- Navegador atualizado (Chrome, Firefox, Edge, etc.)

### **2. Instalação do Servidor**

#### **Windows:**

1. Baixe e instale o [XAMPP](https://www.apachefriends.org/).
2. Copie a pasta do projeto para `C:\xampp\htdocs\ProjetoIntegrador1`.
3. Inicie o `XAMPP Control Panel` e ative os serviços **Apache** e **MySQL**.

#### **Linux:**

1. Baixe e instale o [LAMPP](https://www.apachefriends.org/).
2. Mova a pasta do projeto para `/opt/lampp/htdocs/ProjetoIntegrador1`:
   ```sh
   sudo mv ProjetoIntegrador1 /opt/lampp/htdocs/
   ```
3. Inicie os serviços do Apache e MySQL:
   ```sh
   sudo /opt/lampp/lampp start
   ```

### **3. Acesso ao Projeto**

Após iniciar o servidor, acesse o sistema pelo navegador digitando:

```
http://localhost/ProjetoIntegrador1/
```

---

## Configuração do Banco de Dados

O banco de dados é criado automaticamente na primeira execução do projeto.

- **Banco de dados:** `biblioteca`

Caso necessite acessar o banco diretamente:

1. Abra o phpMyAdmin em `http://localhost/phpmyadmin/`.
2. Verifique se o banco `biblioteca` foi criado corretamente.

---

## Usuário Administrador

Na primeira execução do sistema, um usuário administrador padrão será criado automaticamente. Esse usuário tem permissão para criar novos usuários e gerenciar o sistema.

- **Usuário:** `admin`
- **Senha:** `admin`

Por questões de segurança, recomenda-se alterar a senha do usuário administrador após o primeiro login.

---

## Funcionalidades

✅ Cadastro de leitores

✅ Cadastro de usuários

✅ Gerenciamento de empréstimos

✅ Registro de histórico de alterações

---

## Contribuição

Caso queira contribuir para o projeto:

1. Faça um fork deste repositório.
2. Crie um branch com sua feature: `git checkout -b minha-feature`
3. Faça commit das suas alterações: `git commit -m 'Adicionando nova funcionalidade'`
4. Envie para o branch principal: `git push origin minha-feature`
5. Envie um Pull Request.

---

## Licença

Este projeto está sob a Licença MIT - veja o arquivo `LICENSE` para mais detalhes.

