<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.10&appId=1484207561667175";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<section class="section-whitebg dm-shadow">
    <div class="container">
        <div class="general_wrapper clearfix">
          <div class="row">
            <div class="col-lg-8">
            <div class="blog-post">
              <h1 style="text-transform: uppercase;"><strong><?= $berita->judul_berita ?></strong></h1>
              <p class="lead">
                  by <a href="#"><?= $penulis; ?></a>
              </p>
              <hr>

              <!-- Date/Time -->
              <p><i class="fa fa-clock-o"></i> Posted on <?= date("d F Y", strtotime($berita->tanggal_berita))  ?> at <?= date("h:i a", strtotime($berita->tanggal_berita))  ?></p>
                
                
                <!-- Your share button code -->
                <div class="fb-share-button" data-href="<?= base_url('index.php/berita/view') ?>/<?= $berita->slug ?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fdevel.lapan.go.id%2Frb-lapan%2Fberita%2Fview%2F<?= $berita->slug ?>&amp;src=sdkpreparse">Bagikan</a></div>
              <hr>

              <!-- Preview Image -->
              <img class="img-responsive" src="<?= base_url() ?>doc_file/berita/<?= $berita->gambar_berita ?>" alt=""/>

              <hr>
              <!-- Post Content -->
              <p><?= $berita->deskripsi_berita ?></p>

              <hr>
              <!-- Blog Comments -->

              <!-- Comments Form -->
              <!-- <div class="well">
                  <h4>Leave a Comment:</h4>
                  <?= form_open('berita/komentar-management') ?>
                      <div class="form-group" data-parsley-validate>
                        <textarea class="form-control" rows="3" name="komentar" id="komentar" placeholder="Comment:" required="required"></textarea>
                        <input type="text" class="form-control col-md-7 col-xs-12" id="nama" name="nama" placeholder="Name:" required="required"/>
                        <input type="email" class="form-control col-md-7 col-xs-12" id="email" name="email" placeholder="Email:" data-parsley-trigger="change" required="required"/>
                      </div>
                      <input type="hidden" id="id_berita" name="id_berita" value="<?= $berita->id_berita ?>">
                      <input type="hidden" id="judul" name="judul" value="<?= $berita->judul_berita ?>">
                      <input type="hidden" id="tanggal" name="tanggal" value="<?php echo date('d F Y, g:i:s a'); ?>">
                      <input type="submit" name="tambah" class="btn btn-primary" value="Submit">
                  <?= form_close() ?>
              </div> -->

              <!-- <hr> -->

              <!-- Posted Comments -->
                              <!-- Comment -->
              <!-- <div class="media">
                  <a class="pull-left" href="#">
                      <img class="media-object" src="http://placehold.it/64x64" alt="">
                  </a>
                  <div class="media-body">
                      <h4 class="media-heading">Start Bootstrap
                          <small>August 25, 2014 at 9:30 PM</small>
                      </h4>
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                  </div>
              </div> -->

              <!-- Comment -->
              <!-- <div id="comment-post"></div>
              <?php foreach($Komentar as $komentar): ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="<?= base_url('assets/img') ?>/user-512.png" width="64" height="64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?= $komentar->nama ?>
                            <small><?= date("d F Y", strtotime($komentar->tanggal))  ?> at <?= date("h:i a", strtotime($komentar->tanggal))  ?></small>
                        </h4>
                        <?= $komentar->komentar ?>
                    </div>
                </div>
                <hr>
              <?php endforeach; ?> -->
             </div>  

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <!-- <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text"  class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" >
                                <span class="fa fa-search"></span>
                        </button>
                        </span>
                    </div>
                </div> -->
                
                <!-- Blog Categories Well -->
                <!-- <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->

              <!-- Side Widget Well -->
                <div class="well">
                    <h4>Berita</h4>
                    <hr style="border-width: 1px; border-color: #000000; margin-top: 0px;">
                    <?php foreach($Berita as $berita): ?> 
                      <a href="<?= base_url('index.php/berita/view'); ?>/<?= $berita->slug ?>" style="text-transform: uppercase;"><?php echo substr($berita->judul_berita,0,100); ?></a><br>
                      <h6 style="margin-top: 5px; margin-bottom: 5px; font-size: 11px;">(<?= date("F d, Y", strtotime($berita->tanggal_berita))  ?>)</h6>
                      <hr style="margin-top: 0px;">
                    <?php endforeach; ?>
                </div>

            </div>

      
            
           
          </div>
        </div>
    </div>
</section>

<script type="text/javascript">

  function fbShare(url, title, descr, image, winWidth, winHeight) {
    var winTop = (screen.height / 2) - (winHeight / 2);
    var winLeft = (screen.width / 2) - (winWidth / 2);
    window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + descr + '&p[url]=' + url + '&p[images][0]=' + image, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width='+winWidth+',height='+winHeight);
  }

  

  $('.btnShare').click(function(){
  elem = $(this);
  postToFeed(elem.data('title'), elem.data('desc'), elem.prop('href'), elem.data('image'));

  return false;
  });

function handleComment()
{
  var data = {
    "tambah": true,
    "id_berita": $('#id_berita').val(),
    "komentar": $('#komentar').val(),
    "nama": $('#nama').val(),
    "tanggal": $('#tanggal').val()
  };

  comment_insert(data);
}

  function comment_insert(data){
    var _komentar = $('#komentar').val();
    var _id_berita = $('#id_berita').val();
    var _nama = $('#nama').val();

    $.ajax({
      url: '<?= base_url('berita/komentar-management') ?>',
      type: 'POST',
      data: data,
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      success: function(){
        comment_show(data);
      }
    });
  }

  function comment_show(data)
  {
    var t = "";
    t += '<div class="media">';
    t += '<a class="pull-left" href="#">';
    t += '<img class="media-object" src="http://placehold.it/64x64" alt="">';
    t += '</a>';
    t += '<div class="media-body">';
    t += '<h4 class="media-heading">'+data.nama +' ';
    t += '<small>'+data.tanggal+'</small>';
    t += '</h4>';
    t += ''+data.komentar+'';
    t += '</div>';
    t += '</div>';

    $('#comment-post').prepend(t);
  }

  function retrieveComment(id_berita) {
    $.get('<?= base_url('berita/komentar-management/') ?>' + id_berita, function(data) {
      data = JSON.parse(data);

      //Empty first, before adding rows for the user.
      $('#riwayat_krs_body').empty();
      data.forEach(add_krs_row);
    });
  }
</script>