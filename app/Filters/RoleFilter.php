<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $level = $session->get('level');

        // Jika tidak login, redirect ke login
        if (!$level) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek apakah level user sesuai dengan role yang diizinkan (argument filter)
        if ($arguments && !in_array($level, $arguments)) {
            return redirect()->to('/forbidden')->with('error', 'Anda tidak memiliki akses.');
        }

        // jika sesuai, lanjutkan
        return;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu apa-apa di sini
    }
}
