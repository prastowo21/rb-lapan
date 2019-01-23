<footer>
    <section class="section-darkbg dm-shadow">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-5" style="color:white;">
                    <div class="widget-title">
                        <h3><span>Parameter Program Reformasi Birokrasi</span></h3>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <ul>
                            <li>
                                <a href="#"><font color="#ffffff">MANAJEMEN PERUBAHAN</font></a>
                            </li>
                            <li>
                                <a href="#"><font color="#ffffff">PENATAAN PERATURAN PERUNDANG-UNDANGAN</font></a>
                            </li>
                            <li>
                                <a href="#"><font color="#ffffff">PENATAAN DAN PENGUATAN ORGANISASI</font></a>
                            </li>
                            <li>
                                <a href="#"><font color="#ffffff">PENATAAN TATALAKSANA</font></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <ul>
                            <li>
                                <a href="#"><font color="#ffffff">PENATAAN SISTEM MANAJEMEN SDM</font></a>
                            </li>
                            <li>
                                <a href="#"><font color="#ffffff">PENGUATAN AKUNTABILITAS</font></a>
                            </li>
                            <li>
                                <a href="#"><font color="#ffffff">PENGUATAN PENGAWASAN</font></a>
                            </li>
                            <li>
                                <a href="#"><font color="#ffffff">PENINGKATAN KUALITAS PELAYANAN PUBLIK</font></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    
                        <div class="widget-title">
                            <h3><span>Kantor Pusat LAPAN</span></h3>
                        </div>
                        <ul style="list-style: none;">
                                <li>
                                    <i style class="fa fa-map-marker"></i><font color="#ffffff">&nbsp;&nbsp;&nbsp;Jl. Pemuda Persil No.1 Jakarta 13220 </font>
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i><font color="#ffffff">&nbsp;&nbsp;Telepon (021) 4892802 Fax. 4892815</font>
                                </li>
                                <li>
                                    <i class="fa fa-envelope"></i><font color="#ffffff">&nbsp;&nbsp;humas@lapan.go.id</font>
                                </li>
                        </ul>
                </div>    
                
                        <div class="col-md-3 col-sm-3">
                           
                            <div class="widget-title">    
                                <h3><span>Pengunjung</span></h3>    
                            </div>
                                <ul style="list-style: none;">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td><li><font color="#ffffff">Total Pengunjung </font></li></td>
                                            <td><span class="badge"><?= $totalvisitor ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><li><font color="#ffffff">Pengunjung hari ini &nbsp;</font></li></td>
                                            <td><span class="badge"><?= $totalvisitorday ?></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                    
                                </ul>
                                <!-- <style type="text/css">
                                    table.counter{
                                        
                                        border-radius:5px;
                                        background-color:#000000;
                                    }
                                    table.counter tr td{
                                        font:bold 12px Tahoma,Arial,Helvetica;
                                        color:#ffffff;
                                        padding:0 5px 0 5px;
                                    }
                                    table.counter tr td img{
                                        width:15px;
                                        height:18px;
                                    }
                                </style>

                               <table cellpadding="0" cellspacing="0" class="counter">
                                   <tbody>
                                       <tr>
                                            <td valign="middle" height="20">Total pengunjung</td>
                                            <td valign="middle">
                                                <span class="badge"><?= $totalvisitor ?></span>
                                            </td>
                                       </tr>
                                       <tr>
                                            <td valign="middle" height="20">Pengunjung hari ini</td>
                                            <td valign="middle">
                                                <span class="badge"><?= $totalvisitorday ?></span>
                                            </td>
                                       </tr>
                                   </tbody>
                               </table> -->
                                
                            
                        </div><!-- end col-lg-6 -->
                
                
            </div><!-- general_wrapper -->
        </div><!-- end container -->
    </section>
    <section class="section-copyright dm-shadow text-center">
        <div class="container">
            <div class="back-to-top clearfix">
                <span><span class="dmtop" style="bottom: 25px;"><i class="fa fa-arrow-up"></i></span></span>
            </div>

            <p><font color="#ffffff">Copyright @ 2018 . PUSTIKPAN.</font></p>
        </div><!-- end container -->
    </section>
    
</footer>
    
    <script src="<?php echo base_url ('assets/js/jquery.js'); ?>" type="text/javascript"></script>       
    <script src="<?php echo base_url (); ?>assets/js/jquery.jigowatt.js"></script>
    <script src="<?php echo base_url (); ?>assets/js/jquery.simple-text-rotator.js"></script>
    <script src="<?php echo base_url (); ?>assets/js/jquery.fitvids.js"></script>
    <script src="<?php echo base_url (); ?>assets/js/jquery.unveilEffects.js"></script>   
    <script src="<?php echo base_url ('assets/js/bootstrap.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url ('assets/js/application.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url ('assets/js/prettify.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url ('assets/js/stepwizard.js'); ?>" type="text/javascript"></script>
    <!-- Parsley -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Chart.js -->
    <script src="<?= base_url('assets/gentelella-master') ?>/vendors/Chart.js/dist/Chart.min.js" type="text/javascript"></script>
    <!-- Image Box -->
    <script src="<?= base_url('assets/js') ?>/jquery.imagebox.js"></script>
    <!-- ekko-lightbox -->
    <script src="<?= base_url('assets/js') ?>/ekko-lightbox.js"></script>
    
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('#Carousel').carousel({
                interval: 5000
            });
        });

        <?php
          $i = 1;
          foreach ($Pencapaian as $pencapaian) {
            $label[$i] = $pencapaian->nama;
            $nilai[$i] = $pencapaian->nilai;
            $i++;
          }
        ?>

        var chart1 = document.getElementById("chart1");
        var chart1 = new Chart(chart1, {
            type: 'radar',
            options: {
                scale: {
                    ticks: {
                        beginAtZero: true
                    }
                }
            },
            data: {
                labels: [
                          <?php 
                            for ($j  = 1; $j <= count($label); $j++) {
                              echo '"' . $label[$j] . '",';
                            } 
                          ?>
                        ],
                
                datasets: [{
                        label: '% Capaian',
                        data: [
                                <?php 
                                  for ($k = 1; $k <= count($nilai); $k++) {
                                    echo '"' . $nilai[$k] . '",';
                                  } 
                                ?>
                              ],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(54, 162, 235, 0.5)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 2)',                                
                            'rgba(54, 162, 235, 2)',
                            'rgba(54, 162, 235, 2)',
                            'rgba(54, 162, 235, 2)',
                            'rgba(54, 162, 235, 2)',
                            'rgba(54, 162, 235, 2)',
                            'rgba(54, 162, 235, 2)',
                            'rgba(54, 162, 235, 2)'
                        ],
                        borderWidth: 1
                    }]
            }
            
        });
        
    </script>
</html>

