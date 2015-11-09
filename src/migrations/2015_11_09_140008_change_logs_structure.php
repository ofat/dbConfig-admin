<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLogsStructure extends Migration {

	protected function getTableName()
	{
		return \Config::get('dbConfigAdmin.logs_table', 'settings_logs');
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table($this->getTableName(), function(Blueprint $table){
			$table->dropColumn('old_value');
			$table->dropColumn('new_value');
			$table->dropColumn('old_comment');
			$table->dropColumn('new_comment');

			$table->text('diff');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table($this->getTableName(), function(Blueprint $table){
			$table->dropColumn('diff');

			$table->text('old_value');
			$table->text('new_value');
			$table->string('old_comment');
			$table->string('new_comment');
		});
	}

}
