#!/bin/bash
# Set these variables to your Docker Hub username and desired image name
DOCKER_USERNAME=vaibhavgabani
IMAGE_NAME=attendance-baba
TAG=latest

echo "Building Docker image..."
docker-compose build

echo "Tagging Docker image..."
docker tag $IMAGE_NAME $DOCKER_USERNAME/$IMAGE_NAME:$TAG

echo "Logging into Docker Hub..."
docker login

echo "Pushing image to Docker Hub..."
docker push $DOCKER_USERNAME/$IMAGE_NAME:$TAG

echo "Docker image pushed successfully!"
echo "Image: $DOCKER_USERNAME/$IMAGE_NAME:$TAG"
