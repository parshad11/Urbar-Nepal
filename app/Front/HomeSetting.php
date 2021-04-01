<?php

namespace App\Front;

use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    protected $fillable = [
        'logo_image', 'address', 'phone', 'email','social_links', 'google_map_link', 'about_content', 'created_by'
    ];
    
    public function deleteImage($file_name, $file_path){
        if(!empty($file_name) && file_exists($file_path)){
            unlink($file_path);
        }
    }
}
