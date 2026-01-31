<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PageModel;

class Page extends BaseController
{
    protected $pageModel;

    public function __construct()
    {
        $this->pageModel = new PageModel();
    }

    public function detail($slug = null)
    {
        if (!$slug) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Fetch Data Directly (Duplicate logic from API to avoid internal HTTP request overhead)
        $row = $this->pageModel->where('slug', $slug)
            ->where('deleted_at', null)
            ->where('status', 'published')
            ->first();

        if (!$row) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $related = $this->pageModel
            ->select('id, title, slug, updated_at')
            ->where('id !=', $row['id'])
            ->where('deleted_at', null)
            ->where('status', 'published')
            ->orderBy('updated_at', 'DESC')
            ->limit(10)
            ->find();

        $data = [
            'page' => $row,
            'related_pages' => $related,
            'title' => $row['title']
        ];

        return view('frontend/halaman/detail', $data);
    }

    public function search()
    {
        $keyword = trim((string) $this->request->getGet('q'));

        if (empty($keyword)) {
            return redirect()->back();
        }

        $page = max(1, (int) ($this->request->getGet('page') ?? 1));
        $perPage = 10;

        $results = $this->pageModel
            ->select('id, title, slug, content, updated_at')
            ->where('deleted_at', null)
            ->where('status', 'published')
            ->groupStart()
                ->like('title', $keyword)
                ->orLike('content', $keyword)
            ->groupEnd()
            ->orderBy('updated_at', 'DESC')
            ->paginate($perPage, 'default', $page);

        $pager = $this->pageModel->pager;

        // Mock a page object to reuse the layout
        $dummyPage = [
            'title' => 'Hasil Pencarian: "' . esc($keyword) . '"',
            'content' => $this->renderSearchResults($results, $pager),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Fetch related/recent pages for sidebar
        $related = $this->pageModel
            ->select('id, title, slug, updated_at')
            ->where('deleted_at', null)
            ->where('status', 'published')
            ->orderBy('updated_at', 'DESC')
            ->limit(10)
            ->find();

        $data = [
            'page' => $dummyPage,
            'related_pages' => $related,
            'title' => 'Pencarian: ' . $keyword
        ];

        return view('frontend/halaman/detail', $data);
    }

    private function renderSearchResults($results, $pager)
    {
        if (empty($results)) {
            return '<div class="p-6 text-center text-slate-500 border border-dashed border-slate-300 rounded-xl">Tidak ditemukan halaman yang cocok dengan kata kunci tersebut.</div>';
        }

        $html = '<div class="space-y-6">';
        foreach ($results as $item) {
            $snippet = strip_tags($item['content']);
            if (strlen($snippet) > 200) $snippet = substr($snippet, 0, 200) . '...';
            
            $url = site_url('halaman/' . $item['slug']);
            
            $html .= '
            <div class="border-b border-slate-100 pb-6 last:border-0">
                <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-2">
                    <a href="'.$url.'" class="hover:text-emerald-600 transition-colors">'.$item['title'].'</a>
                </h3>
                <p class="text-slate-600 dark:text-slate-400 text-sm mb-3">'.$snippet.'</p>
                <a href="'.$url.'" class="inline-flex items-center text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                    Baca Selengkapnya &rarr;
                </a>
            </div>';
        }
        $html .= '</div>';
        
        if ($pager) {
             $html .= '<div class="mt-8">'. $pager->links('default', 'default_full') .'</div>';
        }

        return $html;
    }
}
