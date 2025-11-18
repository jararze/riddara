<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_category_id')->constrained()->onDelete('cascade');

            // Básico
            $table->string('name'); // STARRAY, COOLRAY
            $table->string('slug')->unique(); // starray, coolray
            $table->text('description')->nullable(); // Descripción corta
            $table->text('long_description')->nullable(); // Descripción larga (para detalle)
            $table->string('image')->nullable(); // Imagen principal

            // Para galería (JSON array de rutas)
            $table->json('gallery')->nullable(); // ['ruta1.jpg', 'ruta2.jpg']

            // Visualización
            $table->enum('position', ['center', 'left', 'right'])->default('center');
            $table->boolean('featured')->default(false);
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);

            // Precios principales (del listado)
            $table->string('currency_before')->default('$us.');
            $table->string('price_before')->nullable(); // Como string para permitir "-" o "600000"
            $table->string('currency_now')->default('$us.');
            $table->string('price_now')->nullable();

            // Etiquetas
            $table->string('discount_label')->nullable(); // "Lanzamiento", "Ahora"
            $table->string('from_label')->nullable(); // "Desde", "Lanzamiento"
            $table->boolean('show_from_label')->default(true);

            // Pricing colors (para estilos)
            $table->string('price_before_color')->default('text-gray-500');
            $table->string('price_before_decoration')->default('line-through');
            $table->string('price_now_color')->default('text-[#3B4C39]');
            $table->string('price_now_size')->default('text-2xl');
            $table->string('price_now_weight')->default('font-bold');
            $table->string('discount_label_color')->default('text-[#3B4C39]');

            // Botón (estilos)
            $table->string('button_bg_color')->default('bg-black');
            $table->string('button_text_color')->default('text-white');
            $table->string('button_hover_bg')->default('hover:bg-gray-800');

            // Badge
            $table->boolean('show_badge')->default(false);
            $table->string('badge_text')->nullable(); // "NUEVO", "POPULAR"
            $table->string('badge_color')->default('bg-red-500 text-white');
            $table->enum('badge_position', ['top-right', 'top-left', 'bottom-right', 'bottom-left'])->default('top-right');

            // Catálogo PDF
            $table->string('catalog_pdf_path')->nullable();
            $table->string('catalog_file_name')->nullable();

            $table->timestamps();

            $table->index(['vehicle_category_id', 'is_active', 'order']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
