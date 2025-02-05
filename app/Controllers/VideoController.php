<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\VideoModel;

class VideoController extends BaseController
{

    protected $model;
    public function __construct()
    {
        $this->model = new VideoModel();
    }

    public function index()
    {

        $session = session();
        // jika tidak ada session maka kembali ke halaman login
        if (!$session->get('id_user')) {
            return redirect()->to(base_url('/login'));
        }

        $data = [
            'title' => 'Video',
            'link_video' => $this->model->findAll()
        ];
        return view('video/index', $data);
    }

    public function video()
    {
        try {
            $videos = $this->model->findAll();
            if (!$videos) {
                throw new \Exception('No videos found');
            }

            // Convert YouTube URLs to embed URLs
            foreach ($videos as &$video) {
                $video['link_video'] = $this->convertToEmbedUrl($video['link_video']);
            }

            $data = [
                'title' => 'Video',
                'video' => $videos
            ];
            return view('konten/video', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function convertToEmbedUrl($url)
    {
        $parsedUrl = parse_url($url);
        if (isset($parsedUrl['host']) && ($parsedUrl['host'] == 'youtu.be')) {
            $videoId = substr($parsedUrl['path'], 1);
            return 'https://www.youtube.com/embed/' . $videoId;
        } elseif (isset($parsedUrl['host']) && ($parsedUrl['host'] == 'www.youtube.com' || $parsedUrl['host'] == 'youtube.com')) {
            parse_str($parsedUrl['query'], $queryParams);
            if (isset($queryParams['v'])) {
                return 'https://www.youtube.com/embed/' . $queryParams['v'];
            }
        }
        return $url; // Return original URL if it's not a YouTube URL
    }

    public function proses_video()
    {
        $link_video = $this->request->getPost('link_video');
        $data = [
            'link_video' => $link_video
        ];
        $this->model->insert($data);
        return redirect()->to('/kelola_video')->with('success', 'Data berhasil ditambahkan');
    }

    public function update_video()
    {
        $id_video = $this->request->getPost('id_video');
        $link_video = $this->request->getPost('link_video');
        $data = [
            'link_video' => $link_video
        ];
        $this->model->update($id_video, $data);
        return redirect()->to('/kelola_video')->with('success', 'Data berhasil diubah');
    }

    public function delete_video($id_video)
    {
        $this->model->delete($id_video);
        return redirect()->to('/kelola_video')->with('success', 'Data berhasil dihapus');
    }



}
