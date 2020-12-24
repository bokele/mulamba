<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('ref_number');
            $table->unsignedBigInteger("payment_id");
            $table->unsignedBigInteger("owner_id");
            $table->unsignedBigInteger("customer_id");
            $table->integer("vat");
            $table->double("total_amount_payable");
            $table->double("discount_amount");
            $table->double("net_amount_payable");
            $table->double("total_amount_pay");
            $table->string("invoice_for"); //sale or buy  house, car, rental car or house
            $table->string("status");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
