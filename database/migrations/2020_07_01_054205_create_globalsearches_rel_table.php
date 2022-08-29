<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateGlobalSearchesRelTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('globalsearches_rel', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->increments('id')->collation('utf8_general_ci');
            $table->unsignedInteger('fkSearchRecordId')->collation('utf8_general_ci');
            $table->string('varBrowserInfo', 255)->collation('utf8_general_ci')->nullable()->default(null);
            $table->char('isWeb', 1)->collation('utf8_general_ci');
            $table->string('varSessionId', 255)->collation('utf8_general_ci')->nullable()->default(null);
            $table->string('varIpAddress', 255)->collation('utf8_general_ci')->nullable()->default(null);
            $table->char('chrPublish', 1)->collation('utf8_general_ci')->default('Y');
            $table->char('chrDelete', 1)->collation('utf8_general_ci')->default('N');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('globalsearches_rel');
    }

}
