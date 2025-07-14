<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'client_name',
        'client_email',
        'invoice_number',
        'issue_date',
        'due_date',
        'total_amount',
        'status'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'due_date' => 'date',
        'total_amount' => 'decimal:2',
    ];
}
