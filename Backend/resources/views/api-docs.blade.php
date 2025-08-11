@extends('layouts.app')

@section('title', 'API Documentation')

@section('content')
<div class="api-docs">
    <div class="container">
        <div class="header">
            <h1>Laravel API Documentation</h1>
            <p class="description">Explore and test the available RESTful API endpoints</p>
        </div>

        <div class="api-section"> 
            <h2>Authentication</h2>
            
            <div class="endpoint">
                <div class="method post">POST</div>
                <div class="path">/api/login</div>
                <div class="summary">Authenticate user and get token</div>
                <button class="toggle-btn" onclick="toggleDetails(this)">Show Details</button>
                <div class="details hidden">
                    <h4>Request Body:</h4>
                    <pre>{
  "email": "user@example.com",
  "password": "password"
}</pre>
                    <h4>Responses:</h4>
                    <div class="response">
                        <span class="status success">200 OK</span>
                        <pre>{
  "token": "your-auth-token",
  "user": {
    "id": 1,
    "name": "User Name",
    "email": "user@example.com"
  }
}</pre>
                    </div>
                    <div class="response">
                        <span class="status error">401 Unauthorized</span>
                        <pre>{
  "message": "Invalid credentials"
}</pre>
                    </div>
                </div>
            </div>
            
            <div class="endpoint">
                <div class="method post">POST</div>
                <div class="path">/api/register</div>
                <div class="summary">Register a new user</div>
                <button class="toggle-btn" onclick="toggleDetails(this)">Show Details</button>
                <div class="details hidden">
                    <h4>Request Body:</h4>
                    <pre>{
  "name": "New User",
  "email": "newuser@example.com",
  "password": "password",
  "password_confirmation": "password"
}</pre>
                    <h4>Responses:</h4>
                    <div class="response">
                        <span class="status success">201 Created</span>
                        <pre>{
  "message": "User registered successfully",
  "user": {
    "id": 1,
    "name": "New User",
    "email": "newuser@example.com"
  }
}</pre>
                    </div>
                </div>
            </div>
        </div>

        <div class="api-section">
            <h2>Students</h2>
            
            <div class="endpoint">
                <div class="method get">GET</div>
                <div class="path">/api/students</div>
                <div class="summary">List all students</div>
                <button class="toggle-btn" onclick="toggleDetails(this)">Show Details</button>
                <div class="details hidden">
                    <h4>Query Parameters:</h4>
                    <table class="params">
                        <tr>
                            <td><code>page</code></td>
                            <td>Page number for pagination (optional)</td>
                        </tr>
                        <tr>
                            <td><code>per_page</code></td>
                            <td>Items per page (optional, default: 15)</td>
                        </tr>
                    </table>
                    <h4>Responses:</h4>
                    <div class="response">
                        <span class="status success">200 OK</span>
                        <pre>{
  "data": [
    {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "created_at": "2025-08-06T12:00:00Z",
      "updated_at": "2025-08-06T12:00:00Z"
    },
    // More students...
  ],
  "links": {
    "first": "http://localhost:8000/api/students?page=1",
    "last": "http://localhost:8000/api/students?page=5",
    "prev": null,
    "next": "http://localhost:8000/api/students?page=2"
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 5,
    "path": "http://localhost:8000/api/students",
    "per_page": 15,
    "to": 15,
    "total": 68
  }
}</pre>
                    </div>
                </div>
            </div>
            
            <div class="endpoint">
                <div class="method get">GET</div>
                <div class="path">/api/students/{id}</div>
                <div class="summary">Get a specific student by ID</div>
                <button class="toggle-btn" onclick="toggleDetails(this)">Show Details</button>
                <div class="details hidden">
                    <h4>Path Parameters:</h4>
                    <table class="params">
                        <tr>
                            <td><code>id</code></td>
                            <td>The ID of the student</td>
                        </tr>
                    </table>
                    <h4>Responses:</h4>
                    <div class="response">
                        <span class="status success">200 OK</span>
                        <pre>{
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "created_at": "2025-08-06T12:00:00Z",
    "updated_at": "2025-08-06T12:00:00Z"
  }
}</pre>
                    </div>
                    <div class="response">
                        <span class="status error">404 Not Found</span>
                        <pre>{
  "message": "Student not found"
}</pre>
                    </div>
                </div>
            </div>
            
            <div class="endpoint">
                <div class="method post">POST</div>
                <div class="path">/api/students</div>
                <div class="summary">Create a new student</div>
                <button class="toggle-btn" onclick="toggleDetails(this)">Show Details</button>
                <div class="details hidden">
                    <h4>Request Body:</h4>
                    <pre>{
  "name": "Jane Smith",
  "email": "jane@example.com"
}</pre>
                    <h4>Responses:</h4>
                    <div class="response">
                        <span class="status success">201 Created</span>
                        <pre>{
  "data": {
    "id": 69,
    "name": "Jane Smith",
    "email": "jane@example.com",
    "created_at": "2025-08-06T13:30:00Z",
    "updated_at": "2025-08-06T13:30:00Z"
  },
  "message": "Student created successfully"
}</pre>
                    </div>
                    <div class="response">
                        <span class="status error">422 Unprocessable Entity</span>
                        <pre>{
  "message": "The given data was invalid.",
  "errors": {
    "name": [
      "The name field is required."
    ],
    "email": [
      "The email must be a valid email address."
    ]
  }
}</pre>
                    </div>
                </div>
            </div>
            
            <div class="endpoint">
                <div class="method put">PUT</div>
                <div class="path">/api/students/{id}</div>
                <div class="summary">Update a student</div>
                <button class="toggle-btn" onclick="toggleDetails(this)">Show Details</button>
                <div class="details hidden">
                    <h4>Path Parameters:</h4>
                    <table class="params">
                        <tr>
                            <td><code>id</code></td>
                            <td>The ID of the student to update</td>
                        </tr>
                    </table>
                    <h4>Request Body:</h4>
                    <pre>{
  "name": "Jane Smith Updated",
  "email": "jane.updated@example.com"
}</pre>
                    <h4>Responses:</h4>
                    <div class="response">
                        <span class="status success">200 OK</span>
                        <pre>{
  "data": {
    "id": 1,
    "name": "Jane Smith Updated",
    "email": "jane.updated@example.com",
    "created_at": "2025-08-06T12:00:00Z",
    "updated_at": "2025-08-06T14:00:00Z"
  },
  "message": "Student updated successfully"
}</pre>
                    </div>
                    <div class="response">
                        <span class="status error">404 Not Found</span>
                        <pre>{
  "message": "Student not found"
}</pre>
                    </div>
                </div>
            </div>
            
            <div class="endpoint">
                <div class="method delete">DELETE</div>
                <div class="path">/api/students/{id}</div>
                <div class="summary">Delete a student</div>
                <button class="toggle-btn" onclick="toggleDetails(this)">Show Details</button>
                <div class="details hidden">
                    <h4>Path Parameters:</h4>
                    <table class="params">
                        <tr>
                            <td><code>id</code></td>
                            <td>The ID of the student to delete</td>
                        </tr>
                    </table>
                    <h4>Responses:</h4>
                    <div class="response">
                        <span class="status success">200 OK</span>
                        <pre>{
  "message": "Student deleted successfully"
}</pre>
                    </div>
                    <div class="response">
                        <span class="status error">404 Not Found</span>
                        <pre>{
  "message": "Student not found"
}</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .api-docs {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        padding: 20px;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .header {
        margin-bottom: 40px;
        border-bottom: 1px solid #e1e4e8;
        padding-bottom: 20px;
    }
    
    .header h1 {
        font-size: 36px;
        margin-bottom: 10px;
    }
    
    .description {
        font-size: 18px;
        color: #6a737d;
    }
    
    .api-section {
        margin-bottom: 40px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        padding: 20px;
    }
    
    .api-section h2 {
        border-bottom: 1px solid #e1e4e8;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    
    .endpoint {
        border: 1px solid #e1e4e8;
        border-radius: 5px;
        margin-bottom: 15px;
        overflow: hidden;
    }
    
    .endpoint > div {
        padding: 10px 15px;
        display: inline-block;
        vertical-align: middle;
    }
    
    .method {
        font-weight: bold;
        color: white;
        width: 80px;
        text-align: center;
    }
    
    .get {
        background-color: #61affe;
    }
    
    .post {
        background-color: #49cc90;
    }
    
    .put {
        background-color: #fca130;
    }
    
    .delete {
        background-color: #f93e3e;
    }
    
    .path {
        font-family: monospace;
        font-size: 14px;
        width: 250px;
    }
    
    .summary {
        color: #3b4151;
    }
    
    .toggle-btn {
        float: right;
        margin: 10px;
        padding: 8px 15px;
        background-color: #f1f1f1;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    
    .toggle-btn:hover {
        background-color: #ddd;
    }
    
    .details {
        padding: 0 15px 15px;
        background-color: #fafafa;
        border-top: 1px solid #e1e4e8;
        clear: both;
    }
    
    .hidden {
        display: none;
    }
    
    pre {
        background-color: #272822;
        color: #f8f8f2;
        padding: 15px;
        border-radius: 5px;
        overflow-x: auto;
        font-size: 14px;
    }
    
    .params {
        width: 100%;
        border-collapse: collapse;
    }
    
    .params td {
        padding: 8px;
        border-bottom: 1px solid #e1e4e8;
    }
    
    .params td:first-child {
        width: 20%;
    }
    
    .status {
        padding: 3px 10px;
        border-radius: 3px;
        font-size: 12px;
        font-weight: bold;
        display: inline-block;
        margin-bottom: 5px;
    }
    
    .success {
        background-color: #49cc90;
        color: white;
    }
    
    .error {
        background-color: #f93e3e;
        color: white;
    }
    
    .response {
        margin-bottom: 15px;
    }
</style>

<script>
    function toggleDetails(button) {
        const details = button.nextElementSibling;
        if (details.classList.contains('hidden')) {
            details.classList.remove('hidden');
            button.textContent = 'Hide Details';
        } else {
            details.classList.add('hidden');
            button.textContent = 'Show Details';
        }
    }
</script>
@endsection
