<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation</title>
</head>
<body>

    <h1>API Documentation</h1>

    <h2>Authentication</h2>
    <p>Before accessing the email-related routes, you need to authenticate and obtain a token.</p>

    <h3>1. Login</h3>
    <p><strong>POST /login</strong></p>
    <p><strong>Request Body (Example):</strong></p>
    <pre>
    {
        "email": "your-email@example.com",
        "password": "your-password"
    }
    </pre>
    <p><strong>Response:</strong></p>
    <ul>
        <li><strong>200 OK</strong>: Returns an access token that must be used for all protected routes.</li>
    </ul>
    <p><strong>Example Response:</strong></p>
    <pre>
    {
        "token": "your-access-token"
    }
    </pre>
    <p>Use the returned token in the <code>Authorization</code> header for all subsequent requests:</p>
    <pre>
    Authorization: Bearer {token}
    </pre>

    <h2>Protected Email Endpoints</h2>
    <p>All email-related routes are protected and require a valid token obtained from the <code>/login</code> route. Use the token in the <code>Authorization</code> header for each request.</p>

    <h3>1. Create Email Record</h3>
    <p><strong>POST /emails</strong></p>
    <p><strong>Request Body (Example):</strong></p>
    <pre>
    {
        "affiliate_id": 12345,
        "envelope": { "from": "test@example.com" },
        "from": "sender@example.com",
        "subject": "Test Subject",
        "dkim": "test-dkim",
        "SPF": "pass",
        "spam_score": 5.0,
        "email": "&lt;html&gt;Test email content&lt;/html&gt;",
        "sender_ip": "127.0.0.1",
        "to": "receiver@example.com"
    }
    </pre>
    <p><strong>Response:</strong></p>
    <ul>
        <li><strong>201 Created</strong>: Returns the created email record.</li>
        <li><strong>422 Unprocessable Entity</strong>: If there are validation errors.</li>
    </ul>

    <h3>2. Get Email Record by ID</h3>
    <p><strong>GET /emails/{id}</strong></p>
    <p><strong>Response:</strong></p>
    <ul>
        <li><strong>200 OK</strong>: Returns the email record.</li>
        <li><strong>404 Not Found</strong>: If the email record is not found.</li>
    </ul>

    <h3>3. Update Email Record</h3>
    <p><strong>PUT /emails/{id}</strong></p>
    <p><strong>Request Body (Example):</strong></p>
    <pre>
    {
        "affiliate_id": 54321,
        "from": "updated@example.com",
        "subject": "Updated Subject",
        "email": "&lt;html&gt;Updated email content&lt;/html&gt;"
    }
    </pre>
    <p><strong>Response:</strong></p>
    <ul>
        <li><strong>200 OK</strong>: Returns the updated email record.</li>
        <li><strong>422 Unprocessable Entity</strong>: If there are validation errors.</li>
    </ul>

    <h3>4. Delete Email Record (Soft Delete)</h3>
    <p><strong>DELETE /emails/{id}</strong></p>
    <p><strong>Response:</strong></p>
    <ul>
        <li><strong>204 No Content</strong>: On successful deletion.</li>
        <li><strong>404 Not Found</strong>: If the email record is not found.</li>
    </ul>

    <h3>5. List All Emails</h3>
    <p><strong>GET /emails</strong></p>
    <p><strong>Response:</strong></p>
    <ul>
        <li><strong>200 OK</strong>: Returns a list of all email records.</li>
    </ul>

    <h2>Using Postman or Insomnia for API Requests</h2>
    <p>You can use Postman or Insomnia to test these API endpoints. Below are steps and examples for each:</p>

    <h3>1. Authentication (Login)</h3>
    <p><strong>Method:</strong> POST</p>
    <p><strong>URL:</strong> http://your-server-ip-or-domain/login</p>
    <p><strong>Body:</strong> Raw JSON</p>
    <pre>
    {
        "email": "your-email@example.com",
        "password": "your-password"
    }
    </pre>

    <h3>2. Making Protected Requests</h3>
    <p>For any of the protected routes, such as creating, updating, or deleting an email, you need to include the token in the <code>Authorization</code> header:</p>

    <h4>Header Example:</h4>
    <pre>
    Authorization: Bearer {your-access-token}
    </pre>

    <h3>3. Creating an Email Record</h3>
    <p><strong>Method:</strong> POST</p>
    <p><strong>URL:</strong> http://your-server-ip-or-domain/emails</p>
    <p><strong>Headers:</strong></p>
    <ul>
        <li>Authorization: Bearer {your-access-token}</li>
        <li>Content-Type: application/json</li>
    </ul>
    <p><strong>Body:</strong> Raw JSON</p>
    <pre>
    {
        "affiliate_id": 12345,
        "envelope": { "from": "test@example.com" },
        "from": "sender@example.com",
        "subject": "Test Subject",
        "dkim": "test-dkim",
        "SPF": "pass",
        "spam_score": 5.0,
        "email": "&lt;html&gt;Test email content&lt;/html&gt;",
        "sender_ip": "127.0.0.1",
        "to": "receiver@example.com"
    }
    </pre>

    <h3>4. Updating an Email Record</h3>
    <p><strong>Method:</strong> PUT</p>
    <p><strong>URL:</strong> http://your-server-ip-or-domain/emails/{id}</p>
    <p><strong>Headers:</strong></p>
    <ul>
        <li>Authorization: Bearer {your-access-token}</li>
        <li>Content-Type: application/json</li>
    </ul>
    <p><strong>Body:</strong> Raw JSON</p>
    <pre>
    {
        "affiliate_id": 54321,
        "from": "updated@example.com",
        "subject": "Updated Subject",
        "email": "&lt;html&gt;Updated email content&lt;/html&gt;"
    }
    </pre>

    <h3>5. Getting a List of Emails</h3>
    <p><strong>Method:</strong> GET</p>
    <p><strong>URL:</strong> http://your-server-ip-or-domain/emails</p>
    <p><strong>Headers:</strong></p>
    <ul>
        <li>Authorization: Bearer {your-access-token}</li>
    </ul>

    <h3>6. Deleting an Email Record</h3>
    <p><strong>Method:</strong> DELETE</p>
    <p><strong>URL:</strong> http://your-server-ip-or-domain/emails/{id}</p>
    <p><strong>Headers:</strong></p>
    <ul>
        <li>Authorization: Bearer {your-access-token}</li>
    </ul>

    <h2>Example URLs</h2>
    <ul>
        <li>For local development, use: <code>http://localhost</code></li>
        <li>For production, replace with your server's IP or domain: <code>http://your-server-ip-or-domain</code></li>
    </ul>

</body>
</html>
