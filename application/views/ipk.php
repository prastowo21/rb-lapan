
<section id="wizard" class="section-whitebg dm-shadow">
    <div class="container">
        <div class="general_wrapper clearfix">
	        <div class="col-md-12">
	        <h1><i class="fa fa-check-square-o"></i><strong> Indeks Persepsi Korupsi LAPAN</strong></h1>
	        <hr style="border-style: dashed; border-width: 1px; border-color: #B7B5B5;">
		        <div class="col-md-12">
                <div class="container">
				  <div class="stepwizard col-md-offset-3">
				    <div class="stepwizard-row setup-panel">
				      <div class="stepwizard-step">
				        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
				        <p>Step 1</p>
				      </div>
				      <div class="stepwizard-step">
				        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
				        <p>Step 2</p>
				      </div>
				      <div class="stepwizard-step">
				        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
				        <p>Step 3</p>
				      </div>
				      <div class="stepwizard-step">
				        <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
				        <p>Step 4</p>
				      </div>
				      <div class="stepwizard-step">
				        <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
				        <p>Step 5</p>
				      </div>
				    </div>
				  </div>
				  
				  <?= form_open('menu/ipk/') ?>
				  	<div class="row setup-content" id="step-1">
				        <div class="col-md-12">
				          <div class="panel panel-quisioner text-center">
				          <?= $this->session->flashdata('msg') ?>
			    	      <h2><b>SELAMAT DATANG</b></h2>
							<h3><b>
							DI SURVEY<br>PERSEPSI KORUPSI<br>LEMBAGA PENERBANGAN DAN ANTARIKSA NASIONAL<br>TAHUN 2018
							</b></h3><br>
							<p>Indeks Persepsi Korupsi di LAPAN saat ini : <b><span id="ipk"><?php echo number_format($ipk_total,2); ?></span></b><small> dari skala (0-4)</small></p>
							<br><br><i class="fa fa-3x fa-check-square-o"></i>
							<p><b>TIM SURVEI PERSEPSI KORUPSI 2018<br>LAPAN</b></p>
			    	      </div>
				        </div><br><br><br>
				        <div class="col-md-12">
				        	<button class="btn btn-default prevBtn btn-lg pull-left disabled" type="button" > Previous <i class="fa fa-chevron-circle-left"></i></button>
				          	<button class="btn btn-default nextBtn btn-lg pull-right" type="button" > Next <i class="fa fa-chevron-circle-right"></i></button>
				        </div>
				    </div>
				  	<div class="row setup-content" id="step-2">
				        <div class="col-md-12">
					         <div class="panel panel-quisioner">
		    	    			<h2 style="text-align: center;">KUESIONER PERSEPSI KORUPSI</h2>
								<p>Kepada yang terhormat<br>Bapak/Ibu/sdr (i) Responden<br><br>
								</p>
								<p style="text-align: justify;">Dalam rangka Pelaksanaan Reformasi Birokrasi di lingkungan LAPAN serta pelaksanaan program Kementerian Pendayagunaan Aparatur Negara dan Reformasi Birokrasi, Bapak/Ibu/sdr (i) diharapkan bersedia menjadi responden tentang persepsi korupsi melalui pengisian kuesioner. Sehubungan dengan hal tersebut dimohon Bapak/Ibu/sdr (i) bersedia mengisi Kuesioner terlampir. Partisipasi Bapak/Ibu/sdr (i) tentu memberikan manfaat yang sangat besar bagi kami. Atas kesediaan Bapak/Ibu/sdr (i) kami sampaikan terima kasih dan penghargaan setinggi-tingginya.<br><br>
								</p>
								<p>TIM SURVEI PERSEPSI KORUPSI 2018<br><br>LAPAN
								</p>
		    	    		</div>
				        </div><br><br><br>
				        <div class="col-md-12">
				        	<button class="btn btn-default prevBtn btn-lg pull-left" type="button" > Previous <i class="fa fa-chevron-circle-left"></i></button>
				          	<button class="btn btn-default nextBtn btn-lg pull-right" type="button" > Next <i class="fa fa-chevron-circle-right"></i></button>
				        </div>
				    </div>
				    <div class="row setup-content" id="step-3">
				    	<div class="row">
					        <div class="col-md-12">
					          <div class="form-group">
					          	<div class="col-md-3 col-md-offset-1">
					            	<label class="control-label">Nama Responden:</label>
					            </div>
					            <div class="col-md-6">
					            	<input  maxlength="100" type="text" name="nama" required="required" class="form-control" placeholder="Masukkan Nama Responden"  />
					            </div>
					          </div>
					          <div class="form-group">
					          	<div class="col-md-3 col-md-offset-1">
					            	<label class="control-label">Jabatan:</label>
					            </div>
					            <div class="col-md-6">
					            	<input  maxlength="100" type="text" name="jabatan" required="required" class="form-control" placeholder="Masukkan Jabatan"  />
					            </div>
					          </div>
					          <div class="form-group">
					          	<div class="col-md-3 col-md-offset-1">
					            	<label class="control-label">Nama Instansi/Perusahaan:</label>
					            </div>
					            <div class="col-md-6">
					            	<input  maxlength="100" type="text" name="nama_instansi" required="required" class="form-control" placeholder="Masukkan Nama Instansi/Perusahaan"  />
					          	</div>
					          </div>
					          <div class="form-group">
					          	<div class="col-md-3 col-md-offset-1">
					            	<label class="control-label">Alamat Instansi/Perusahaan:</label>
					            </div>
					            <div class="col-md-6">
					            	<textarea name="alm_instansi" class="form-control" maxlength="200" rows="5" placeholder="Masukkan Alamat Instansi/Perusahaan" required="required" ></textarea>
					          	</div>
					          </div>
					          <div class="form-group">
					          	<div class="col-md-3 col-md-offset-1">
					            	<label class="control-label">Telepon Instansi/Perusahaan:</label>
					            </div>
					            <div class="col-md-6">
					            	<input  maxlength="100" type="text" name="tlp_instansi" required="required" class="form-control" placeholder="Masukkan Telepon Instansi/Perusahaan"  />
					          	</div>
					          </div>
					          <div class="form-group">
					          	<div class="col-md-3 col-md-offset-1">
					            	<label class="control-label">Kota:</label>
					            </div>
					            <div class="col-md-6">
					            	<input  maxlength="100" type="text" name="kota" required="required" class="form-control" placeholder="Masukkan Kota"  />
					          	</div>
					          </div>
					          
					        </div>
				        </div><br><br><br>
				        <div class="row">
					        <div class="col-md-12">
					        	<button class="btn btn-default prevBtn btn-lg pull-left" type="button" > Previous <i class="fa fa-chevron-circle-left"></i></button>
					          	<button class="btn btn-default nextBtn btn-lg pull-right" type="button" > Next <i class="fa fa-chevron-circle-right"></i></button>
					        	<!-- <input type="submit" class="btn btn-default nextBtn btn-lg pull-right" value="Next"> -->
					        </div>
				        </div>
				    </div>
				    <div class="row setup-content" id="step-4">
				        <div class="col-md-12">
				          <div class="panel panel-quisioner">
		    				<ol class="olleft">
								<li><p><b>Menurut anda apakah kondisi dibawah ini merupakan korupsi: </b></p></li>
							</ol>
							<div class="col-md-12">
							<hr class="line-quisioner">
								<div class="table-responsive">
									<table class="panel panel-default table table-bordered">
										<thead>
											<tr>
												<td class="active" rowspan="2" width="20">
													<h4>No.
													</h4>
												</td>
												<td class="active" rowspan="2" width="250">
													<h4>Jenis Korupsi
													</h4>
												</td>
												<td class="active" rowspan="2">
													<h4>Pertanyaan
													</h4>
												</td>
												<td class="active text-center" colspan="2">
													<h4>Pilihan jawaban
													</h4>
												</td>
											</tr>
											<tr>
												<td class="active text-center" width="60">
													<p>Ya
													</p>
												</td>
												<td class="active text-center" width="60">
													<p>Tidak
													</p>
												</td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td align="center">
													<p>a.
													</p>
												</td>
												<td>
													<p>Korupsi yang menyangkut kerugian negara
													</p>
												</td>
												<td>
													<p>Kasus:
													</p>
													<p>Pejabat pengadaan barang dan jasa di   Instansi Pemerintah memenangkan lelang perusahaan <br>yang memiliki hubungan   kedekatan dengan pejabat tersebut meskipun penawarannya bukan yang paling   baik dan murah.
													</p>
													<p>Pertanyaan:
													</p>
													<p>Apakah perbuatan  pejabat tersebut   dapat dikategorikan korupsi?
													</p>
												</td>
												<td align="center">
													<div class="getfeedback">
														<div class="radio radio-info radio-inline">
							                                <input id="1a" name="1a" value="4" type="radio" required="required"/><label></label>
							                            </div>
						                            </div>
												</td>
												<td align="center">
													<div class="getfeedback">
														<div class="radio radio-info radio-inline">
												        	<input id="1a" name="1a" value="0" type="radio" required="required"/><label></label>
												        </div>
											        </div>
												</td>
											</tr>
											<tr>
												<td align="center">
													<p>b.
													</p>
												</td>
												<td>
													<p>Korupsi yang menyangkut suap
													</p>
												</td>
												<td>
													<p>Kasus:
													</p>
													<p>Pelanggar lalu lintas memberikan uang damai   ke polisi daripada ditilang dan menjalani persidangan.
													</p>
													<p>Pertanyaan:
													</p>
													<p>Apakah perbuatan pelanggar lalu lintas   tersebut dapat digolongkan korupsi?
													</p>
												</td>
												<td align="center">
													<div class="getfeedback">
														<div class="radio radio-info radio-inline">
															<input id="1b" name="1b" value="4" type="radio" required="required"/><label></label>
														</div>
													</div>
												</td>
												<td align="center">
													<div class="getfeedback">
														<div class="radio radio-info radio-inline">
															<input id="1b" name="1b" value="0" type="radio" required="required"/><label></label>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td align="center">
													<p>c.
													</p>
												</td>
												<td>
													<p>Korupsi yang menyangkut penggelapan dalam   jabatan
													</p>
												</td>
												<td>
													<p>Kasus:
													</p>
													<p>Pegawai negeri sengaja memalsukan laporan   keuangan yang tidak sesuai dengan <br>pengeluaran sebenarnya.
													</p>
													<p>Pertanyaan:
													</p>
													<p>Apakah perbuatan pegawai tersebut   digolongkan ke dalam korupsi?
													</p>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="1c" name="1c" value="4" type="radio" required="required"/><label></label></div></div>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="1c" name="1c" value="0" type="radio" required="required"/><label></label></div></div>
												</td>
											</tr>
											<tr>
												<td align="center">
													<p>d.
													</p>
												</td>
												<td>
													<p>Korupsi yang termasuk benturan kepentingan   dalam pengadaan barang dan jasa
													</p>
												</td>
												<td>
													<p>Kasus:
													</p>
													<p>Pejabat pengadaan barang dan jasa ikut   terlibat langsung dalam pengadaan yang sedang diurus/diawasinya.
													</p>
													<p>Pertanyaan:
													</p>
													<p>Apakah perbuatan pejabat tersebut dapat   dikategorikan ke dalam korupsi?
													</p>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="1d" name="1d" value="4" type="radio" required="required"><label></label></div></div>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="1d" name="1d" value="0" type="radio" required="required"><label></label></div></div>
												</td>
											</tr>
											<tr>
												<td align="center">
													<p>e.
													</p>
												</td>
												<td>
													<p>Korupsi yang menyangkut pemerasan
													</p>
												</td>
												<td>
													<p>Kasus:
													</p>
													<p>Pejabat pemerintah yang meminta tips atau   fasilitas kepada <br>perusahaan/penyedia barang/jasa yang sedang mengikuti lelang   di instansinya.
													</p>
													<p>Pertanyaan:
													</p>
													<p>Apakah perbuatan pejabat tersebut dapat   dikategorikan ke dalam korupsi?
													</p>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="1e" name="1e" value="4" type="radio" required="required"><label></label></div></div>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="1e" name="1e" value="0" type="radio" required="required"><label></label></div></div>
												</td>
											</tr>
											<tr>
												<td align="center">
													<p>f.
													</p>
												</td>
												<td>
													<p>Korupsi yang menyangkut perbuatan curang
													</p>
												</td>
												<td>
													<p>Kasus:
													</p>
													<p>Pengawas bangunan dengan sengaja membiarkan   pembangunan gedung tidak sesuai dengan standar.
													</p>
													<p>Pertanyaan:
													</p>
													<p>Apakah perbuatan pengawas tersebut dapat   dikategorikan ke dalam korupsi?
													</p>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="1f" name="1f" value="4" type="radio" required="required"><label></label></div></div>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="1f" name="1f" value="0" type="radio" required="required"><label></label></div></div>
												</td>
											</tr>
											<tr>
												<td align="center">
													<p>g.
													</p>
												</td>
												<td>
													<p>Korupsi terkait gratifikasi
													</p>
												</td>
												<td>
													<p>Kasus:
													</p>
													<p>PNS menerima diskon khusus/voucher belanja   dari pihak pemasok barang.
													</p>
													<p>Pertanyaan:
													</p>
													<p>Apakah perbuatanPNS tersebut dapat dikategorikan   ke dalam korupsi?
													</p>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="1g" name="1g" value="4" type="radio" required="required"><label ></label></div></div>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="1g" name="1g" value="0" type="radio" required="required"><label ></label></div></div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<br>
							<ol start="2" class="olleft">
								<li><p><b>Dari mana anda mengetahui tentang LAPAN? (boleh pilih lebih dari satu)</b></p></li>
							</ol>
							<div class="col-md-12">
							<hr class="line-quisioner">
								<div class="checkbox">
						          <div class="checkbox checkbox-primary"><input name="2q[]" value="tv" type="checkbox"><label style="color:#000000">Televisi</label></div>
						          <div class="checkbox checkbox-primary"><input name="2q[]" value="koran" type="checkbox"><label style="color:#000000">koran</label></div>
						          <div class="checkbox checkbox-primary"><input name="2q[]" value="internet" type="checkbox"><label style="color:#000000">Internet</label></div>
						          <div class="checkbox checkbox-primary"><input name="2q[]" value="radio" type="checkbox"><label style="color:#000000">Radio</label></div>
						          <div class="checkbox checkbox-primary"><input name="2q[]" value="Poster/Spanduk/Booklet/Sticker" type="checkbox"><label style="color:#000000">Poster/Spanduk/Booklet/Sticker</label></div>
						         <div class="checkbox checkbox-primary"><input name="2q[]" value="lainnya" type="checkbox"><label style="color:#000000">Lainnnya</label></div>
						          <p class="help-block"><i>Mohon pilih minimal 1</i></p>
						        </div>
							<br>
							</div>

							<ol start="3" class="olleft">
								<li><p><b>Bagaimana penilaian anda terhadap kinerja (meliputi empat kompetensi) LAPAN</b></p></li>
							</ol>
							<div class="col-md-12">
							<hr class="line-quisioner">
								<div class="table-responsive">
									<table class="panel panel-default table table-bordered">
										<thead>
											<tr>
												<td class="active" rowspan="2" width="20">
													<p>No.
													</p>
												</td>
												<td class="active" rowspan="2">
													<p>Tugas-tugas
													</p>
												</td>
												<td class="active" colspan="3" width="60">
													<p>Pilihan jawaban
													</p>
												</td>
											</tr>
											<tr>
												<td class="active" width="60">
													<p>Baik
													</p>
												</td>
												<td class="active" width="60">
													<p>Cukup
													</p>
												</td>
												<td class="active" width="100">
													<p>Tidak Tahu
													</p>
												</td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td align="center">
													<p>a.
													</p>
												</td>
												<td>
													<p>Menyampaikan layanan dan informasi dengan cepat, dan   mudah
													</p>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="3a" name="3a" value="4" type="radio" required="required"><label ></label></div></div>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="3a" name="3a" value="2" type="radio" required="required"><label ></label></div></div>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="3a" name="3a" value="0" type="radio" required="required"><label ></label></div></div>
												</td>
											</tr>
											<tr>
												<td align="center">
													<p>b.
													</p>
												</td>
												<td>
													<p>Melakukan aktivitas pelayanan secara <i>on line</i>
													</p>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="3b" name="3b" value="4" type="radio" required="required"><label ></label></div></div>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="3b" name="3b" value="2" type="radio" required="required"><label ></label></div></div>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="3b" name="3b" value="0" type="radio" required="required"><label></label></div></div>
												</td>
											</tr>
											<tr>
												<td align="center">
													<p>c.
													</p>
												</td>
												<td>
													<p>Melakukan sosialisasi dan edukasi publik
													</p>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="3c" name="3c" value="4" type="radio" required="required"><label></label></div></div>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="3c" name="3c" value="2" type="radio" required="required"><label ></label></div></div>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="3c" name="3c" value="0" type="radio" required="required"><label ></label></div></div>
												</td>
											</tr>
											<tr>
												<td align="center">
													<p>d.
													</p>
												</td>
												<td>
													<p>Melakukan proses pengadaan barang dan jasa secara   transparan
													</p>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="3d" name="3d" value="4" type="radio" required="required"><label></label></div></div>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="3d" name="3d" value="2" type="radio" required="required"><label></label></div></div>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="3d" name="3d" value="0" type="radio" required="required"><label></label></div></div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<br>
							<ol start="4" class="olleft">
								<li><p><b>Apakah tanggapan anda terhadap pernyataan berikut?</b></p></li>
							</ol>

							<div class="col-md-12">
							<hr class="line-quisioner">
								<div class="table-responsive">
									<table class="panel panel-default table table-bordered">
										<thead>
											<tr class="active">
												<td rowspan="2" width="20" >
													<p>No.
													</p>
												</td>
												<td rowspan="2">
													<p>Pernyataan
													</p>
												</td>
												<td colspan="2">
													<p>Pilihan jawaban
													</p>
												</td>
											</tr>
											<tr>
												<td class="active" width="60">
													<p>Ya
													</p>
												</td>
												<td class="active" width="60">
													<p>Tidak
													</p>
												</td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td align="center">
													<p>a.
													</p>
												</td>
												<td>
													<p>Pemberian layanan dan informasi LAPAN sudah sesuai   dengan tugas dan fungsinya
													</p>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="4a" name="4a" value="4" type="radio" required="required"><label></label></div></div>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="4a" name="4a" value="0" type="radio" required="required"><label></label></div></div>
												</td>
											</tr>
											<tr>
												<td align="center">
													<p>b.
													</p>
												</td>
												<td>
													<p>Masyarakat semakin paham akan pentingnya informasi dan   layanan LAPAN
													</p>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="4b" name="4b" value="4" type="radio" required="required"><label></label></div></div>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="4b" name="4b" value="0" type="radio" required="required"><label></label></div></div>
												</td>
											</tr>
											<tr>
												<td align="center">
													<p>c.
													</p>
												</td>
												<td>
													<p>Semakin banyak orang yang tahu dan aktif meminta   informasi dan layanan LAPAN
													</p>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="4c" name="4c" value="4" type="radio" required="required"><label></label></div></div>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="4c" name="4c" value="0" type="radio" required="required"><label></label></div></div>
												</td>
											</tr>
											<tr>
												<td align="center">
													<p>d.
													</p>
												</td>
												<td>
													<p>Informasi dan layanan LAPAN sangat dibutuhkan   masyarakat
													</p>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="4d" name="4d" value="4" type="radio" required="required"><label></label></div></div>
												</td>
												<td align="center"><div class="getfeedback"><div class="radio radio-info radio-inline"><input id="4d" name="4d" value="0" type="radio" required="required"><label></label></div></div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
				        	</div>
				           </div>
				        </div><br><br><br>
				        <div class="col-md-12">
				        	<button class="btn btn-default prevBtn btn-lg pull-left" type="button" > Previous <i class="fa fa-chevron-circle-left"></i></button>
				          	<button class="btn btn-default nextBtn btn-lg pull-right" type="button" > Next <i class="fa fa-chevron-circle-right"></i></button>

				        </div>
				    </div>
				    <div class="row setup-content" id="step-5">
				        <div class="col-md-12">
				          	<ol start="5" class="olleft">
								<li><p><b>Persepsi Korupsi</b></p></li>
							</ol>
							<div class="col-md-12">
							<hr class="line-quisioner">
								<ul style="list-style-type: none;">
								<li>
									<p>1. Upaya LAPAN untuk pencegahan korupsi</p>
								</li>
								<li>
									<div class="getfeedback">
										<div class="radio radio-info radio-inline">
											<input id="q1" name="q1" value="4" type="radio" required="required"><label>Baik</label>
										</div>
									</div>
								</li>
								<li>
									<div class="getfeedback">
										<div class="radio radio-info radio-inline">
											<input id="q1" name="q1" value="2" type="radio" required="required"><label>Cukup</label>
										</div>
									</div>
								</li>
								<li>
									<div class="radio radio-info radio-inline">
										<input id="q1" name="q1" value="0" type="radio" required="required"><label>Tidak Tahu</label>
									</div>
								</li>
								</ul>
								<ul style="list-style-type: none;">
								<li>
									<p>2. Keterbukaan LAPAN terhadap pengaduan/laporan masyarakat terkait korupsi.</p>
								</li>
								<li>
									<div class="radio radio-info radio-inline">
										<input id="q2" name="q2" value="4" type="radio" required="required"><label>Baik</label>
									</div>
								</li>
								<li>
									<div class="radio radio-info radio-inline">
										<input id="q2" name="q2" value="2" type="radio" required="required"><label>Cukup</label>
									</div>
								</li>
								<li>
									<div class="radio radio-info radio-inline">
										<input id="q2" name="q2" value="0" type="radio" required="required"><label>Tidak Tahu</label>
									</div>
								</li>
								</ul>


								<ul style="list-style-type: none;">
								<li>
									<p>3. Respons LAPAN terhadap pengaduan/laporan masyarakat.</p>
								</li>
								<li>
									<div class="radio radio-info radio-inline">
										<input id="q3" name="q3" value="4" type="radio" required="required"><label>Baik</label>
									</div>
								</li>
								<li>
									<div class="radio radio-info radio-inline">
										<input id="q3" name="q3" value="2" type="radio" required="required"><label>Cukup</label>
									</div>
								</li>
								<li>
									<div class="radio radio-info radio-inline">
										<input id="q3" name="q3" value="0" type="radio" required="required"><label>Tidak Tahu</label>
									</div>
								</li>
								</ul>
								<ul style="list-style-type: none;">
								<li>
									<p>4. Integritas pegawai LAPAN dalam memberikan pelayanan </p>
								</li>
								<li>
									<div class="radio radio-info radio-inline">
										<input id="q4" name="q4" value="4" type="radio" required="required"><label>Baik</label>
									</div>
								</li>
								<li>
									<div class="radio radio-info radio-inline">
										<input id="q4" name="q4" value="2" type="radio" required="required"><label>Cukup</label>
									</div>
								</li>
								<li>
									<div class="radio radio-info radio-inline">
										<input id="q4" name="q4" value="0" type="radio" required="required"><label>Tidak Tahu</label>
									</div>
								</li>
								</ul>
								<ul style="list-style-type: none;">
								<li>
									<p>5. Secara umum, saat ini tidak terdengar indikasi korupsi di LAPAN.  </p>
								</li>
								<li>
									<div class="radio radio-info radio-inline">
										<input id="q5" name="q5" value="4" type="radio" required="required"><label >Setuju</label>
									</div>
								</li>
								<li>
									<div class="radio radio-info radio-inline">
										<input id="q5" name="q5" value="2" type="radio" required="required"><label>Tidak Setuju</label>
									</div>
								</li>
								<li>
									<div class="radio radio-info radio-inline">
										<input id="q5" name="q5" value="0" type="radio" required="required"><label >Tidak Tahu</label>
									</div>
								</li>
								</ul>
								<ul style="list-style-type: none;">
								<li>
									<p>6. Apakah anda percaya bahwa LAPAN dapat menjadi Instansi Pemerintah yang bebas dari korupsi?   </p>
								</li>
								<li>
									<div class="radio radio-info radio-inline">
										<input id="q6" name="q6" value="4" type="radio" required="required"><label >Percaya</label>
									</div>
								</li>
								<li>
									<div class="radio radio-info radio-inline">
										<input id="q6" name="q6" value="2" type="radio" required="required"><label >Tidak Percaya</label>
									</div>
								</li>
								<li>
									<div class="radio radio-info radio-inline">
										<input id="q6" name="q6" value="0" type="radio" required="required"><label >Tidak Tahu</label>
									</div>
								</li>
								</ul>
								<ul style="list-style-type: none;">
								<li>
									<p>7. Jika ada indikasi korupsi di lingkungan LAPAN, apakah anda akan melaporkan atau mengadukan hal tersebut melalui media yang sudah disediakan, antara lain e-lapor atau surat beridentitas?    </p>
								</li>
								<li>
									<div class="radio radio-info radio-inline">
										<input id="q7" name="q7" value="4" type="radio" required="required"><label>Ya</label>
									</div>
								</li>
								<li>
									<div class="radio radio-info radio-inline">
										<input id="q7" name="q7" value="2" type="radio" required="required"><label >Tidak</label>
									</div>
								</li>
								<li>
									<div class="radio radio-info radio-inline">
										<input id="q7" name="q7" value="0" type="radio" required="required"><label>Tidak Tahu</label>
									</div>
								</li>
								</ul>
								<ul style="list-style-type: none;">
								<li>
									<p>
										<?php echo $recaptcha_html;?>
							          	<?php echo form_error('g-recaptcha-response'); ?>
						          	</p>
								</li>
								</ul>
							</div>
							<br>
				        </div><br><br><br>
				        <div class="col-md-12">
				        	<button class="btn btn-default prevBtn btn-lg pull-left" type="button" > Previous <i class="fa fa-chevron-circle-left"></i></button>
				          	<!-- <button class="btn btn-default nextBtn btn-lg pull-right" type="button" name="submit"> Next <i class="fa fa-chevron-circle-right"></i></button> -->
				          	<input type="submit" name="submit" class="btn btn-default nextBtn btn-lg pull-right" value="Submit"/>
				        </div>
				    </div>
				  <?= form_close() ?>
				</div>
				</div>
	        </div>
        </div>
    </div>
</section>
<script type="text/javascript">
	$(document).ready(function($) {
		navbar_active('#nb_ipk');
	});
</script>