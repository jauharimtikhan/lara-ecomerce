<?php

namespace App\Tables\Columns;

use App\Models\Product;
use Filament\Tables\Columns\Column;

class OrdersProductDetail extends Column
{
    protected string $view = 'tables.columns.orders-product-detail';
}
