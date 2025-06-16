<?php

if (!function_exists('generateSlug')) {
    function generateSlug($text) {
        // Convert to lowercase
        $slug = strtolower($text);
        
        // Replace spaces and special characters with dash
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
        
        // Remove multiple dashes
        $slug = preg_replace('/-+/', '-', $slug);
        
        // Remove leading and trailing dashes
        $slug = trim($slug, '-');
        
        return $slug;
    }
}

if (!function_exists('generateUniqueSlug')) {
    function generateUniqueSlug($title, $model, $excludeId = null) {
        $baseSlug = generateSlug($title);
        $slug = $baseSlug;
        $counter = 1;
        
        while (true) {
            $builder = $model->where('slug', $slug);
            
            if ($excludeId) {
                $builder->where('id !=', $excludeId);
            }
            
            $existing = $builder->first();
            
            if (!$existing) {
                break;
            }
            
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }
}