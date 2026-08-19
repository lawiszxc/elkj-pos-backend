<?php

namespace App\Http\Controllers;

use App\Models\Remittance;
use App\Models\RemittanceDetail;
use Auth;
use Illuminate\Http\Request;

class RemittanceController extends Controller
{
    public function addRemittances(Request $request)
    {
        $remittance = Remittance::create([
            'user_id' => Auth::user()->id,
            'sale_id' => $request->sale_id,
            'status' => 'Pending',
        ]);

        return response()->json([
            'remittance' => $remittance,
        ]);
    }

    public function sendRemittance(Request $request)
    {
        $remittance_details = RemittanceDetail::create([
            "remitted_to" => $request->remitted_to,
            "reference_number" => $request->reference_number,
            "date_remitted" => $request->date_remitted,
        ]);

        $remittance = Remittance::where('status', 'Pending')
            ->update([
                'status' => 'Remitted',
                'updated_at' => $remittance_details->date_remitted
            ]);

        return response()->json([
            'remittance' => $remittance,
            'remittance_details' => $remittance_details
        ]);
    }

    public function getRemittances()
    {
        /*
        |--------------------------------------------------------------------------
        | PENDING REMITTANCES
        |--------------------------------------------------------------------------
        | Get all pending remittances together with their sale items.
        | Expected amount will be calculated using:
        |
        | quantity × unit_price
        |
        */
        $remittances = Remittance::with([
            'sale.sale_items' => function ($query) {
                $query->select(
                    'id',
                    'sale_id',
                    'quantity',
                    'unit_price'
                );
            },
        ])
            ->where('status', 'Pending')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | REMITTED REMITTANCES
        |--------------------------------------------------------------------------
        | Group remitted transactions by the date they were updated/remitted.
        */
        $remitted = Remittance::with([
            'sale.sale_items' => function ($query) {
                $query->select(
                    'id',
                    'sale_id',
                    'quantity',
                    'unit_price'
                );
            },
        ])
            ->where('status', 'Remitted')
            ->orderBy('updated_at', 'DESC')
            ->get()
            ->groupBy(function ($remittance) {
                return $remittance->updated_at->format('Y-m-d');
            })
            ->map(function ($remittances, $date) {

                $detail = RemittanceDetail::whereDate(
                    'date_remitted',
                    $date
                )->first();

                return [
                    'date' => $date,
                    'remittance_detail' => $detail,
                    'remittances' => $remittances,
                ];
            });

        return response()->json([
            'remittances' => $remittances,
            'remitted' => $remitted,
        ]);
    }
}
