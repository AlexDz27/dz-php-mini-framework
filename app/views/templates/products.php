<div class="container">
  <div class="row">
    <div class="col-md-12">
	    <?php if ($items): ?>
        <ul>
			    <?php foreach ($items as $item): ?>
            <li>
              <a href="product/<?= $item['id']; ?>">
                <h4><?= $item['title']; ?></h4>
              </a>
					    <?= $item['content']; ?>
            </li>
			    <?php endforeach; ?>
        </ul>
	    <?php endif; ?>
    </div>
  </div>
</div>


