#!/bin/bash

# Jalankan migrasi database dan seeding (data awal)
php artisan migrate --force
php artisan db:seed --force

# Pastikan link storage ada
php artisan storage:link

# Jalankan Apache (Perintah utama Docker)
apache2-foreground
