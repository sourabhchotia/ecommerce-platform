<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('DOMPDF_ENABLE_AUTOLOAD', true);
require_once APPPATH."libraries/vendor/dompdf/dompdf/autoload.inc.php";
use Dompdf\Dompdf;
use Dompdf\Options;

class Pdfgenerator {

  public function generate($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
  {

    
    $options = new Options();
    $options->set('isRemoteEnabled', TRUE);
    $options->set('defaultFont', 'Helvetica Neue');

    $options->set('isHtml5ParserEnabled', TRUE);
    $options->set('isJavascriptEnabled ', TRUE);
    $options->set('isPhpEnabled', TRUE);

    $dompdf = new Dompdf($options);
    $dompdf->load_html($html);
    $dompdf->setPaper($paper, $orientation);

    $files = array(

    );
    $dompdf->setBasePath(realpath(APPPATH . '/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css'),
      realpath(APPPATH . '/assets/dist/css/style.min.css'),
      realpath(APPPATH . '/assets/libs/jquery/dist/jquery.min.js'),
      realpath(APPPATH . '/assets/libs/popper.js/dist/umd/popper.min.js'),
      realpath(APPPATH . '/assets/libs/bootstrap/dist/js/bootstrap.min.js'),
      realpath(APPPATH . '/assets/dist/js/app-style-switcher.js'),
      realpath(APPPATH . '/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js'),
      realpath(APPPATH . '/assets/dist/js/custom.min.js'));

    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf", array("Attachment" => 0));
    } else {
        return $dompdf->output();
    }
  }
}