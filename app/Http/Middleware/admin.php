<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $level = auth()->user()->level;
        if (auth()->user()->active == 1) :
            if ($level) :
                if ($level == 'admin') :
                    return $next($request);
                else:
                    return redirect('dashboard')
                        ->with('pesan_status', [
                            'tipe' => 'error',
                            'desc' => 'Tidak Dapat Mengakses Halaman ini',
                            'judul' => 'Halaman Khusus ADMIN'
                        ]);
                endif;
            else:
                return redirect('/')
                    ->with('pesan_status', [
                        'tipe' => 'error',
                        'desc' => 'Tidak Dapat Mengakses Halaman ini',
                        'judul' => 'Anda Belum Login Sebagai ADMIN'
                    ]);
            endif;
        else :
            return redirect('/')
                ->with('pesan_status', [
                    'tipe' => 'error',
                    'desc' => 'Tidak Dapat Mengakses Halaman ini',
                    'judul' => 'Akun anda belum aktif'
                ]);
        endif;
    }
}
