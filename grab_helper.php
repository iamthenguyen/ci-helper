<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @since 0.0.1
 *
 * grab url and save to cache
 */
if (! function_exists('grab_url')) {
	function grab_url($url='', $disable_cache = 0)
	{
		// selalu ambil dari url
		if ($disable_cache == 1) {
			$hasil = file_get_contents($url);
			simpan_grab($url, $hasil);
			return $hasil;
		} else {
			return ambil_grab($url) !== false ? 
					ambil_grab($url) :
					grab_url($url, 1);
		}
	}
}

/**
 * @since 0.0.1
 *
 * simpan hasil grab ke folder grabs
 */

if (! function_exists('simpan_grab')) {
	function simpan_grab($url='', $content)
	{
		$nama_file = GRAB_FOLDER . base64_encode($url) . CACHE_EXT;
		file_put_contents($nama_file, $content);
		return true;
	}
}

/**
 * @since 0.0.1
 *
 * ambil hasil grab dari folder grabs
 */

if (! function_exists('ambil_grab')) {
	function ambil_grab($url)
	{
		$nama_file = GRAB_FOLDER . base64_encode($url) . CACHE_EXT; 
		if (file_exists($nama_file))
			return file_get_contents($nama_file);
		
		return false; 
	}
}

/* End of file grab_helper.php */
/* Location: ./application/helpers/grab_helper.php */