<?php 


class AdminHome extends Controller{

	public function dashboard(){

		if( isset( $_SESSION['admin'] ) ){
			$css = '
				<!-- Timeline CSS -->
			    <link href="/assets/css/timeline.css" rel="stylesheet">

			    <!-- Morris Charts CSS -->
			    <link href="/assets/bower_components/morrisjs/morris.css" rel="stylesheet">
		';

		$js = '
				<!-- Morris Charts JavaScript -->
			    <script src="/assets/bower_components/raphael/raphael-min.js"></script>
			    <script src="/assets/bower_components/morrisjs/morris.min.js"></script>
			    <script src="/assets/js/morris-data.js"></script>
		';

		$this->header_admin('Dasboard - ', $css);
        require $this->adminviews . "home.php";
        $this->footer_admin( $js );			
		}else{
            header( "Location: http://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}
}