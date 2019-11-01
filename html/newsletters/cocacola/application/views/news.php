<div class="container top50">
  <div class="row justify-content-center">
    <div class="col-sm-10">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?=base_url('index.php/newsletters');?>">Newsletters</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Newsletter <?=$newsletter['id'];?></li>
        </ol>
      </nav>
      <div class="card bg-white top50">
        <div class="card-header">
          <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#new_news">Añadir Noticia</button>
        </div>
        <div class="card-body">
          <div class="alert alert-danger hidden" role="alert" id="alert3">Noticia Eliminada</div>
          <table class="table">
            <tbody>
             <?php foreach ($news as $ns) {
                    $edit = base_url('index.php/edit_news/').$ns["id"];

                $array = array(
                    "Prensa" => "1",
                    "Sitios Web" => "2",
                    "Redes Sociales" => "3",
                    "Radio" => "4",
                    "Televisión" => "5",
                );

                foreach ($array as $key => $aa) {
                  if ($ns['type'] == $aa) {
                    $type = $key;
                  }
                }
                $sector = "";
                for ($i=0; $i < count($sectores); $i++) { 
                  if($ns['id_sector'] === $sectores[$i]['id']){
                    $sector = $sectores[$i];
                    break;
                  } 
                }
                //<span>'.isset($ns['nameCategory']) ? $ns['nameCategory']: "".'</span><br>
                    echo
                      '<tr>
                        <td>
                          <span style="color:#ccc">'.$type.'</span> | 
                          <span style="color:#777">'.$sector['name'].'</span><br>
                          <span><a href="'.$ns['link'].'">'.$ns['title'].'</a></span><br>
                          <span>'.$ns['text'].'</span><br>
                          <span class="text-danger">'.$ns['source'].'</span><br><br>
                          <a href="'.$edit.'"><button type="button" class="btn btn-primary"><i class="fas fa-edit"></i></button></a>
                          <button type="button" class="btn btn-danger" data-id="'.$ns['id'].'" id="delete_news"><i class="far fa-trash-alt"></i></button>
                        </td>
                      </tr>';
                    }
                  ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>