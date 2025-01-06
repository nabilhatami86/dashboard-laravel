<?php


namespace App\Support;

class Setting
{
    public static function get($key, $default = null)
    {
        // Mengambil nilai dari file .env, atau gunakan default jika tidak ditemukan
        return env($key, $default);
    }

    public static function setEnv($key, $value = null): void
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $key . '=' . env($key),
                $key . '=' . $value,
                file_get_contents($path)
            ));
        }
    }
}
