<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormDetail extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
     * 
	 */

     public function __construct()
	 {
		 parent::__construct();
		 $this->load->model('Produkmodel');
	 }


	public function detail_data($paramid = false)
	{
		//$this->load->view('form_detail');
        $data['detail_data'] = $this->Produkmodel->findDetailBarang($paramid);
 
        $this->load->view('form_detail',$data);
	}

	public function submit_edit_data()
	{



		$idbarang = $this->input->post('idbarang');


		$textnamabarang = $this->input->post('textnamabarang');

		$convertnumberhargabeli = $this->input->post('convertnumberhargabeli');

		$convertnumberhargajual = $this->input->post('convertnumberhargajual');
		

		$flaggantigambar = $this->input->post('flaggantigambar');
		$inputgambar = $this->input->post('inputgambar');

		$valuegambar;
		if($flaggantigambar == '0') {


		

			$valuegambar = $inputgambar;

		}
		else if($flaggantigambar == '1')

		{

			$image_name = null;
				$path = "gambar/gambar_barang/";
				$string_pieces = explode( ";base64,", $inputgambar);
		
				/*@ Get type of image ex. png, jpg, etc. */
				// $image_type[1] will return type
				$image_type_pieces = explode( "image/", $string_pieces[0] );
		
				$image_type = $image_type_pieces[1];
		
				/*@ Create full path with image name and extension */
				$store_at = $path.md5(uniqid()).'.'.$image_type;
			


				$decoded_string = base64_decode( $string_pieces[1] );
		
				file_put_contents( $store_at, $decoded_string );

				$valuegambar = $store_at;

		}

		$convertstokbarang = $this->input->post('convertstokbarang');
		
		$data1 = $this->Produkmodel->update_barang($idbarang, $textnamabarang, $convertnumberhargabeli,  $convertnumberhargajual, $valuegambar, $convertstokbarang); 


		redirect(base_url());



	}

}
