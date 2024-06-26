<?php

namespace App\Http\Controllers\API;

use App\helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function all(Request $request)
    {
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $show_product = $request->input('show_product');

        $category = ProductCategory::query();

        if ($name) {
            $category->where('name', 'like', '%' . $name . '%');
        }

        if ($show_product) {
            $category->with('products');
        }

        return ResponseFormatter::success(
            $category->paginate($limit),
            'Data list kategori produk berhasil diambil'
        );
    }

    public function find(Request $request, $id)
    {
        $category = ProductCategory::with(['products'])->find($id);

        if ($category) {
            return ResponseFormatter::success(
                $category,
                'Data kategori produk berhasil diambil'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Data kategori produk tidak ada',
                404
            );
        }
    }
}
