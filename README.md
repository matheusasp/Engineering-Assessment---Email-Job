  API Documentation

API Documentation
=================

Authentication
--------------

Before accessing the email-related routes, you need to authenticate and obtain a token.

### 1\. Login

**POST /login**

**Request Body (You can use this email and password to login):**

    {
        "email": "test@example.com",
        "password": "1234"
    }
    

**Response:**

*   **200 OK**: Returns an access token that must be used for all protected routes.

**Example Response:**

    {
        "token": "your-access-token"
    }
    

Use the returned token in the `Authorization` header for all subsequent requests:

    Authorization: Bearer {token}
    

Protected Email Endpoints
-------------------------

All email-related routes are protected and require a valid token obtained from the `/login` route. Use the token in the `Authorization` header for each request.

### 1\. Create Email Record

**POST /emails**

**Request Body (Example):**

    {
        "affiliate\_id": 12345,
        "envelope": { "from": "test@example.com" },
        "from": "sender@example.com",
        "subject": "Test Subject",
        "dkim": "test-dkim",
        "SPF": "pass",
        "spam\_score": 5.0,
        "email": "<html>Test email content</html>",
        "sender\_ip": "127.0.0.1",
        "to": "receiver@example.com"
    }
    

**Response:**

*   **201 Created**: Returns the created email record.
*   **422 Unprocessable Entity**: If there are validation errors.

### 2\. Get Email Record by ID

**GET /emails/{id}**

**Response:**

*   **200 OK**: Returns the email record.
*   **404 Not Found**: If the email record is not found.

### 3\. Update Email Record

**PUT /emails/{id}**

**Request Body (Example):**

    {
        "affiliate\_id": 54321,
        "from": "updated@example.com",
        "subject": "Updated Subject",
        "email": "<html>Updated email content</html>"
    }
    

**Response:**

*   **200 OK**: Returns the updated email record.
*   **422 Unprocessable Entity**: If there are validation errors.

### 4\. Delete Email Record (Soft Delete)

**DELETE /emails/{id}**

**Response:**

*   **204 No Content**: On successful deletion.
*   **404 Not Found**: If the email record is not found.

### 5\. List All Emails

**GET /emails**

**Response:**

*   **200 OK**: Returns a list of all email records.

Using Postman or Insomnia for API Requests
------------------------------------------

You can use Postman or Insomnia to test these API endpoints. Below are steps and examples for each:

### 1\. Authentication (Login)

**Method:** POST

**URL:** http://your-server-ip-or-domain/login

**Body:** Raw JSON

    {
        "email": "your-email@example.com",
        "password": "your-password"
    }
    

### 2\. Making Protected Requests

For any of the protected routes, such as creating, updating, or deleting an email, you need to include the token in the `Authorization` header:

#### Header Example:

    Authorization: Bearer {your-access-token}
    

### 3\. Creating an Email Record

**Method:** POST

**URL:** http://your-server-ip-or-domain/emails

**Headers:**

*   Authorization: Bearer {your-access-token}
*   Content-Type: application/json

**Body:** Raw JSON

    {
        "affiliate\_id": 12345,
        "envelope": { "from": "test@example.com" },
        "from": "sender@example.com",
        "subject": "Test Subject",
        "dkim": "test-dkim",
        "SPF": "pass",
        "spam\_score": 5.0,
        "email": "<html>Test email content</html>",
        "sender\_ip": "127.0.0.1",
        "to": "receiver@example.com"
    }
    

### 4\. Updating an Email Record

**Method:** PUT

**URL:** http://your-server-ip-or-domain/emails/{id}

**Headers:**

*   Authorization: Bearer {your-access-token}
*   Content-Type: application/json

**Body:** Raw JSON

    {
        "affiliate\_id": 54321,
        "from": "updated@example.com",
        "subject": "Updated Subject",
        "email": "<html>Updated email content</html>"
    }
    

### 5\. Getting a List of Emails

**Method:** GET

**URL:** http://your-server-ip-or-domain/emails

**Headers:**

*   Authorization: Bearer {your-access-token}

### 6\. Deleting an Email Record

**Method:** DELETE

**URL:** http://your-server-ip-or-domain/emails/{id}

**Headers:**

*   Authorization: Bearer {your-access-token}

Example URLs
------------

*   For local development, use: `http://localhost`
*   For production, replace with your server's IP or domain: `http://your-server-ip-or-domain`
