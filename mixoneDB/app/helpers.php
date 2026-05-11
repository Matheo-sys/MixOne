<?php

if (!function_exists('storage_url')) {
    /**
     * Helper global pour gérer les URLs de stockage (Local, S3 ou Cloudinary)
     */
    function storage_url($path) {
        if (empty($path)) return null;
        
        // Si c'est déjà une URL complète (ex: Cloudinary)
        if (str_starts_with($path, 'http')) {
            return $path;
        }
        
        // Sinon, on utilise le disque par défaut
        return \Illuminate\Support\Facades\Storage::url($path);
    }
}
