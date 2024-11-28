
# Facebook Conversions Hub API

API para integração com o **Facebook Conversion API**, permitindo o envio de eventos personalizados de forma simples e centralizada.

---

## 🛠️ Estrutura do Projeto

```
/facebook-conversions-hub
|-- /src
|   |-- FacebookConversions.php  # Classe principal com a lógica da API
|-- /config
|   |-- config.php               # Configurações gerais (token, URLs, etc.)
|-- /public
|   |-- index.php                # Ponto de entrada principal da API
|   |-- swagger.php              # Documentação JSON gerada com Swagger
|-- composer.json                # Dependências do projeto
|-- vendor/                      # Dependências instaladas pelo Composer
```

---

## 🚀 **Como Usar**

### 1. **Enviar um Evento**
Envie uma requisição `POST` para o endpoint:

**URL**: `https://seu-dominio.com/facebook-conversions-hub/public/`

**Cabeçalhos**:
- `Content-Type: application/json`

**Body** (JSON):
```json
{
  "event_name": "Purchase",
  "event_data": {
    "user_data": {
      "em": "HASH_DO_EMAIL",
      "ph": "HASH_DO_TELEFONE"
    },
    "custom_data": {
      "currency": "USD",
      "value": 100.0
    }
  }
}
```

#### **Parâmetros do Body**
- `access_token` (**obrigatório**): Seu token do Facebook para autenticação.
- `event_name` (**obrigatório**): Nome do evento (e.g., `Purchase`, `Lead`, `AddToCart`).
- `event_data` (**obrigatório**): Dados relacionados ao evento.
  - `user_data`: Dados do usuário (email e telefone **hasheados com SHA-256**).
  - `custom_data`: Dados personalizados (ex.: valor da compra, moeda, etc.).

---

## 🌟 **Eventos Suportados**

A API suporta qualquer evento aceito pelo Facebook Conversion API, incluindo, mas não se limitando a:

- `Purchase` (Compra): Indica que uma transação foi realizada.
- `Lead` (Lead): Captura de interesse, como cadastro em formulário.
- `AddToCart` (Adicionar ao Carrinho): Quando o usuário adiciona um item ao carrinho.
- `InitiateCheckout` (Início de Checkout): Quando o checkout é iniciado.
- `ViewContent` (Visualizar Conteúdo): Indica que uma página ou produto foi visualizado.

---

## 🧑‍💻 **Como Executar Localmente**

1. Instale as dependências do projeto:
   ```bash
   composer install
   ```

2. Configure o arquivo `/config/config.php` com:
   - Seu token de acesso ao Facebook
   - Outras configurações necessárias.

3. Inicie um servidor local:
   ```bash
   php -S localhost:8000 -t public/
   ```

4. Acesse a API em: `http://localhost:8000`

---

## 📚 **Documentação JSON**

A documentação da API está disponível em JSON no endpoint:

**URL**: `https://seu-dominio.com/facebook-conversions-hub/public/swagger`

---

## 🛡️ **Requisitos**
- **PHP 7.4+**
- **Composer** instalado

---

## 🛠️ **Futuras Melhorias**
- Adicionar autenticação com chaves específicas por cliente.
- Implementar logs para auditoria dos eventos enviados.
- Melhorar tratamento de erros para dados inválidos.

---

## 📝 **Licença**
Este projeto é licenciado sob a [MIT License](LICENSE).
