#!/bin/bash
echo "Building and starting the attendance-baba application..."

# Build the Docker image
docker-compose build

# Start the containers
docker-compose up -d

echo "Attendance-baba application is now running:"
echo "Backend API: http://localhost:8000"
echo "Frontend: http://localhost:3000"
