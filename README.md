# 🚀 Full-Stack Attendance-Baba Application

This repository contains a Docker image that combines both the Laravel backend and React frontend into a single container, allowing for easy deployment and testing. The Laravel backend runs on port 8000, and the React frontend runs on port 3000.

## 📋 Requirements

- 🐳 Docker
- 🐙 Docker Compose

## ⚡ Quick Start

### For Windows Users 💻

1. Run the `run-fullstack.bat` script:
   ```
   run-fullstack.bat
   ```

### For Linux/Mac Users 🍎

1. Make the script executable:
   ```bash
   chmod +x run-fullstack.sh
   ```

2. Run the script:
   ```bash
   ./run-fullstack.sh
   ```

## 🐋 Using Docker Commands Directly

You can also run the container directly using Docker commands:

```bash
# Pull the Docker image from Docker Hub
docker pull vaibhavgabani/attendance-baba:latest

# Run the Docker container with the correct port mapping
docker run -d -p 3000:3000 -p 8000:8000 --name attendance-baba vaibhavgabani/attendance-baba:latest
```

## 🌐 Access the Application

Once the container is running, you can access the application at:
- 🖥️ Frontend: http://localhost:3000
- ⚙️ Backend API: http://localhost:8000/api

## 🏗️ Architecture

This Docker image contains:
- 🐘 PHP 8.2 with Apache serving the Laravel backend on port 8000
- ⚛️ Node.js serving the React frontend on port 3000
- 👨‍💼 Supervisor to manage both services

## 🧪 Testing Notes

- 🗄️ The application uses a Railway MySQL database
- 🔐 Default credentials are configured in the docker-compose.yml file
- 🔌 All API routes are accessible via the /api prefix

## 📤 Pushing to Docker Hub

If you want to push your own version to Docker Hub:

1. Edit the `push-to-dockerhub.bat` (Windows) or `push-to-dockerhub.sh` (Linux/Mac) script:
   - Update the `DOCKER_USERNAME` variable with your Docker Hub username
   - Update the `IMAGE_NAME` if needed
   - Update the `TAG` if needed

2. Run the script to build, tag, and push the image:
   - Windows: `push-to-dockerhub.bat`
   - Linux/Mac: `chmod +x push-to-dockerhub.sh && ./push-to-dockerhub.sh`

## 👨‍💻 Development Notes

- 🔨 Frontend code is built during Docker image creation
- 🔄 Backend Laravel application serves the compiled frontend
- 🛣️ API routes are available at the /api prefix

## 🛠️ Troubleshooting

If you encounter issues:
1. Check Docker logs: `docker-compose logs`
2. Ensure ports are not already in use
3. Verify database connection settings

## 🧹 Cleaning Docker Environment

To clean up your Docker environment:

```bash
# Remove all containers
docker rm -f $(docker ps -aq)

# Remove all images
docker rmi -f $(docker images -q)
```

⚠️ **Warning**: These commands will remove ALL containers and images on your system, not just those related to this project.
