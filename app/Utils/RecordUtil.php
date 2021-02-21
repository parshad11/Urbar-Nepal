<?php

namespace App\Utils;

use App\Contact;
use App\Record;
use App\Task;
use App\Transaction;
use DB;

class RecordUtil extends Util
{
 /**
    * common function to get
    * list record
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
                'records.contact_id',
                'units.actual_name as unit',
                'BS.name as location_name',
                DB::raw("CONCAT(COALESCE(u.surname, ''),' ',COALESCE(u.first_name, ''),' ',COALESCE(u.last_name,'')) as added_by")

            )
            ->groupBy('records.id');

        return $records;
    }

    /**
    * common function to get
    * list record
    * @param int $business_id
    *
    * @return object
    */
    public function getListTasks($business_id)
    {
        $tasks = Task::leftJoin('users as u', 'tasks.assigned_by', '=', 'u.id')
                      ->leftJoin('delivery_people as d', 'tasks.delivery_person_id', '=', 'd.id')
                      ->join(
                        'business_locations AS BS',
                        'tasks.location_id',
                        '=',
                        'BS.id'
                    )
                    ->where('tasks.business_id', $business_id)
                    ->select(
                        'tasks.id',
                        'tasks.title', 
                        'tasks.task_type',
                        'tasks.task_status',
                        DB::raw("CONCAT(COALESCE(u.surname, ''),' ',COALESCE(u.first_name, ''),' ',COALESCE(u.last_name,'')) as assign_to"),
                        DB::raw("CONCAT(COALESCE(tasks.task_address, ''),' ',COALESCE(tasks.task_latitude, ''),' ',COALESCE(tasks.task_longitude,'')) as task_address"),
                        'BS.name as location_name',
                        DB::raw("CONCAT(COALESCE(u.surname, ''),' ',COALESCE(u.first_name, ''),' ',COALESCE(u.last_name,'')) as assigned_by")
                       
                    )
                    ->groupBy('tasks.id');

        return $tasks;
        }

        
    public function getRecordCalendar($filters)
    {
        $start_date = request()->start;
        $end_date = request()->end;
        if ((auth()->user()->can('record.view') && auth()->user()->can('record.view_own'))) {
            $query = Record::where('business_id', $filters['business_id'])
                ->whereBetween(DB::raw('expected_collection_date'), [$filters['start_date'], $filters['end_date']]);
        }
        if ((!auth()->user()->can('record.view') && auth()->user()->can('record.view_own'))) {
            $query = Record::where('business_id', $filters['business_id'])->where('created_by', auth()->user()->id)
                ->whereBetween(DB::raw('expected_collection_date'), [$filters['start_date'], $filters['end_date']]);
        }
        if (!empty($filters['supplier_id'])) {
            $query->where('contact_id', $filters['supplier_id']);
        }

        if (!empty($filters['location_id'])) {
            $query->where('location_id', $filters['location_id']);
        }
        $records = $query->get();

        $events = [];

        foreach ($records as $record) {
            $customer_name = \App\Contact::find($record->contact_id)->name;
            $table_name = optional($record->table)->name;

            $backgroundColor = '#3c8dbc';
            $borderColor = '#3c8dbc';
            if ($record->record_status == 'completed') {
                $backgroundColor = '#00a65a';
                $borderColor = '#00a65a';
            } elseif ($record->record_status == 'cancelled') {
                $backgroundColor = '#f56954';
                $borderColor = '#f56954';
            } elseif ($record->record_status == 'waiting') {
                $backgroundColor = '#FFAD46';
                $borderColor = '#FFAD46';
            }
            if (!empty($filters['color'])) {
                $backgroundColor = $filters['color'];
                $borderColor = $filters['color'];
            }
            $title = $customer_name;
            if (!empty($table_name)) {
                $title .= ' - ' . $table_name;
            }
            $location=\App\BusinessLocation::find($record->location_id)->name;
            $events[] = [
                'title' => $title.'--'.'Item:'.$record->item.'--'.'Location:'.$location,
                'title_html' => $customer_name . '<br>'.'Item:'.'<p class="text-capitalize inline">'.$record->item.'</p>'
                    .'<br>'.'location: '.'<p class="text-capitalize inline">'.$location.'</p>',
                'start' => $record->expected_collection_date,
                'end' => $record->expected_collection_date,
                'customer_name' => $customer_name,
                'table' => $table_name,
//                'url' => action('RecordController@show', [ $record->id ]),
                'event_url' => action('RecordController@index'),
                'backgroundColor' => $backgroundColor,
                'borderColor' => $borderColor,
                'allDay' => false,
                'event_type' => 'records'
            ];
        }
        return $events;
    }

}