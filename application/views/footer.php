<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="tb-copyright">Página Mostrada en: <strong>{elapsed_time}</strong> segundos.</p>
            </div>
        </div>
    </div>
</footer>
<!--JS-->
<script src="<?= base_url("public/js/jquery-2.2.0.min.js") ?>"></script> 
<script src="<?= base_url("public/js/bootstrap.js") ?>"></script> 

<!-- Personales -->   
<?php
if (isset($js)) {
    foreach ($js as $file) {
        ?>
        <script src="<?= base_url("public/js/{$file}.js") ?>"></script>
    <?php
    }
}
?> 
<script src="<?= base_url("public/js/comun.js") ?>"></script>       
</body>
</html>
