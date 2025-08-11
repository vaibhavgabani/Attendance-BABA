@echo off
REM Set these variables to your Docker Hub username and desired image name
set DOCKER_USERNAME=vaibhavgabani
set IMAGE_NAME=attendance-baba
set TAG=latest

echo Building Docker image...
docker-compose build

echo Tagging Docker image...
docker tag %IMAGE_NAME% %DOCKER_USERNAME%/%IMAGE_NAME%:%TAG%

echo Logging into Docker Hub...
docker login

echo Pushing image to Docker Hub...
docker push %DOCKER_USERNAME%/%IMAGE_NAME%:%TAG%

echo Docker image pushed successfully!
echo Image: %DOCKER_USERNAME%/%IMAGE_NAME%:%TAG%
echo.
echo To use this image, run:
echo docker pull %DOCKER_USERNAME%/%IMAGE_NAME%:%TAG%
echo docker run -d -p 8000:8000 -p 3000:3000 --name fullstack-app %DOCKER_USERNAME%/%IMAGE_NAME%:%TAG%
echo.
echo Access:
echo Backend API: http://localhost:8000/api
echo Frontend: http://localhost:3000
