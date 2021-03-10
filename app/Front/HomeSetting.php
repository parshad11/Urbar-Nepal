<?php

namespace App\Front;

use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    protected $fillable = [
        'logo_image', 'address', 'phone', 'email', 'banner_images', 'why_choose_us', 'welcome_image', 'welcome_description', 'vdo_image',
        'vdo_link', 'faqs', 'social_links', 'call_section_image', 'counter_section_image', 'quote_background_image', 'quote_front_image', 'client_images', 'created_by', 'google_map_link'
    ];
    public function deleteImage($file_name, $file_path){
        if(!empty($file_name) && file_exists($file_path)){
            unlink($file_path);
        }
    }
}
