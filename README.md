## Overview

The IP Address Checker project is a cloud-native microservice application designed to validate, classify, and enrich IP addresses. Each service—built in Python, Node.js, and PHP—handles a dedicated function and is containerised with Docker. Services are orchestrated through Kubernetes via Rancher and integrated with automated CI/CD pipelines. A custom Node.js reverse proxy routes requests to the correct service, manages cross-origin headers, and centralises error handling, enabling scalable, independent, and fault-tolerant operation. The system communicates via REST APIs, ensuring seamless interactions between services and any frontend clients. Each microservice also includes a dedicated test suite, namely unittest for Python, Jest for Node.js, and PHPUnit for PHP, to verify functionality and enforce reliability across the CI/CD pipeline.

**Technologies used**

Python (Flask), Node.js (Express), PHP, Docker, Kubernetes (Rancher), GitLab CI/CD, unittest, Jest, PHPUnit
