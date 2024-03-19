<?php require __DIR__ . '/parts/pdo-connect.php';
include __DIR__ . '/parts/html-head.php';
?>

<div class="container">
  <div class="row">
    <div class="col-6">
      <form method="post" action="dump-post.php">
        <div class="mb-3">
          <button type="button" class="btn btn-warning" onclick="addItem()">
            +
          </button>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <label for="" class="form-label">商品資料</label>
              <input type="text" class="form-control" name="product_id" placeholder="商品ID" />
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" name="unit_price" placeholder="金額" />
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" name="quantity" placeholder="數量" />
            </div>
          </div>
        </div>
        <div class="c-container"></div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
<?php include __DIR__ . '/parts/scripts.php' ?>
<script>
  const c_container = $(".c-container");
  const itemFpl = () => {
    return `<div class="card">
              <div class="card-body">
                <div class="mb-3">
                  <label for="" class="form-label"
                    >商品資料
                    <button type="button" class="btn btn-danger" onclick="removeItem(event)">-</button>
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    name="product_id"
                    placeholder="商品ID"
                  />
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" name="unit_price" placeholder="金額" />
                </div>
                <div class="mb-3">
                  <input
                    type="text"
                    class="form-control"
                    name="quantity"
                    placeholder="數量"
                  />
                </div>
              </div>
            </div>`;
  };

  function addItem() {
    c_container.append(itemFpl());
  }

  function removeItem(event) {
    const $el = $(event.target);
    $el.closest(".card").remove();
  }
</script>

<?php include __DIR__ . '/parts/html-foot.php' ?>