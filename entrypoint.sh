#!/bin/bash

# Jalankan migrasi database
php artisan migrate --force

# Pastikan link storage ada
php artisan storage:link

# Jalankan Apache (Perintah utama Docker)
apache2-foreground
