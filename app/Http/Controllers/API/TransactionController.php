<?php

namespace App\Http\Controllers\API;

use App\helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function all(Request $request)
    {
        $limit = $request->input('limit', 6);
        $status = $request->input('status');

        $transaction = Transaction::with(['items.product'])->where('users_id', $request->user()->id);

        if ($status) {
            $transaction->where('status', $status);
        }

        return ResponseFormatter::success(
            $transaction->paginate($limit),
            'Data transaksi berhasil diambil'
        );
    }

    public function find($id)
    {
        $transaction = Transaction::with(['items.product'])->find($id);

        if ($transaction) {
            return ResponseFormatter::success(
                $transaction,
                'Data transaksi berhasil diambil'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Data transaksi tidak ada',
                404
            );
        }
    }
}
