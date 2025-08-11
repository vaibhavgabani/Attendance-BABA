# 🚀 Attendance-BABA Frontend

This is the React frontend for the Attendance-BABA application, built with React and Vite.

## 📋 Requirements

- Node.js 18.x or higher
- npm 9.x or higher

## ⚡ Local Development Setup

### Clone and Setup

1. Clone the repository (if you haven't already):
   ```bash
   git clone https://github.com/vaibhavgabani/Attendance-BABA.git
   cd Attendance-BABA/Frontend
   ```

2. Install dependencies:
   ```bash
   npm install
   ```

3. Create environment file:
   ```bash
   cp .env.example .env
   ```
   Edit the `.env` file to configure your API endpoint (backend URL)

4. Start the development server:
   ```bash
   npm run dev
   ```

5. The application will be available at:
   ```
   http://localhost:5173
   ```

## 🏗️ Build for Production

To build the frontend for production:

```bash
npm run build
```

The build output will be in the `dist` directory.

## 🧪 Testing

Run tests with:

```bash
npm test
```

## 🔄 API Connection

By default, the frontend will try to connect to the backend API at `http://localhost:8000/api`. You can change this by modifying the `.env` file.

## 📚 Additional Information

- This project uses Vite as the build tool
- React 18+ is the primary frontend framework
- The application communicates with the Laravel backend through RESTful API calls
