<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Combines Category and sub-category
     *
     * @param int $business_id
     * @return array
     */
    public static function catAndSubCategories($business_id)
    {
        $all_categories = Category::where('business_id', $business_id)
                        ->orderBy('name', 'asc')
                        ->get()
                        ->toArray();
                        
        if (empty($all_categories)) {
            return [];
        }
        $categories = [];
        $sub_categories = [];

        foreach ($all_categories as $category) {
            if ($category['parent_id'] == 0) {
                $categories[] = $category;
            } else {
                $sub_categories[] = $category;
            }
        }

        $sub_cat_by_parent = [];
        if (!empty($sub_categories)) {
            foreach ($sub_categories as $sub_category) {
                if (empty($sub_cat_by_parent[$sub_category['parent_id']])) {
                    $sub_cat_by_parent[$sub_category['parent_id']] = [];
                }

                $sub_cat_by_parent[$sub_category['parent_id']][] = $sub_category;
            }
        }

        foreach ($categories as $key => $value) {
            if (!empty($sub_cat_by_parent[$value['id']])) {
                $categories[$key]['sub_categories'] = $sub_cat_by_parent[$value['id']];
            }
        }

        return $categories;
    }

    /**
     * Category Dropdown
     *
     * @param int $business_id
     * @param string $type category type
     * @return array
     */
    public static function forDropdown($business_id, $type)
    {
        $categories = Category::where('business_id', $business_id)
                            ->where('parent_id', 0)
                            ->where('category_type', $type)
                            ->where('status','active')
                            ->select(DB::raw('IF(short_code IS NOT NULL, CONCAT(name, "-", short_code), name) as name'), 'id')
                            ->orderBy('name', 'asc')
                            ->get();

        $dropdown =  $categories->pluck('name', 'id');

        return $dropdown;
    }

    public function sub_categories()
    {
        return $this->hasMany(\App\Category::class, 'parent_id');
    }

    public function products(){
        return $this->hasMany(\App\Product::class,'category_id');
    }

    public function sub_category_products(){
        return $this->hasMany(\App\Product::class,'sub_category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('categories.status', 'active');
    }

    /**
     * Scope a query to only include main categories.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOnlyParent($query)
    {
        return $query->where('parent_id', 0);
    }

    public static function popularcategory($id){
        $category=Category::findorfail($id);
        $view=$category->view+1;
        $data=null;
        $data['view']=$view;
        $category=Category::findorfail($category->id);
        $category->fill($data);
        $category->save();
    }

}
