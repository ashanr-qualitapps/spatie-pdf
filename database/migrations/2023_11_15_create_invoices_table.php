<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->string('client_name');
            $table->string('client_email')->nullable();
            $table->string('invoice_number')->unique();
            $table->longText('content_html')->nullable();
            $table->date('issue_date');
            $table->date('due_date');
            $table->decimal('total_amount', 10, 2);
            $table->string('status')->default('draft'); // draft, sent, paid, overdue, etc.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
