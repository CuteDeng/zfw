<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoleNode extends Migration
{
    /**
     * Run the migrations.
     * 角色与权限中间表
     * @return void
     */
    public function up()
    {
        Schema::create('role_node', function (Blueprint $table) {
            $table->unsignedInteger('role_id')->default(0)->comment('角色id');
            $table->unsignedInteger('node_id')->default(0)->comment('节点id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_node');
    }
}
