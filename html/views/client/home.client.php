<!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Page Heading
                    <small>Secondary Text</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <?php foreach (array_reverse($news) as $key => $notice): ?>            
            <!-- Project One -->
            <div class="row">
                <div class="col-md-7">
                    <a href="#">
                        <img class="img-responsive" src="http://placehold.it/700x300" alt="" width="700" height="300">
                    </a>
                </div>
                <div class="col-md-5">
                    <h3><?= $notice['encabezado'] ?></h3>
                    <h4><?= $notice['fuente'] . ' - ' . $notice['autor'] ?></h4>
                    <p><?= cortarTexto($notice['sintesis'], 200) ?></p>
                    <a class="btn btn-primary" href="#">View Project <span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
            </div>
            <!-- /.row -->

            <hr>
        <?php endforeach; ?>

        
        <!-- Pagination -->
        <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li>
                        <a href="#">&laquo;</a>
                    </li>
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
                    <li>
                        <a href="#">&raquo;</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.row -->

        <hr>


    </div>
    <!-- /.container -->
