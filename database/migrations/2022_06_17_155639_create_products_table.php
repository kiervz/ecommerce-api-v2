<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Segment;
use App\Models\Seller;
use App\Models\SubCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignIdFor(Seller::class, 'seller_id');
            $table->foreignIdFor(Brand::class, 'brand_id');
            $table->foreignIdFor(Segment::class, 'segment_id');
            $table->foreignIdFor(Category::class, 'category_id');
            $table->foreignIdFor(SubCategory::class, 'sub_category_id');
            $table->string('sku', 191);
            $table->string('name', 191);
            $table->string('slug', 191);
            $table->decimal('unit_price', 18, 2);
            $table->decimal('discount', 3, 2);
            $table->decimal('actual_price', 18, 2);
            $table->integer('stock');
            $table->string('description', 191);
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
        Schema::dropIfExists('products');
    }
}
