<?php

namespace App\Helpers;

class Department
{
    public static function list()
    {
        return [
            'technical' => [
                'label' => 'Technical Issues',
                'connection' => 'technical_db',
            ],
            'billing' => [
                'label' => 'Account & Billing',
                'connection' => 'billing_db',
            ],
            'product' => [
                'label' => 'Product & Service',
                'connection' => 'product_db',
            ],
            'general' => [
                'label' => 'General Inquiry',
                'connection' => 'general_db',
            ],
            'feedback' => [
                'label' => 'Feedback & Suggestions',
                'connection' => 'feedback_db',
            ],
        ];
    }
}
