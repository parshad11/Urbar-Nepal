<?php

namespace App\Utils;

use \Notification;
use App\Business;
use App\Notifications\CustomerNotification;
use App\Notifications\RecurringInvoiceNotification;
use App\Notifications\RecurringExpenseNotification;

use App\Notifications\SupplierNotification;

use App\NotificationTemplate;
use App\Restaurant\Booking;
use App\System;
use App\Transaction;
use Config;

class NotificationUtil extends Util
{

    /**
     * Automatically send notification to customer/supplier if enabled in the template setting
     *
     * @param  int  $business_id
     * @param  string  $notification_type
     * @param  obj  $transaction
     * @param  obj  $contact
     *
     * @return void
     */
    public function autoSendNotification($business_id, $notification_type, $transaction, $contact)
    {
        $notification_template = NotificationTemplate::where('business_id', $business_id)
                ->where('template_for', $notification_type)
                ->first();

        $business = Business::findOrFail($business_id);
        $data['email_settings'] = $business->email_settings;
        $data['sms_settings'] = $business->sms_settings;

        if (!empty($notification_template)) {
            if (!empty($notification_template->auto_send) || !empty($notification_template->auto_send_sms)) {
                $orig_data = [
                    'email_body' => $notification_template->email_body,
                    'sms_body' => $notification_template->sms_body,
                    'subject' => $notification_template->subject
                ];
                $tag_replaced_data = $this->replaceTags($business_id, $orig_data, $transaction);

                $data['email_body'] = $tag_replaced_data['email_body'];
                $data['sms_body'] = $tag_replaced_data['sms_body'];

                //Auto send email
                if (!empty($notification_template->auto_send) && !empty($contact->email)) {
                    $data['subject'] = $tag_replaced_data['subject'];
                    $data['to_email'] = $contact->email;

                    $customer_notifications = NotificationTemplate::customerNotifications();
                    $supplier_notifications = NotificationTemplate::supplierNotifications();
                    if (array_key_exists($notification_type, $customer_notifications)) {
                        Notification::route('mail', $data['to_email'])
                                        ->notify(new CustomerNotification($data));
                    } elseif (array_key_exists($notification_type, $supplier_notifications)) {
                        Notification::route('mail', $data['to_email'])
                                        ->notify(new SupplierNotification($data));
                    }
                }

                //Auto send sms
                if (!empty($notification_template->auto_send_sms)) {
                    $data['mobile_number'] = $contact->mobile;
                    if (!empty($contact->mobile)) {
                        $this->sendSms($data);
                    }
                }
            }
        }
    }

    /**
     * Replaces tags from notification body with original value
     *
     * @param  text  $body
     * @param  int  $booking_id
     *
     * @return array
     */
    public function replaceAvailableTags($business_id, $data, $model)
    {
        $business = Business::findOrFail($business_id);
        
        foreach ($data as $key => $value) {
            //Replace contact name
            if (strpos($value, '{contact_name}') !== false) {
                $contact_name = $model->contact->name;

                $data[$key] = str_replace('{contact_name}', $contact_name, $data[$key]);
            }

            if (strpos($value, '{order_ref_number}') !== false) {
                $ref_no = $model->ref_no;
                $data[$key] = str_replace('{order_ref_number}', $ref_no, $data[$key]);
            }
    
            if (strpos($value, '{invoice_number}') !== false) {
                $invoice_no = $model->invoice_no;
                $data[$key] = str_replace('{invoice_number}', $invoice_no, $data[$key]);
            }

            if (strpos($value, '{received_amount}') !== false) {
                $received_amount = $model->payment_lines->amount;
                $data[$key] = str_replace('{received_amount}', $received_amount, $data[$key]);
            }

            if (strpos($value, '{total_amount}') !== false) {
                $final_total = $model->final_total;
                $data[$key] = str_replace('{total_amount}', $final_total, $data[$key]);
            }

            if (strpos($value, '{user_name}') !== false) {
                $user_name = $model->user_name;
                $data[$key] = str_replace('{user_name}', $user_name, $data[$key]);
            }

            if (strpos($value, '{user_type}') !== false) {
                $user_type = $model->user_type;
                $data[$key] = str_replace('{user_type}', $user_type, $data[$key]);
            }

            //Replace location
            if (strpos($value, '{location}') !== false) {
                $location = $model->location->name;

                $data[$key] = str_replace('{location}', $location, $data[$key]);
            }

            if (strpos($value, '{location_name}') !== false) {
                $location = $model->location->name;

                $data[$key] = str_replace('{location_name}', $location, $data[$key]);
            }

            if (strpos($value, '{location_address}') !== false) {
                $location_address = $model->location->location_address;

                $data[$key] = str_replace('{location_address}', $location_address, $data[$key]);
            }

            if (strpos($value, '{location_email}') !== false) {
                $location_email = $model->location->email;

                $data[$key] = str_replace('{location_email}', $location_email, $data[$key]);
            }

            if (strpos($value, '{location_phone}') !== false) {
                $location_phone = $model->location->mobile;

                $data[$key] = str_replace('{location_phone}', $location_phone, $data[$key]);
            }

            if (strpos($value, '{location_custom_field_1}') !== false) {
                $location_custom_field_1 = $model->location->custom_field1;

                $data[$key] = str_replace('{location_custom_field_1}', $location_custom_field_1, $data[$key]);
            }

            if (strpos($value, '{location_custom_field_2}') !== false) {
                $location_custom_field_2 = $model->location->custom_field2;

                $data[$key] = str_replace('{location_custom_field_2}', $location_custom_field_2, $data[$key]);
            }

            if (strpos($value, '{location_custom_field_3}') !== false) {
                $location_custom_field_3 = $model->location->custom_field3;

                $data[$key] = str_replace('{location_custom_field_3}', $location_custom_field_3, $data[$key]);
            }

            if (strpos($value, '{location_custom_field_4}') !== false) {
                $location_custom_field_4 = $model->location->custom_field4;

                $data[$key] = str_replace('{location_custom_field_4}', $location_custom_field_4, $data[$key]);
            }

            // //Replace service_staff
            // if (strpos($value, '{service_staff}') !== false) {
            //     $service_staff = !empty($booking->waiter) ? $booking->waiter->user_full_name : '';

            //     $data[$key] = str_replace('{service_staff}', $service_staff, $data[$key]);
            // }

            // //Replace service_staff
            // if (strpos($value, '{correspondent}') !== false) {
            //     $correspondent = !empty($booking->correspondent) ? $booking->correspondent->user_full_name : '';

            //     $data[$key] = str_replace('{correspondent}', $correspondent, $data[$key]);
            // }

            //Replace business_name
            if (strpos($value, '{business_name}') !== false) {
                $business_name = $business->name;
                $data[$key] = str_replace('{business_name}', $business_name, $data[$key]);
            }

            if (strpos($value, '{business_login}') !== false) {
                 $business_login = '<a href="'.route('login').'">Freshktm</a>';
                $data[$key] = str_replace('{business_login}', $business_login, $data[$key]);
            }

            //Replace business_logo
            if (strpos($value, '{business_logo}') !== false) {
                $logo_name = $business->logo;
                $business_logo = !empty($logo_name) ? '<img src="' . url('uploads/business_logos/' . $logo_name) . '" height="75" alt="Business Logo" >' : '';

                $data[$key] = str_replace('{business_logo}', $business_logo, $data[$key]);
            }
        }
        return $data;
    }

    public function recurringInvoiceNotification($user, $invoice)
    {
        $user->notify(new RecurringInvoiceNotification($invoice));
    }

    public function recurringExpenseNotification($user, $expense)
    {
        $user->notify(new RecurringExpenseNotification($expense));
    }

    public function configureEmail($notificationInfo, $check_superadmin = true)
    {
        $email_settings = $notificationInfo['email_settings'];

        $is_superadmin_settings_allowed = System::getProperty('allow_email_settings_to_businesses');

        //Check if prefered email setting is superadmin email settings
        if (!empty($is_superadmin_settings_allowed) && !empty($email_settings['use_superadmin_settings']) && $check_superadmin) {
            $email_settings['mail_driver'] = config('mail.driver');
            $email_settings['mail_host'] = config('mail.host');
            $email_settings['mail_port'] = config('mail.port');
            $email_settings['mail_username'] = config('mail.username');
            $email_settings['mail_password'] = config('mail.password');
            $email_settings['mail_encryption'] = config('mail.encryption');
            $email_settings['mail_from_address'] = config('mail.from.address');
        }

        $mail_driver = !empty($email_settings['mail_driver']) ? $email_settings['mail_driver'] : 'smtp';
        Config::set('mail.driver', $mail_driver);
        Config::set('mail.host', $email_settings['mail_host']);
        Config::set('mail.port', $email_settings['mail_port']);
        Config::set('mail.username', $email_settings['mail_username']);
        Config::set('mail.password', $email_settings['mail_password']);
        Config::set('mail.encryption', $email_settings['mail_encryption']);

        Config::set('mail.from.address', $email_settings['mail_from_address']);
        Config::set('mail.from.name', $email_settings['mail_from_name']);
    }
}
