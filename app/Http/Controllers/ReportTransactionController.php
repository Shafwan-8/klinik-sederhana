<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReportTransactionController extends Controller
{
    public function index(Request $request) 
    {
        $idDokter = $this->getIdDokterYangLogin();
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if ($start_date > $end_date) {
            return redirect()->back()->with('error', 'Tanggal akhir harus lebih besar daripada tanggal awal.');
        }

        $title = 'Trika Klinik | Laporan Jumlah Transaksi';
        $active = 'transaksi';

        $dataTransaksi = DB::table('inspections')
        ->join('patients', 'inspections.patient_id', '=', 'patients.id')
        ->selectRaw('
            DATE_FORMAT(inspections.created_at, "%d %M %Y %H:%i:%s") as tanggal,
            patients.name as nama_pasien, 
            inspections.tindakan as nama_layanan,
            inspections.harga_tindakan as harga_layanan') 
        ->whereDate('inspections.created_at', '>=', date('Y-m-d H:i:s', strtotime($start_date)))
        ->whereDate('inspections.created_at', '<=', date('Y-m-d H:i:s', strtotime($end_date)))
        ->orderByDesc('tanggal')
        ->get()
        ->map(function ($data) {
            $data->harga_layanan = 'Rp ' . number_format($data->harga_layanan, 0, ',', '.');    
            return $data;
        })
        ->toArray();

        return view('home.content.report.transaction.index', compact('dataTransaksi','title','active','start_date', 'idDokter'));
    }

    public function viewPDF(Request $request)
    {   
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $formatted_start_date = Carbon::parse($start_date)->format('d-m-Y');
        $formatted_end_date = Carbon::parse($end_date)->format('d-m-Y');

        $dataTransaksi = DB::table('inspections')
        ->join('patients', 'inspections.patient_id', '=', 'patients.id')
        ->selectRaw('
            DATE_FORMAT(inspections.created_at, "%d %M %Y %H:%i:%s") as tanggal,
            patients.name as nama_pasien, 
            inspections.tindakan as nama_layanan,
            inspections.harga_tindakan as harga_layanan') 
        ->whereDate('inspections.created_at', '>=', date('Y-m-d H:i:s', strtotime($start_date)))
        ->whereDate('inspections.created_at', '<=', date('Y-m-d H:i:s', strtotime($end_date)))
        ->orderByDesc('tanggal')
        ->get()
        ->map(function ($data) {
            $data->harga_layanan = 'Rp ' . number_format($data->harga_layanan, 0, ',', '.');    
            return $data;
        })
        ->toArray();

        // $array = [];

        //     foreach($dataTransaksi as $data) {
        //         array_push($array, $data->tanggal);
        //     }

        $pdf = PDF::loadView('home.content.report.transaction.report-transaction', compact('dataTransaksi','formatted_start_date','formatted_end_date'))
            ->setPaper('a4','portrait');

        return $pdf->stream(); 
    }

    public function downloadPDF(Request $request)
    {   
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        
        $formatted_start_date = Carbon::parse($start_date)->format('d-m-Y');
        $formatted_end_date = Carbon::parse($end_date)->format('d-m-Y');

        $dataTransaksi = DB::table('inspections')
        ->join('patients', 'inspections.patient_id', '=', 'patients.id')
        ->selectRaw('
            DATE_FORMAT(inspections.created_at, "%d %M %Y %H:%i:%s") as tanggal,
            patients.name as nama_pasien, 
            inspections.tindakan as nama_layanan,
            inspections.harga_tindakan as harga_layanan') 
        ->whereDate('inspections.created_at', '>=', date('Y-m-d H:i:s', strtotime($start_date)))
        ->whereDate('inspections.created_at', '<=', date('Y-m-d H:i:s', strtotime($end_date)))
        ->orderByDesc('tanggal')
        ->get()
        ->map(function ($data) {
            $data->harga_layanan = 'Rp ' . number_format($data->harga_layanan, 0, ',', '.');    
            return $data;
        })
        ->toArray();
 

        $pdf = PDF::loadView('home.content.report.transaction.report-transaction',  compact('dataTransaksi','formatted_start_date','formatted_end_date'))
            ->setPaper('a4','portrait')
            ->set_option('isRemoteEnabled', true);

        return $pdf->download('data-jumlah-transaksi-pasien-[' . $formatted_start_date . '][' . $formatted_end_date . '].pdf'); 
    }
}
