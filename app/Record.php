<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
     /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded=['id'];

    protected $table='records';
    

    public function contact_supplier($id)
    {
        $contact = Contact::findOrFail($id);
        $name =$contact->name.' ('.$contact->supplier_business_name.')';
        return $name;
    }

    public function contact()
    {
        return $this->belongsTo(\App\Contact::class, 'contact_id');
    }

      /**
    * Get the unit associated with the product.
    */
    public function unit()
    {
        return $this->belongsTo(\App\Unit::class);
    }

    public function record_staff()
    {
        return $this->belongsTo(\App\User::class, 'created_by');
    }

    public function location()
    {
        return $this->belongsTo(\App\BusinessLocation::class, 'location_id');
    }

}
