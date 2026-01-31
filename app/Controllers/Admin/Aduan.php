<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AduanModel;

class Aduan extends BaseController
{
    protected $aduanModel;

    public function __construct()
    {
        $this->aduanModel = new AduanModel();
        helper('icon');
    }

    public function index()
    {
        return view('admin/aduan/index', [
            'pageTitle'  => 'Aduan & Aspirasi',
            'activeMenu' => 'aduan',
        ]);
    }

    /**
     * DataTables server-side
     */
    public function datatable()
    {
        return $this->processDataTable(
            $this->aduanModel->builder()->where('deleted_at', null),
            [
                0 => 'id',
                1 => 'created_at',
                2 => 'nama',
                3 => 'pesan',
                4 => 'status',
                5 => 'created_at',
            ],
            ['nama', 'pesan', 'email', 'wa'],
            function ($row) {
                // Info Pengirim
                $pengirim = '<div class="flex flex-col gap-1">';
                $pengirim .= '<span class="font-semibold text-slate-800 dark:text-slate-200">' . esc($row['nama'] ?: 'Anonim') . '</span>';
                $pengirim .= '<div class="text-[10px] text-slate-500 flex gap-2 capitalize">';
                $pengirim .= empty($row['email']) ? '' : '<span>' . esc($row['email']) . '</span>';
                $pengirim .= empty($row['wa']) ? '' : '<span>' . esc($row['wa']) . '</span>';
                $pengirim .= '</div></div>';

                // Status Badge logic
                $statusBadge = '';
                switch ($row['status']) {
                    case 'pending':
                        $statusBadge = '<span class="px-2 py-1 rounded-full text-[10px] font-medium bg-yellow-100 text-yellow-700">Pending</span>';
                        break;
                    case 'diproses':
                        $statusBadge = '<span class="px-2 py-1 rounded-full text-[10px] font-medium bg-blue-100 text-blue-700">Diproses</span>';
                        break;
                    case 'selesai':
                        $statusBadge = '<span class="px-2 py-1 rounded-full text-[10px] font-medium bg-emerald-100 text-emerald-700">Selesai</span>';
                        break;
                    case 'spam':
                        $statusBadge = '<span class="px-2 py-1 rounded-full text-[10px] font-medium bg-red-100 text-red-700">Spam</span>';
                        break;
                    default:
                        $statusBadge = '-';
                }

                // Action
                $action = '<div class="flex items-center gap-1.5">' .
                    '<button type="button" class="btnDetail inline-flex items-center gap-1 px-2.5 py-1 rounded-full border border-blue-200 bg-blue-50 text-[11px] font-medium text-blue-700 hover:bg-blue-100 focus:outline-none focus:ring-1 focus:ring-blue-400/70 dark:border-blue-500/40 dark:bg-blue-500/10 dark:text-blue-200 dark:hover:bg-blue-500/20" data-id="' . $row['id'] . '" title="Lihat Detail">' .
                    get_icon('view', 'w-3.5 h-3.5') .
                    '<span>Detail</span>' .
                    '</button>' .
                    btn_delete($row['id']) .
                    '</div>';

                return [
                    'id'         => $row['id'],
                    'created_at' => date('d/m/Y H:i', strtotime($row['created_at'])),
                    'nama'       => $pengirim,
                    'pesan'      => '<div class="line-clamp-2 text-slate-600 dark:text-slate-400 text-xs" title="' . esc($row['pesan']) . '">' . esc($row['pesan']) . '</div>',
                    'status'     => $statusBadge,
                    'action'     => $action,
                ];
            },
            ['created_at' => 'desc']
        );
    }

    public function detail($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405);
        }

        $row = $this->aduanModel->find($id);
        if (!$row) {
            return $this->response->setJSON(['status' => false, 'message' => 'Data tidak ditemukan']);
        }

        return $this->response->setJSON(['status' => true, 'data' => $row]);
    }

    public function delete()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405);
        }

        $id = $this->request->getPost('id');

        if (!$id) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'ID tidak valid',
            ]);
        }

        $aduan = $this->aduanModel->find($id);
        if (!$aduan) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }

        $this->aduanModel->delete($id);

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
