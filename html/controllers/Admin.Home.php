<?php 


class AdminHome extends Controller{

	public function dashboard(){
		if( isset( $_SESSION['admin'] ) ){
			$css = '
				<!-- Timeline CSS -->
			    <link href="/opmedios/assets/css/timeline.css" rel="stylesheet">

			    <!-- Morris Charts CSS -->
			    <link href="/opmedios/assets/bower_components/morrisjs/morris.css" rel="stylesheet">
		';

		$js = '
				<!-- Morris Charts JavaScript -->
			    <script src="/opmedios/assets/bower_components/raphael/raphael-min.js"></script>
			    <script src="/opmedios/assets/bower_components/morrisjs/morris.min.js"></script>
			    <script src="/opmedios/assets/js/morris-data.js"></script>
		';

		$this->header_admin('Dasboard - ', $css);
        require $this->adminviews . "home.php";
        $this->footer_admin( $js );			
		}else{
            header( "Location: https://{$_SERVER["HTTP_HOST"]}/panel/login");
        }
	}
}