#!/bin/bash

# Run only the PdfGenerationTest via Docker Compose
docker-compose exec app php artisan test --filter=PdfGenerationTest
