<div class="container mt-3">
  <div class="row">
    <div class="col-md-12 d-flex flex-wrap justify-content-between">
      <?php if (!empty($products)): ?>
        <?php foreach ($products as $p): ?>
          <div class="card" style="width: 18rem;">
            <?php if ($p['path'] === null): ?>
              <img class="card-img-top" src="public/img/no-img.png" alt="">
             <?php else: ?>
              <img class="card-img-top" src="public/img/uploads/products/<?= $p['path']; ?>" alt="">
            <?php endif; ?>
            <div class="card-body">
              <a href="product/<?= $p['id']; ?>">
                <h5 class="card-title"><?= $p['title']; ?></h5>
              </a>
              <p class="card-text"><?= $p['description']; ?></p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><?= $p['dt_created']; ?></li>
            </ul>
            <div class="card-body">
              <a href="#" class="card-link"><?= $p['username']; ?></a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>


