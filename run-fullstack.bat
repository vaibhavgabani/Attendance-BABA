@echo off
echo Building and starting the attendance-baba application...

REM Build the Docker image
docker-compose build

REM Start the containers
docker-compose up -d

echo attendance-baba application is now running:
echo Backend API: http://localhost:8000
echo Frontend: http://localhost:3000
