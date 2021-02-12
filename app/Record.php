<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable=['supplier_id','date','location','item','quantity'];

    public function contact_supplier($supplier)
    {
        $contact = Contact::findOrFail($supplier);
        $name = $contact->supplier_business_name;
        return $name;
    }
}
