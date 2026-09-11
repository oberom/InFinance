Aqui está o arquivo completo finalizado, com as **Seções 5 (Orçamentos)** e **6 (Metas)** integradas. Basta copiar e substituir todo o conteúdo no seu arquivo `API_DOCUMENTATION.md` no Sublime Text:

```markdown
# Documentação da API RESTful — Infinance

## Visão Geral
- **Base URL (Local/XAMPP):** `http://localhost/Infinance/public/api`
- **Base URL (Artisan Serve):** `http://127.0.0.1:8000/api`
- **Formato de Requisição & Resposta:** `application/json`
- **Autenticação:** HTTP Bearer Token (Laravel Sanctum)

---

## 1. Autenticação

### Registrar Novo Usuário
Cria uma nova conta na plataforma e retorna o token de acesso.

* **POST** `/registro`
* **Headers:** `Content-Type: application/json`, `Accept: application/json`
* **Body:**
```json
{
  "name": "Nome do Usuário",
  "email": "usuario@email.com",
  "password": "senha_com_no_minimo_8_caracteres",
  "termos_aceitos": true
}

```

* **Resposta de Sucesso (201 Created):**

```json
{
  "mensagem": "Usuário cadastrado com sucesso",
  "usuario": {
    "id": 1,
    "name": "Nome do Usuário",
    "email": "usuario@email.com",
    "plano": "gratuito",
    "biometria_ativa": false,
    "created_at": "2026-09-11T10:00:00.000000Z"
  },
  "token": "1|abc123tokenexemplo...",
  "token_type": "Bearer"
}

```

---

### Realizar Login

Autentica o usuário e retorna um novo token.

* **POST** `/login`
* **Headers:** `Content-Type: application/json`, `Accept: application/json`
* **Body:**

```json
{
  "email": "usuario@email.com",
  "password": "senha_do_usuario"
}

```

* **Resposta de Sucesso (200 OK):**

```json
{
  "mensagem": "Login realizado com sucesso",
  "usuario": {
    "id": 1,
    "name": "Nome do Usuário",
    "email": "usuario@email.com",
    "plano": "gratuito"
  },
  "token": "2|xyz987tokenexemplo...",
  "token_type": "Bearer"
}

```

---

### Encerrar Sessão (Logout)

Revoga o token de acesso atual.

* **POST** `/logout`
* **Headers:** `Authorization: Bearer {TOKEN}`
* **Resposta de Sucesso (200 OK):**

```json
{
  "mensagem": "Logout realizado e token revogado com sucesso"
}

```

---

## 2. Categorias

*(Requisições autenticadas exigem o header `Authorization: Bearer {TOKEN}`. A listagem sem token retorna apenas as categorias padrão).*

| Método | Endpoint | Descrição |
| --- | --- | --- |
| `GET` | `/categorias` | Lista categorias padrão e personalizadas |
| `POST` | `/categorias` | Cria uma categoria personalizada |
| `GET` | `/categorias/{id}` | Retorna detalhes de uma categoria específica |
| `PUT/PATCH` | `/categorias/{id}` | Atualiza uma categoria |
| `DELETE` | `/categorias/{id}` | Remove uma categoria |

---

### Listar Categorias

Retorna a lista de categorias disponíveis para o usuário.

* **GET** `/categorias`
* **Headers:** `Authorization: Bearer {TOKEN}`, `Accept: application/json`
* **Resposta de Sucesso (200 OK):**

```json
[
  {
    "id": 1,
    "nome": "Alimentação",
    "tipo": "despesa",
    "icone": "fast-food",
    "padrao": true
  },
  {
    "id": 12,
    "nome": "Investimentos Cripto",
    "tipo": "receita",
    "icone": "bitcoin",
    "padrao": false
  }
]

```

---

### Criar Categoria

Cria uma nova categoria associada ao usuário autenticado.

* **POST** `/categorias`
* **Headers:** `Authorization: Bearer {TOKEN}`, `Content-Type: application/json`, `Accept: application/json`
* **Body:**

```json
{
  "nome": "Investimentos Cripto",
  "tipo": "receita",
  "icone": "bitcoin"
}

```

* **Resposta de Sucesso (201 Created):**

```json
{
  "mensagem": "Categoria criada com sucesso",
  "categoria": {
    "id": 12,
    "user_id": 1,
    "nome": "Investimentos Cripto",
    "tipo": "receita",
    "icone": "bitcoin",
    "created_at": "2026-09-11T10:00:00.000000Z"
  }
}

```

---

## 3. Contas Bancárias

*(Todas as rotas exigem o header `Authorization: Bearer {TOKEN}`).*

| Método | Endpoint | Descrição |
| --- | --- | --- |
| `GET` | `/contas` | Lista todas as contas do usuário |
| `POST` | `/contas` | Cadastra uma nova conta bancária ou carteira |
| `GET` | `/contas/{id}` | Retorna os detalhes e saldo de uma conta |
| `PUT/PATCH` | `/contas/{id}` | Atualiza dados da conta |
| `DELETE` | `/contas/{id}` | Remove uma conta |

---

### Listar Contas

Retorna todas as contas cadastradas pelo usuário.

* **GET** `/contas`
* **Headers:** `Authorization: Bearer {TOKEN}`, `Accept: application/json`
* **Resposta de Sucesso (200 OK):**

```json
[
  {
    "id": 1,
    "nome": "Nubank Principal",
    "tipo": "conta_corrente",
    "saldo_inicial": 1500.00,
    "saldo_atual": 2350.50,
    "cor": "#8A05BE"
  },
  {
    "id": 2,
    "nome": "Carteira Física",
    "tipo": "dinheiro",
    "saldo_inicial": 200.00,
    "saldo_atual": 50.00,
    "cor": "#2ECC71"
  }
]

```

---

### Criar Conta Bancária

Cadastra uma nova conta para controle de saldo.

* **POST** `/contas`
* **Headers:** `Authorization: Bearer {TOKEN}`, `Content-Type: application/json`, `Accept: application/json`
* **Body:**

```json
{
  "nome": "Nubank Principal",
  "tipo": "conta_corrente",
  "saldo_inicial": 1500.00,
  "cor": "#8A05BE"
}

```

* **Resposta de Sucesso (201 Created):**

```json
{
  "mensagem": "Conta cadastrada com sucesso",
  "conta": {
    "id": 1,
    "user_id": 1,
    "nome": "Nubank Principal",
    "tipo": "conta_corrente",
    "saldo_inicial": 1500.00,
    "saldo_atual": 1500.00,
    "cor": "#8A05BE",
    "created_at": "2026-09-11T10:00:00.000000Z"
  }
}

```

---

## 4. Transações (Receitas e Despesas)

*(Todas as rotas exigem o header `Authorization: Bearer {TOKEN}`).*

| Método | Endpoint | Descrição |
| --- | --- | --- |
| `GET` | `/transacoes` | Lista todas as transações com suporte a filtros |
| `POST` | `/transacoes` | Cria uma nova transação (receita ou despesa) |
| `GET` | `/transacoes/{id}` | Retorna detalhes de uma transação específica |
| `PUT/PATCH` | `/transacoes/{id}` | Atualiza os dados de uma transação |
| `DELETE` | `/transacoes/{id}` | Remove uma transação e estorna o valor no saldo |

---

### Listar Transações

Retorna o histórico de movimentações financeiras.

* **GET** `/transacoes`
* **Query Params (Opcionais):** `?tipo=despesa&categoria_id=1&mes=09&ano=2026`
* **Headers:** `Authorization: Bearer {TOKEN}`, `Accept: application/json`
* **Resposta de Sucesso (200 OK):**

```json
[
  {
    "id": 101,
    "descricao": "Supermercado",
    "valor": 250.75,
    "tipo": "despesa",
    "data": "2026-09-10",
    "pago": true,
    "conta_id": 1,
    "categoria_id": 1,
    "created_at": "2026-09-10T14:30:00.000000Z"
  }
]

```

---

### Criar Transação

Registra uma nova receita ou despesa e atualiza o saldo da conta associada.

* **POST** `/transacoes`
* **Headers:** `Authorization: Bearer {TOKEN}`, `Content-Type: application/json`, `Accept: application/json`
* **Body:**

```json
{
  "descricao": "Supermercado",
  "valor": 250.75,
  "tipo": "despesa",
  "data": "2026-09-10",
  "pago": true,
  "conta_id": 1,
  "categoria_id": 1
}

```

* **Resposta de Sucesso (201 Created):**

```json
{
  "mensagem": "Transação registrada com sucesso",
  "transacao": {
    "id": 101,
    "user_id": 1,
    "descricao": "Supermercado",
    "valor": 250.75,
    "tipo": "despesa",
    "data": "2026-09-10",
    "pago": true,
    "conta_id": 1,
    "categoria_id": 1,
    "created_at": "2026-09-11T10:00:00.000000Z"
  }
}

```

---

## 5. Orçamentos

*(Todas as rotas exigem o header `Authorization: Bearer {TOKEN}`).*

| Método | Endpoint | Descrição |
| --- | --- | --- |
| `GET` | `/orcamentos` | Lista os limites de gastos definidos por categoria |
| `POST` | `/orcamentos` | Define um teto de gastos para uma categoria em determinado mês |
| `GET` | `/orcamentos/{id}` | Exibe o status atual e progresso do orçamento |
| `PUT/PATCH` | `/orcamentos/{id}` | Atualiza o valor limite de um orçamento |
| `DELETE` | `/orcamentos/{id}` | Remove um orçamento cadastrado |

---

### Listar Orçamentos

Retorna os limites de gastos configurados e o valor já consumido no mês.

* **GET** `/orcamentos`
* **Query Params (Opcionais):** `?mes=09&ano=2026`
* **Headers:** `Authorization: Bearer {TOKEN}`, `Accept: application/json`
* **Resposta de Sucesso (200 OK):**

```json
[
  {
    "id": 5,
    "categoria_id": 1,
    "categoria_nome": "Alimentação",
    "valor_limite": 1000.00,
    "valor_gasto": 250.75,
    "porcentagem_usada": 25.08,
    "mes": 9,
    "ano": 2026
  }
]

```

---

### Criar Orçamento

Define um limite máximo de gastos para uma categoria em um mês específico.

* **POST** `/orcamentos`
* **Headers:** `Authorization: Bearer {TOKEN}`, `Content-Type: application/json`, `Accept: application/json`
* **Body:**

```json
{
  "categoria_id": 1,
  "valor_limite": 1000.00,
  "mes": 9,
  "ano": 2026
}

```

* **Resposta de Sucesso (201 Created):**

```json
{
  "mensagem": "Orçamento definido com sucesso",
  "orcamento": {
    "id": 5,
    "user_id": 1,
    "categoria_id": 1,
    "valor_limite": 1000.00,
    "mes": 9,
    "ano": 2026,
    "created_at": "2026-09-11T10:00:00.000000Z"
  }
}

```

---

## 6. Metas Financeiras

*(Todas as rotas exigem o header `Authorization: Bearer {TOKEN}`).*

| Método | Endpoint | Descrição |
| --- | --- | --- |
| `GET` | `/metas` | Lista todas as metas de economia cadastradas |
| `POST` | `/metas` | Cria um novo objetivo de economia |
| `POST` | `/metas/{id}/depositar` | Adiciona um valor acumulado à meta |
| `PUT/PATCH` | `/metas/{id}` | Edita os dados de uma meta existente |
| `DELETE` | `/metas/{id}` | Exclui uma meta cadastrada |

---

### Listar Metas

Retorna o progresso das economias para objetivos futuros.

* **GET** `/metas`
* **Headers:** `Authorization: Bearer {TOKEN}`, `Accept: application/json`
* **Resposta de Sucesso (200 OK):**

```json
[
  {
    "id": 10,
    "titulo": "Reserva de Emergência",
    "valor_alvo": 10000.00,
    "valor_atual": 2500.00,
    "data_limite": "2026-12-31",
    "porcentagem_concluida": 25.00,
    "concluida": false
  }
]

```

---

### Criar Meta

Cria um novo objetivo financeiro com valor-alvo e data de conclusão.

* **POST** `/metas`
* **Headers:** `Authorization: Bearer {TOKEN}`, `Content-Type: application/json`, `Accept: application/json`
* **Body:**

```json
{
  "titulo": "Reserva de Emergência",
  "valor_alvo": 10000.00,
  "valor_inicial": 2500.00,
  "data_limite": "2026-12-31"
}

```

* **Resposta de Sucesso (201 Created):**

```json
{
  "mensagem": "Meta criada com sucesso",
  "meta": {
    "id": 10,
    "user_id": 1,
    "titulo": "Reserva de Emergência",
    "valor_alvo": 10000.00,
    "valor_atual": 2500.00,
    "data_limite": "2026-12-31",
    "concluida": false,
    "created_at": "2026-09-11T10:00:00.000000Z"
  }
}

```

---

### Aportar na Meta

Adiciona um valor ao montante acumulado de uma meta existente.

* **POST** `/metas/{id}/depositar`
* **Headers:** `Authorization: Bearer {TOKEN}`, `Content-Type: application/json`, `Accept: application/json`
* **Body:**

```json
{
  "valor": 500.00
}

```

* **Resposta de Sucesso (200 OK):**

```json
{
  "mensagem": "Depósito na meta realizado com sucesso",
  "meta": {
    "id": 10,
    "titulo": "Reserva de Emergência",
    "valor_alvo": 10000.00,
    "valor_atual": 3000.00,
    "porcentagem_concluida": 30.00,
    "concluida": false
  }
}

```

