<div class="container mt-5">
	<div class="row">
		<div class="col-md-6">
			<h2>Add product</h2>
			<form method="post" enctype="multipart/form-data">
				<p>
				<input type="file" name="product-img" onchange="readImage(this);" id="">
					<?php if (!empty($errors['image'])): ?>
				<ul class="form-errors-list">
					<?php foreach ($errors['image'] as $error): ?>
						<li><?= $error; ?></li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
				</p>
				<p>
				<img class="user-ava--profile" id="prod-add" alt="">
				</p>
				<p>
					<input type="text" name="add-title" value="<?= $title; ?>" placeholder="Title for your product" id="">
					<?php if (!empty($errors['title'])): ?>
				<ul class="form-errors-list">
					<?php foreach ($errors['title'] as $error): ?>
						<li><?= $error; ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
				</p>
				<textarea class="add-text" placeholder="Text for your product" name="text" id=""><?= $text; ?></textarea>
				<?php if (!empty($errors['text'])): ?>
					<ul class="form-errors-list">
						<?php foreach ($errors['text'] as $error): ?>
							<li><?= $error; ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
				<p>
					<button type="submit" name="prod">Submit file</button>
				</p>
			</form>
		</div>
		<div class="col-md-6">

		</div>
	</div>
</div>

