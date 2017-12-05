<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('admin_model');
  }

  function index()
  {
    $this->load->view('admin/plantilla/encabezado_adm');
    echo "este es el inicio del admin";
    $this->load->view('admin/plantilla/pie_adm');
  }

  public function noticias(){

    if(isset($_POST['titulo'])){

      $titulo = $_POST['titulo'];
      $resumen = $_POST['resumen'];
      $texto = $_POST['texto'];
      $foto = $_FILES['foto']['name'];

      if($_FILES['foto']['error']==0){ //SI NO HAY ERRORES
        $this->admin_model->guardarNoticia($titulo,$resumen,$foto,$texto);
        redirect('admin/noticias');
      }

    }


    $this->load->view('admin/plantilla/encabezado_adm');
    $this->load->view('admin/noticias_adm_view');
    $this->load->view('admin/plantilla/pie_adm');
  }

  public function eventos(){

    if(isset($_POST['titulo'])){

      $titulo = $_POST['titulo'];
      $fecha = $_POST['fecha'];
      $hora = $_POST['hora'];
      $descripcion = $_POST['descripcion'];
      $foto = $_FILES['foto']['name'];

      if($_FILES['foto']['error']==0){ //SI NO HAY ERRORES
        $this->admin_model->guardarEvento($titulo,$fecha,$hora,$foto,$descripcion);
        redirect('admin/eventos');
      }

    }


    $this->load->view('admin/plantilla/encabezado_adm');
    $this->load->view('admin/eventos_adm_view');
    $this->load->view('admin/plantilla/pie_adm');
  }

  public function miembros(){
    $this->load->view('admin/plantilla/encabezado_adm');
    $this->load->view('admin/miembros_adm_view');
    $this->load->view('admin/plantilla/pie_adm');
  }

  public function galeria(){
    $this->load->view('admin/plantilla/encabezado_adm');
    $this->load->view('admin/galeria_adm_view');
    $this->load->view('admin/plantilla/pie_adm');
  }

  public function clasificados(){
    $this->load->view('admin/plantilla/encabezado_adm');
    $this->load->view('admin/clasificados_adm_view');
    $this->load->view('admin/plantilla/pie_adm');
  }

  public function contacto(){
    $this->load->view('admin/plantilla/encabezado_adm');
    $this->load->view('admin/contacto_adm_view');
    $this->load->view('admin/plantilla/pie_adm');
  }

  public function faq(){
    $this->load->view('admin/plantilla/encabezado_adm');
    $this->load->view('admin/faq_adm_view');
    $this->load->view('admin/plantilla/pie_adm');
  }

  public function administradores(){
    $this->load->view('admin/plantilla/encabezado_adm');
    $this->load->view('admin/admin_adm_view');
    $this->load->view('admin/plantilla/pie_adm');
  }

  public function parametros(){
    $this->load->view('admin/plantilla/encabezado_adm');
    $this->load->view('admin/parametros_adm_view');
    $this->load->view('admin/plantilla/pie_adm');
  }

}
