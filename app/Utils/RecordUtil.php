<?php

namespace App\Utils;

use App\Contact;
use App\Record;
use App\Transaction;
use DB;

class RecordUtil extends Util
{
 /**
    * common function to get
    * list purchase
    * @param int $business_id
    *
    * @return object
    */
    public function getListRecords($business_id)
    {
        $records = Record::leftJoin('contacts', 'records.contact_id', '=', 'contacts.id')
                    ->join(
                        'business_locations AS BS',
                        'records.location_id',
                        '=',
                        'BS.id'
                    )
                    ->leftJoin('users as u', 'records.created_by', '=', 'u.id')
                    ->join('units', 'records.unit_id', '=', 'units.id')
                    ->where('records.business_id', $business_id)
                    ->select(
                        'records.id',
                        'records.item',
                        'records.location',
                        'records.quantity',
                        'records.expected_collection_date',
                        'contacts.name',
                        'units.actual_name as unit',
                        'BS.name as location_name',
                        DB::raw("CONCAT(COALESCE(u.surname, ''),' ',COALESCE(u.first_name, ''),' ',COALESCE(u.last_name,'')) as added_by")
                       
                    )
                    ->groupBy('records.id');

        return $records;
    }

}