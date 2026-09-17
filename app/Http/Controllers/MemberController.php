<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::withCount('borrowings')->latest()->get();
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|numeric|unique:members,nisn',
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        Member::create($request->all());

        return redirect()->route('members.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function destroy(Member $member)
    {
        if ($member->borrowings()->count() > 0) {
            return redirect()->route('members.index')->with('error', 'Anggota tidak bisa dihapus karena memiliki riwayat peminjaman.');
        }

        $member->delete();
        return redirect()->route('members.index')->with('success', 'Anggota berhasil dihapus.');
    }

    // Unduh File Template Excel (.XLS) Rapi & Garis Tabel Presisi
    public function downloadTemplate()
    {
        $filename = "template_import_siswa.xls";

        $contents = '
<html xmlns:o="urn:schemas-microsoft-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--[if gte mso 9]>
<xml>
 <x-ExcelWorkbook>
  <x-ExcelWorksheets>
   <x-ExcelWorksheet>
    <x-Name>Data Siswa</x-Name>
    <x-WorksheetOptions>
     <x-DisplayGridlines/>
    </x-WorksheetOptions>
   </x-ExcelWorksheet>
  </x-ExcelWorksheets>
 </x-ExcelWorkbook>
</xml>
<![endif]-->
<style>
    table {
        border-collapse: collapse;
    }
    th, td {
        font-family: Arial, sans-serif;
        font-size: 10pt;
        vertical-align: middle;
    }
</style>
</head>
<body>
<table border="1" style="border-collapse: collapse; border: 1px solid #CBD5E1;">
    <tr>
        <td colspan="5" style="background-color: #312E81; color: #FFFFFF; font-size: 13pt; font-weight: bold; text-align: center; height: 38px; border: 1px solid #312E81;">
            TEMPLATE IMPORT DATA SISWA PERPUSTAKAAN
        </td>
    </tr>
    <tr>
        <td colspan="5" style="background-color: #FEF3C7; color: #92400E; font-size: 9pt; font-style: italic; text-align: left; height: 28px; padding-left: 10px; border: 1px solid #FCD34D;">
            Petunjuk: Isikan data siswa mulai dari baris putih (baris 6 ke bawah). Jangan mengubah judul kolom pada baris ke-3.
        </td>
    </tr>
    <tr>
        <th style="background-color: #4F46E5; color: #FFFFFF; font-size: 11pt; font-weight: bold; text-align: center; width: 140px; height: 32px; border: 1px solid #3730A3;">NISN</th>
        <th style="background-color: #4F46E5; color: #FFFFFF; font-size: 11pt; font-weight: bold; text-align: center; width: 220px; height: 32px; border: 1px solid #3730A3;">Nama Lengkap</th>
        <th style="background-color: #4F46E5; color: #FFFFFF; font-size: 11pt; font-weight: bold; text-align: center; width: 120px; height: 32px; border: 1px solid #3730A3;">Kelas</th>
        <th style="background-color: #4F46E5; color: #FFFFFF; font-size: 11pt; font-weight: bold; text-align: center; width: 150px; height: 32px; border: 1px solid #3730A3;">No. HP</th>
        <th style="background-color: #4F46E5; color: #FFFFFF; font-size: 11pt; font-weight: bold; text-align: center; width: 260px; height: 32px; border: 1px solid #3730A3;">Alamat</th>
    </tr>
    <!-- Sample Rows -->
    <tr style="background-color: #F8FAFC; color: #475569;">
        <td style="text-align: center; height: 26px; border: 1px solid #CBD5E1; mso-number-format:\'@\';">0051112223</td>
        <td style="text-align: left; border: 1px solid #CBD5E1; padding-left: 6px;">Budi Pratama (Contoh)</td>
        <td style="text-align: center; border: 1px solid #CBD5E1;">X RPL 1</td>
        <td style="text-align: center; border: 1px solid #CBD5E1; mso-number-format:\'@\';">081299998888</td>
        <td style="text-align: left; border: 1px solid #CBD5E1; padding-left: 6px;">Jl. Kenanga No 5</td>
    </tr>
    <tr style="background-color: #F8FAFC; color: #475569;">
        <td style="text-align: center; height: 26px; border: 1px solid #CBD5E1; mso-number-format:\'@\';">0054445556</td>
        <td style="text-align: left; border: 1px solid #CBD5E1; padding-left: 6px;">Siti Rahma (Contoh)</td>
        <td style="text-align: center; border: 1px solid #CBD5E1;">XI TKJ 2</td>
        <td style="text-align: center; border: 1px solid #CBD5E1; mso-number-format:\'@\';">085711112222</td>
        <td style="text-align: left; border: 1px solid #CBD5E1; padding-left: 6px;">Jl. Melati No 12</td>
    </tr>
';

        for ($i = 0; $i < 20; $i++) {
            $contents .= '
    <tr style="background-color: #FFFFFF;">
        <td style="text-align: center; height: 26px; border: 1px solid #CBD5E1; mso-number-format:\'@\';">&nbsp;</td>
        <td style="text-align: left; border: 1px solid #CBD5E1;">&nbsp;</td>
        <td style="text-align: center; border: 1px solid #CBD5E1;">&nbsp;</td>
        <td style="text-align: center; border: 1px solid #CBD5E1; mso-number-format:\'@\';">&nbsp;</td>
        <td style="text-align: left; border: 1px solid #CBD5E1;">&nbsp;</td>
    </tr>';
        }

        $contents .= '
</table>
</body>
</html>';

        return response($contents)
            ->header('Content-Type', 'application/vnd.ms-excel; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    // Proses Import Data dari File Excel (.xls) maupun CSV (.csv)
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:2048',
        ]);

        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());

        if (!in_array($extension, ['csv', 'xls', 'xlsx', 'txt'])) {
            return redirect()->back()->with('error', 'Format file tidak didukung. Harap unggah file .xls, .xlsx, atau .csv');
        }

        $path = $file->getRealPath();
        $content = file_get_contents($path);

        $imported = 0;
        $skipped = 0;

        // Jika file berformat HTML Table Excel (.xls)
        if (str_contains($content, '<tr') || str_contains($content, '<table')) {
            preg_match_all('/<tr[^>]*>(.*?)<\/tr>/is', $content, $trMatches);

            foreach ($trMatches[1] as $trContent) {
                preg_match_all('/<t[dh][^>]*>(.*?)<\/t[dh]>/is', $trContent, $tdMatches);

                $row = array_map(function($val) {
                    $clean = str_replace(['&nbsp;', '&#160;'], '', $val);
                    return trim(html_entity_decode(strip_tags($clean), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                }, $tdMatches[1]);

                if (empty($row) || count($row) < 3) {
                    continue;
                }

                $nisn = $row[0] ?? '';
                $name = $row[1] ?? '';
                $class = $row[2] ?? '';
                $phone = $row[3] ?? null;
                $address = $row[4] ?? null;

                // Abaikan baris header, judul, catatan, contoh, atau NISN non-numerik
                if (empty($nisn) || empty($name) || !is_numeric($nisn) || str_contains($name, '(Contoh)')) {
                    continue;
                }

                $exists = Member::where('nisn', $nisn)->exists();
                if (!$exists) {
                    Member::create([
                        'nisn' => $nisn,
                        'name' => $name,
                        'class' => $class,
                        'phone' => $phone ? substr($phone, 0, 20) : null,
                        'address' => $address,
                    ]);
                    $imported++;
                } else {
                    $skipped++;
                }
            }
        } else {
            // Jika file berformat CSV / TXT biasa
            $delimiter = (substr_count($content, ';') > substr_count($content, ',')) ? ';' : ',';
            $handle = fopen($path, 'r');

            $bom = fread($handle, 3);
            if ($bom !== "\xEF\xBB\xBF") {
                rewind($handle);
            }

            while (($data = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (empty($data) || count($data) < 3) {
                    continue;
                }

                $nisn = trim($data[0]);
                $name = trim($data[1]);
                $class = trim($data[2]);
                $phone = isset($data[3]) ? trim($data[3]) : null;
                $address = isset($data[4]) ? trim($data[4]) : null;

                // Abaikan baris header atau non-numerik NISN
                if (empty($nisn) || empty($name) || !is_numeric($nisn) || str_contains($name, '(Contoh)')) {
                    continue;
                }

                $exists = Member::where('nisn', $nisn)->exists();
                if (!$exists) {
                    Member::create([
                        'nisn' => $nisn,
                        'name' => $name,
                        'class' => $class,
                        'phone' => $phone ? substr($phone, 0, 20) : null,
                        'address' => $address,
                    ]);
                    $imported++;
                } else {
                    $skipped++;
                }
            }
            fclose($handle);
        }

        return redirect()->route('members.index')
            ->with('success', "Import selesai! {$imported} data siswa berhasil ditambahkan. ({$skipped} data dilewati karena duplikat/contoh)");
    }
}
