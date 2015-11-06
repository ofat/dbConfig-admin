<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DbConfigAdminLogsCreate extends Migration {

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
		Schema::create($this->getTableName(), function(Blueprint $table){
			$table->increments('id');
			$table->string('field');
			$table->text('old_value');
			$table->text('new_value');
			$table->string('old_comment');
			$table->string('new_comment');
			$table->integer('user_id');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists($this->getTableName());
	}

}
