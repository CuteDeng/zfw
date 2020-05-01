<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * 后台管理员用户
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('role_id')->default(0)->comment('角色id');
            $table->string('username',255)->comment('账号');
            $table->string('truename',20)->default('')->comment('账号');
            $table->string('password',255)->comment('密码');
            $table->string('email',50)->nullable()->default('')->comment('邮箱');
            $table->string('phone',15)->default('')->comment('手机号');
            $table->enum('sex',['先生','女士'])->default('先生')->comment('性别');
            $table->char('last_ip',15)->default('')->comment('登录ip');
            $table->timestamps();
            // soft delete,会生成 delete_at 字段
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
        Schema::dropIfExists('users');
    }
}
