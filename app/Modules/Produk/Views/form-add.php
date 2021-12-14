<div class="container form-container">
	<div class="form-header">
		<h5 class="title"><?=$title?></h5>
		<a href="<?=base_url()?>/produk" class="btn btn-sm btn-outline-secondary">&laquo; Daftar Produk</a>
	</div>
	<hr/>
	<div class="form-body">
		<form method="post" action="<?=current_url(true)?>" class="form-horizontal" enctype="multipart/form-data">
			<div class="form-group row">
				<label class="col-sm-4 col-md-2 col-lg-3 col-xl-2 col-form-label">Nama Produk</label>
				<div class="col-sm-6">
					<input class="form-control" type="text" name="nama_produk" value="" required="required"/>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-md-2 col-lg-3 col-xl-2 col-form-label">Deskripsi Produk</label>
				<div class="col-sm-6">
					<textarea class="form-control" name="deskripsi_produk"></textarea>
				</div>
			</div>
			<div class="form-group row mb-0">
				<div class="col-sm-6">
					<button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="id" value=""/>
				</div>
			</div>
		</form>
		
	</div>
	<hr/>
	<div class="form-footer">
		<p>Halaman ini merupakan contoh penerapan HMVC pada codeigniter 4. Untuk tutorial dan link download source codenya dapat diakses melalui halaman <a target="_blank" href="https://jagowebdev.com/hmvc-pada-codeigniter-4/" title="Implementasi HMVC Pada Codeigniter 4">https://jagowebdev.com/hmvc-pada-codeigniter-4/</a></p>
	</div>
</div>