    <?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateGuestsTable extends Migration
    {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->integer('ticket_no')
            ->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')
            ->nullable();
            $table->integer('batch_year');
            $table->string('honors')
            ->nullable();
            $table->string('profession')
            ->nullable();
            $table->string('company_org')
            ->nullable();
            $table->string('address')
            ->nullable();
            $table->string('residence')
            ->nullable();
            $table->string('telephone')
            ->nullable();
            $table->string('cellphone')
            ->nullable();
            $table->string('email')
            ->nullable();
            $table->string('degree')
            ->nullable();
            $table->boolean('raffle')
            ->default(false);
            $table->timestamps();
            $table->primary('ticket_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guests');
    }
}
