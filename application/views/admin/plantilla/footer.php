            <div class="row w-margen-50">
                <div class="col-lg-12 text-center"> 
                    <ul>
                        <p>Página Mostrada en: <strong>{elapsed_time}</strong> segundos.</p>
                    </ul> 
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

    <!--JS-->
    <script src="<?= base_url("public/js/jquery-2.2.0.min.js") ?>"></script> 
    <script src="<?= base_url("public/js/bootstrap.js") ?>"></script> 
    <script src="<?= base_url("public/js/comun.js") ?>"></script>  
    
    <!-- Personales -->
    <?php    
    if (isset($js)) {
        foreach ($js as $file) {            
            if($file){
            ?>
                <script src="<?= base_url("public/js/{$file}.js") ?>"></script>
            <?php 
            }
        }
    }     
    ?>    
</body>
</html>
